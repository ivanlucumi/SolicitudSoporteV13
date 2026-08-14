<?php
$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$count = 0;
foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    
    // Check if the file contains a POST form
    if (preg_match('/<form[^>]*method\s*=\s*[\'"]?POST[\'"]?[^>]*>/i', $content)) {
        // If it doesn't contain any csrf token
        if (!preg_match('/(@csrf|csrf_field)/i', $content)) {
            // Replace the first occurrence of the POST form, or just add @csrf after it
            $new_content = preg_replace('/(<form[^>]*method\s*=\s*[\'"]?POST[\'"]?[^>]*>)/i', "$1\n    @csrf\n", $content);
            if ($new_content !== $content) {
                file_put_contents($path, $new_content);
                echo "Added @csrf to: " . str_replace(__DIR__, '', $path) . "\n";
                $count++;
            }
        }
    }
}
echo "Total files updated: $count\n";
