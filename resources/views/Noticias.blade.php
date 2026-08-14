@extends('layouts.ensayo')
<!--ponerle titulo a la paginga-->
@section('title', 'Misi&oacute;n')

@section('content') 

<style>
        .news-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .news-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 300px;
            transition: transform 0.3s ease;
        }
        .news-item:hover {
            transform: scale(1.05);
        }
        .news-item img {
            width: 100%;
            height: auto;
        }
        .news-item .content {
            padding: 15px;
        }
        .news-item .content h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .news-item .content p {
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .news-item .content a {
            color: #007BFF;
            text-decoration: none;
        }
        
        .news-item {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        
        
    </style>
    

 <div class="container">
        <h1 class="text-center">Sección de Noticias</h1>
        <div class="news-container">
            @foreach($news as $new)
                <div class="news-item">
                    <img src="{{ asset('storage/' . $new->image_path) }}" alt="{{ $new->title }}">
                    <div class="content">
                        <h2>{{ $new->title }}</h2>
                        <p>{{ $new->description }}</p>
                        <a href="{{ asset('storage/' . $new->document_path) }}" download>Descargar Documento</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection