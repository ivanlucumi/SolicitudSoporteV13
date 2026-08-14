<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de URL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Estadísticas de URL</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h2 class="h5">URL original:</h2>
                                <p><a href="{{ $shortenedUrl->original_url }}" target="_blank">
                                    {{ Str::limit($shortenedUrl->original_url, 50) }}
                                </a></p>
                            </div>
                            <div class="col-md-6">
                                <h2 class="h5">URL acortada:</h2>
                                <p><a href="{{ url($shortenedUrl->short_code) }}" target="_blank">
                                    {{ url($shortenedUrl->short_code) }}
                                </a></p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Total de clicks:</strong> {{ $shortenedUrl->click_count }}
                        </div>

                        <h3 class="h5 mt-4">Últimos accesos:</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>IP</th>
                                        <th>Dispositivo/Navegador</th>
                                        <th>Referencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($clicks as $click)
                                        <tr>
                                            <td>{{ $click->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $click->ip_address }}</td>
                                            <td>{{ Str::limit($click->user_agent, 50) }}</td>
                                            <td>{{ $click->referer ? Str::limit($click->referer, 30) : 'Directo' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No hay registros de clicks</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $clicks->links() }}
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>