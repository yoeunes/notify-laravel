<?php

return [
    'default' => 'toastr',

    'exception' => false,

    'session_key' => 'notify::_notifications',

    'max_items' => 3,

    'notifiers' => [
        'alert' => [
            'container' => 'alert_container',
            'success_class' => 'success',
            'error_class' => '',
            'info_class' => '',
            'warning_class' => '',
        ],
        'bootstrap' => [
        ],
        'toastr' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js',
            ],
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css',
            ],
            'options' => [
                'closeButton' => true,
            ],
        ],
        'pnotify' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js',
            ],
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css',
                'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.brighttheme.css',
            ],
            'replace' => [
                'success' => 'failure',
            ],
        ],
    ],
];
