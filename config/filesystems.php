<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            //'root'   => public_path('img'),
            'root'   => public_path('/../../public_html/img'),
        ],
        
        'reparto' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Reparto'),
            'root'   => public_path('/../../public_html/Reparto'),
        ],
        'soportes' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Soportes'),
            'root'   => public_path('/../../public_html/Soportes'),
        ],
        'circulares' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Circulares'),
            'root'   => public_path('/../../public_html/Circulares'),
        ],
        'videos' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/video'),
            'root'   => public_path('/../../public_html/video'),
        ],
        'clasificados' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Clasificados'),
            'root'   => public_path('/../../public_html/Clasificados'),
        ],
        'siniestros' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Siniestros'),
            'root'   => public_path('/../../public_html/Siniestros'),
        ],
        'teletrabajo' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Teletrabajo'),
            'root'   => public_path('/../../public_html/Teletrabajo'),
        ],
        'solicitudes' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Solicitudes'),
            'root'   => public_path('/../../public_html/Solicitudes'),
        ],
        'tanqueo' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Tanqueo'),
            'root'   => public_path('/../../public_html/Tanqueo'),
        ],
        'remoto' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Soportes'),
            'root'   => public_path('/../../public_html/SoportesRemoto'),
        ],
        'fichaRemision' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/fichaRemision'),
            'root'   => public_path('/../../public_html/fichaRemision'),
        ],
        'fichapreliminar' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/fichaPreliminar'),
            'root'   => public_path('/../../public_html/fichaPreliminar'),
        ],
        'biometria' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Biometria'),
            'root'   => public_path('/../../public_html/Biometria'),
        ],
        'ArchivoJudicial' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/IngresoArchivoJudicial'),
            'root'   => public_path('/../../public_html/IngresoArchivoJudicial'),
        ],
        //RecursosHumanos
        'RecursosHumanos' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/RecursosHumanos'),
            'root'   => public_path('/../../public_html/RecursosHumanos'),
        ],
        //FotosCarnet
        'FotosCarnet' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/img/carnet'),
            'root'   => public_path('/../../public_html/img/carnet'),
            'url' => env('APP_URL').'/img/carnet',
        ],
        //Escalafon
        'Escalafon' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/Escalafon'),
            'root'   => public_path('/../../public_html/Escalafon'),
        ],
        'VigilanciaJudicial' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/VigilanciaJudicial'),
            'root'   => public_path('/../../public_html/VigilanciaJudicial'),
        ],
        'backups' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('backups'),
            'root'   => public_path('/../../backups'),
        ],

        'public' => [
            'driver' => 'local',
            //'root'       => storage_path('../'),
            //'root' => storage_path('app/public'),
            'root'   => public_path('public/img'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'supervisionContrato' => [
            'driver' => 'local',
            //'root'   => storage_path('images'),
            'root'   => public_path('public/supervisioncontrato'),
            'root'   => public_path('/../../public_html/supervisioncontrato'),
        ],

        'contratista' => [
            'driver' => 'local',
            'root'   => file_exists(public_path('/../../public_html')) 
                        ? public_path('/../../public_html/contratista') 
                        : public_path('contratista'),
            'url'    => env('APP_URL').'/contratista',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],
         'azure'    => [
            'driver'    => 'azure',
            'sasToken'  => env('AZURE_STORAGE_SAS_TOKEN'),
            'container' => env('AZURE_STORAGE_CONTAINER'),
            'url'       => env('AZURE_STORAGE_URL'),
            'prefix'    => null,
            //'endpoint'  => env('AZURE_STORAGE_ENDPOINT'),
            'connection_string' => env('AZURE_STORAGE_CONNECTION_STRING'),
            'retry'     => [
                'tries' => 3,
                'interval' => 500,
                'increase' => 'exponential'
                ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
