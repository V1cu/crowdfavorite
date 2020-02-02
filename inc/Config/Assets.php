<?php

return [
    'styles' => [
        [
            'id' => 'google-fonts',
            'href' => 'https://fonts.googleapis.com/css?family=Poppins:400,700|Lato:300,400,700&display=swap',
            'deps' => [],
            'ver' => '1.0.0'
        ],
        [
            'id' => 'app',
            'href' => get_stylesheet_uri(),
            'deps' => [],
            'ver' => wp_get_theme()->get('Version')
        ]
    ],

    'scripts' => [
        [
            'id' => 'app',
            'src' => get_template_directory_uri() . '/scripts.js',
            'deps' => [],
            'ver' => '1.0.0',
            'bot' => true
        ]
    ]
];
