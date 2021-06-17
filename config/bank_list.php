<?php

use App\Classes\BankMain;

return [
    'info' => [
        [
            'title' => 'Tochkabank',
            'icon' => 'media/gp/bank/tochkabank.svg',
            'bin' => BankMain::TOCHKABANK_BIN,
            'url' => 'https://enter.tochka.com',
            'rsUrl' => 'https://enter.tochka.com/uapi',
            'apiVersion' => 'v1.0',
        ],
        [
            'title' => 'Tinkoff',
            'icon' => 'media/gp/bank/tinkoff.svg',
            'bin' => BankMain::TINKOFF_BIN,
            'url' => 'https://business.tinkoff.ru',
            'rsUrl' => 'https://business.tinkoff.ru/openapi',
            'apiVersion' => 'v3',
        ],
        [
            'title' => 'Gost',
            'icon' => 'media/logos/logo-light.svg',
            'bin' => '000001',
            'url' => 'https://gp.gost.agency',
            'rsUrl' => 'https://gp.gost.agency/api',
            'apiVersion' => 'v3',
        ]
    ]

];
