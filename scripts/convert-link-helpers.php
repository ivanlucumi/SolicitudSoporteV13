<?php

/**
 * Convierte link_to_route() y link_to() a etiquetas <a> HTML en vistas Blade.
 */

$viewsPath = dirname(__DIR__) . '/resources/views';
$filesModified = 0;
$linksConverted = 0;

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($viewsPath, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'php' || ! str_ends_with($file->getFilename(), '.blade.php')) {
        continue;
    }

    $path = $file->getPathname();
    $content = file_get_contents($path);

    if (! str_contains($content, 'link_to_route') && ! str_contains($content, 'link_to(')) {
        continue;
    }

    $newContent = convertLinkHelpers($content, $linksConverted);

    if ($newContent !== $content) {
        file_put_contents($path, $newContent);
        $filesModified++;
    }
}

echo "Archivos modificados: {$filesModified}\n";
echo "Enlaces convertidos: {$linksConverted}\n";

function convertLinkHelpers(string $content, int &$count): string
{
    $offset = 0;

    while (preg_match('/\{!!\s*link_to(?:_route)?\s*\(/s', $content, $match, PREG_OFFSET_CAPTURE, $offset)) {
        $start = $match[0][1];
        $openParen = $start + strlen($match[0][0]) - 1;

        $parsed = parseFunctionCall($content, $openParen);
        if ($parsed === null) {
            $offset = $openParen + 1;
            continue;
        }

        [$args, $endPos] = $parsed;
        $closing = strpos($content, '!!}', $endPos);
        if ($closing === false) {
            $offset = $endPos;
            continue;
        }

        $fullEnd = $closing + 3;
        $isRoute = str_contains($match[0][0], 'link_to_route');
        $replacement = $isRoute
            ? buildRouteLink($args)
            : buildPlainLink($args);

        $content = substr($content, 0, $start) . $replacement . substr($content, $fullEnd);
        $count++;
        $offset = $start + strlen($replacement);
    }

    return $content;
}

function parseFunctionCall(string $content, int $openParen): ?array
{
    $depth = 0;
    $inString = false;
    $stringChar = '';
    $length = strlen($content);

    for ($i = $openParen; $i < $length; $i++) {
        $char = $content[$i];

        if ($inString) {
            if ($char === '\\') {
                $i++;
                continue;
            }
            if ($char === $stringChar) {
                $inString = false;
            }
            continue;
        }

        if ($char === "'" || $char === '"') {
            $inString = true;
            $stringChar = $char;
            continue;
        }

        if ($char === '(') {
            $depth++;
            continue;
        }

        if ($char === ')') {
            $depth--;
            if ($depth === 0) {
                $argsString = substr($content, $openParen + 1, $i - $openParen - 1);

                return [splitArguments($argsString), $i + 1];
            }
        }
    }

    return null;
}

function splitArguments(string $argsString): array
{
    $args = [];
    $current = '';
    $depth = 0;
    $inString = false;
    $stringChar = '';
    $length = strlen($argsString);

    for ($i = 0; $i < $length; $i++) {
        $char = $argsString[$i];

        if ($inString) {
            $current .= $char;
            if ($char === '\\') {
                if ($i + 1 < $length) {
                    $current .= $argsString[++$i];
                }
                continue;
            }
            if ($char === $stringChar) {
                $inString = false;
            }
            continue;
        }

        if ($char === "'" || $char === '"') {
            $inString = true;
            $stringChar = $char;
            $current .= $char;
            continue;
        }

        if ($char === '[' || $char === '(') {
            $depth++;
            $current .= $char;
            continue;
        }

        if ($char === ']' || $char === ')') {
            $depth--;
            $current .= $char;
            continue;
        }

        if ($char === ',' && $depth === 0) {
            $args[] = trim($current);
            $current = '';
            continue;
        }

        $current .= $char;
    }

    if (trim($current) !== '') {
        $args[] = trim($current);
    }

    return $args;
}

function extractNamedArg(array $args, string $name, ?string $default = null): ?string
{
    foreach ($args as $arg) {
        if (preg_match('/^\$' . preg_quote($name, '/') . '\s*=\s*(.+)$/s', $arg, $match)) {
            return trim($match[1]);
        }
    }

    return $default;
}

function parseAttributesArray(?string $attributesExpr): array
{
    if ($attributesExpr === null || $attributesExpr === '') {
        return [];
    }

    $attributesExpr = trim($attributesExpr);
    if (! str_starts_with($attributesExpr, '[')) {
        return [];
    }

    $inner = substr($attributesExpr, 1, -1);
    $pairs = [];
    $current = '';
    $depth = 0;
    $inString = false;
    $stringChar = '';
    $length = strlen($inner);

    for ($i = 0; $i < $length; $i++) {
        $char = $inner[$i];

        if ($inString) {
            $current .= $char;
            if ($char === '\\') {
                if ($i + 1 < $length) {
                    $current .= $inner[++$i];
                }
                continue;
            }
            if ($char === $stringChar) {
                $inString = false;
            }
            continue;
        }

        if ($char === "'" || $char === '"') {
            $inString = true;
            $stringChar = $char;
            $current .= $char;
            continue;
        }

        if ($char === '[' || $char === '(') {
            $depth++;
            $current .= $char;
            continue;
        }

        if ($char === ']' || $char === ')') {
            $depth--;
            $current .= $char;
            continue;
        }

        if ($char === ',' && $depth === 0) {
            if (trim($current) !== '') {
                $pairs[] = trim($current);
            }
            $current = '';
            continue;
        }

        $current .= $char;
    }

    if (trim($current) !== '') {
        $pairs[] = trim($current);
    }

    $attributes = [];
    foreach ($pairs as $pair) {
        if (preg_match("/^['\"](\w+)['\"]\s*=>\s*(.+)$/s", $pair, $match)) {
            $attributes[$match[1]] = trim($match[2], " \t\n\r\0\x0B'\"");
        }
    }

    return $attributes;
}

function attributesToHtml(array $attributes): string
{
    $html = '';

    foreach ($attributes as $key => $value) {
        if (in_array($key, ['secure'], true)) {
            continue;
        }

        if (preg_match('/^\{\{.*\}\}$/s', $value) || str_contains($value, '{{') || str_contains($value, '<?')) {
            $html .= ' ' . $key . '="' . $value . '"';
            continue;
        }

        if (preg_match('/^\$[a-zA-Z_][\w->\[\]$]*/', $value)) {
            $html .= ' ' . $key . '="{{ ' . trim($value, " '\"") . ' }}"';
            continue;
        }

        $html .= ' ' . $key . '="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"';
    }

    return $html;
}

function parseTitle(?string $titleExpr): string
{
    if ($titleExpr === null) {
        return '';
    }

    $titleExpr = trim($titleExpr);

    if ((str_starts_with($titleExpr, "'") && str_ends_with($titleExpr, "'"))
        || (str_starts_with($titleExpr, '"') && str_ends_with($titleExpr, '"'))) {
        return stripcslashes(substr($titleExpr, 1, -1));
    }

    if (preg_match('/^\$title\s*=\s*(.+)$/s', $titleExpr, $match)) {
        return parseTitle(trim($match[1]));
    }

    return '{{ ' . trim($titleExpr, " '\"") . ' }}';
}

function buildRouteLink(array $args): string
{
    $routeName = trim($args[0], " '\"");
    $title = parseTitle(extractNamedArg($args, 'title', $args[1] ?? "''"));
    $parameters = extractNamedArg($args, 'parameters', '[]');
    $attributes = parseAttributesArray(extractNamedArg($args, 'attributes'));

    $href = buildRouteHref($routeName, $parameters);

    return '<a href="' . $href . '"' . attributesToHtml($attributes) . '>' . $title . '</a>';
}

function buildPlainLink(array $args): string
{
    $url = trim($args[0], " '\"");
    $title = parseTitle(extractNamedArg($args, 'title', $args[1] ?? "''"));
    $attributes = parseAttributesArray(extractNamedArg($args, 'attributes'));

    return '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '"' . attributesToHtml($attributes) . '>' . $title . '</a>';
}

function buildRouteHref(string $routeName, string $parameters): string
{
    $parameters = trim($parameters);

    if ($parameters === '[]' || $parameters === '') {
        return "{{ route('{$routeName}') }}";
    }

    if (preg_match('/^\[(.+)\]$/s', $parameters, $match)) {
        $inner = trim($match[1]);

        return "{{ route('{$routeName}', [{$inner}]) }}";
    }

    return "{{ route('{$routeName}', {$parameters}) }}";
}
