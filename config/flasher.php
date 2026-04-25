<?php

return [

    'default' => 'theme.facebook',

    'themes' => [

        'ios' => [

            'scripts' => [
                '/vendor/flasher/flasher.min.js',
                '/vendor/flasher/themes/ios/ios.min.js',
            ],

            'styles' => [
                '/vendor/flasher/themes/ios/ios.min.css',
            ],

            'options' => [
                'position' => 'center-center',
                'timeout' => 4000,
                'closeButton' => true,
            ],

        ],

    ],

];