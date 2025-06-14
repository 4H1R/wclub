<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3_private' => [
            'driver' => 's3',
            'key' => env('PRIVATE_AWS_ACCESS_KEY_ID'),
            'secret' => env('PRIVATE_AWS_SECRET_ACCESS_KEY'),
            'region' => env('PRIVATE_AWS_DEFAULT_REGION'),
            'bucket' => env('PRIVATE_AWS_BUCKET'),
            'url' => env('PRIVATE_AWS_URL'),
            'endpoint' => env('PRIVATE_AWS_ENDPOINT'),
            'visibility' => 'private',
            'use_path_style_endpoint' => env('PRIVATE_AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'retain_visibility' => false,
            'http' => ['verify' => false],
        ],

        's3_public' => [
            'driver' => 's3',
            'key' => env('PUBLIC_AWS_ACCESS_KEY_ID'),
            'secret' => env('PUBLIC_AWS_SECRET_ACCESS_KEY'),
            'region' => env('PUBLIC_AWS_DEFAULT_REGION'),
            'bucket' => env('PUBLIC_AWS_BUCKET'),
            'url' => env('PUBLIC_AWS_URL'),
            'endpoint' => env('PUBLIC_AWS_ENDPOINT'),
            'visibility' => 'public',
            'use_path_style_endpoint' => env('PUBLIC_AWS_USE_PATH_STYLE_ENDPOINT', false),
            'retain_visibility' => false,
            'throw' => false,
            'http' => ['verify' => false],
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
