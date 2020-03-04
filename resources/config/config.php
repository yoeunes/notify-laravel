<?php

return array(
    'default' => 'toastr',

    'exception' => false,

    'session_key' => 'notify::_notifications',

    'max_items' => 3,

    'notifiers' => array(
        'alert' => array(
            'container' => 'alert_container',
            'success_class' => 'success',
            'error_class' => '',
            'info_class' => '',
            'warning_class' => '',
        ),
        'bootstrap' => array(),
        'toastr' => array(
            'scripts' => array(
                'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js',
            ),
            'styles' => array(
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css',
            ),
            'options' => array(
                'closeButton' => true,
            ),
        ),
        'pnotify' => array(
            'scripts' => array(
                'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js',
            ),
            'styles' => array(
                'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css',
                'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.brighttheme.css',
            ),
            'replace' => array(
                'success' => 'failure',
            ),
        ),
    ),
);
