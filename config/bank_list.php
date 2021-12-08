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
            'title' => 'Qiwi',
            'icon' => 'media/gp/bank/qiwi.svg',
            'bin' => BankMain::QIWI_BIN,
            'url' => 'https://edge.qiwi.com',
            'rsUrl' => 'https://edge.qiwi.com',
            'apiVersion' => 'v2',
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
