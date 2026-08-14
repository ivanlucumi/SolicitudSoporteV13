@extends('layouts.ensayo')

@section('title', 'Acortador Url')

@section('content')
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Panel principal -->
                <div class="panel panel-primary" >
                    <div class="panel-heading" style="background-color: #002147;">
                        <h3 class="panel-title" >
                            <i class="glyphicon glyphicon-link"></i> Acortador de URLs
                        </h3>
                    </div>
                    <div class="panel-body">
                        <!-- Formulario -->
                        <form action="{{ route('shorten') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">URL para acortar</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                        <input type="url" class="form-control" id="url" name="url" 
                                               placeholder="https://ejemplo.com" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-scissors"></i> Acortar URL
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Resultado -->
                        @if(session('shortened_url'))
                            <div class="result-section well" style="margin-top: 20px;">
                                <h4><i class="glyphicon glyphicon-ok-circle text-success"></i> URL acortada generada:</h4>
                                
                                <div class="input-group" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" id="shortened-url" 
                                           value="{{ session('shortened_url') }}" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" onclick="copyToClipboard()" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Copiar al portapapeles">
                                            <i class="glyphicon glyphicon-copy"></i> Copiar
                                        </button>
                                    </span>
                                </div>
                                
                                <div class="text-center">
                                    <a href="{{ session('shortened_url') }}" target="_blank" 
                                       class="btn btn-default" style="margin-right: 10px;">
                                        <i class="glyphicon glyphicon-share"></i> Visitar URL
                                    </a>
                                    
                                </div>
                                
                            </div>
                            
                            
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

 
    @section('styles')
    <style>
        .panel-primary {
            border-color: #337ab7;
            margin-top: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .panel-primary .panel-heading {
            background-color: #337ab7;
            border-color: #337ab7;
            font-size: 18px;
        }
        
        .form-horizontal .control-label {
            text-align: left;
            padding-top: 7px;
        }
        
        .result-section {
            background: #f9f9f9;
            border-left: 4px solid #5cb85c;
            padding: 15px;
        }
        
        #shortened-url {
            font-family: monospace;
            background: #fff;
            cursor: text;
        }
        
        .input-group-addon {
            background-color: #f8f9fa;
        }
        
        #qrCanvas {
            border: 1px solid #ddd;
            background: white;
            padding: 10px;
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .form-horizontal .control-label {
                text-align: left;
                margin-bottom: 5px;
            }
            
            .col-sm-9, .col-sm-3 {
                width: 100%;
            }
            
            .col-sm-offset-3 {
                margin-left: 0;
            }
        }
    </style>
    @endsection
    <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const img = document.getElementById('qrImage');
                                
                                img.onload = function() {
                                    const canvas = document.createElement('canvas');
                                    const context = canvas.getContext('2d');
                            
                                    canvas.width = img.naturalWidth;
                                    canvas.height = img.naturalHeight;
                            
                                    context.drawImage(img, 0, 0);
                            
                                    const link = document.createElement('a');
                                    link.href = canvas.toDataURL('image/png');
                                    link.download = 'qrcode.png';
                                    link.click();
                                }
                            });
                            </script>
@endsection