<?php

return [
    'images' => [
        'default' => [
            'path' => 'images/default',
            'max_size' => 1024,
        ],

        'user' => [
            'cover_photo' => [
                'path' => 'image/user/cover-photo',
                'max_size' => 1024,
            ],
            'display_picture' => [
                'path' => 'image/user/display-picture',
                'max_size' => 1024,
            ]
        ],

        'estate' => [
            'path' => 'image/estate',
            'max_size' => 1024,
        ]
    ],
    'other' => [
        'path' => 'other'
    ],
    'ftp_http_access_url' => env('FTP_HTTP_ACCESS_URL', ''),
];
