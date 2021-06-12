<?php
// Header menu
use App\Interfaces\OptionsPermissions;

return [

    'items' => [
        [],
        [
            'title' => 'Dashboard',
            'root' => true,
            'redirect' => true,
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'Company',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Управление Компаниями',
                        'page' => 'company',
                        'icon' => 'media/svg/icons/Shopping/Sort3.svg',
                        'permission' => OptionsPermissions::ACCESS_TO_ALL_COMPANY['slug'],
                    ],
                    [
                        'title' => 'Создать компанию',
                        'page' => 'company/create',
                        'icon' => 'media/svg/icons/Navigation/Plus.svg',
                        'permission' => OptionsPermissions::ACCESS_TO_CREATE_COMPANY['slug'],
                    ],
                    [
                        'title' => 'Моя компания    ',
                        'page' => 'company/edit',
                        'icon' => 'media/svg/icons/General/Settings-2.svg',
                        'permission' => OptionsPermissions::ADMIN_ROLE_SET['slug'],
                    ],
                    [
                        'title' => 'Список счетов',
                        'page' => 'company/invoices',
                        'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
                    ],
                ],
                'permission' => OptionsPermissions::ADMIN_ROLE_SET['slug'],
            ],
            'permission' => OptionsPermissions::OWNER['slug'],

        ],
        [
            'title' => 'Manager',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Управление персоналом',
                        'page' => 'manager',
                        'icon' => 'media/svg/icons/Shopping/Box2.svg',
                    ],
                    [
                        'title' => 'Добавить пользователя',
                        'page' => 'manager/user/add',
                        'icon' => 'media/svg/icons/Communication/Add-user.svg',
                    ],
                    [
                        'title' => 'Карты на закрытие',
                        'description' => 'Список карт в ожидании на закрытие',
                        'page' => 'manager/cards/closing_list',
                        'icon' => 'media/svg/icons/Communication/Clipboard-list.svg',
                        'permission' => OptionsPermissions::ACCESS_TO_CLOSE_CARDS['slug']
                    ],
                ]
            ],
            'permission' => OptionsPermissions::ACCESS_TO_MANAGER['slug']
        ],
        [
            'title' => 'Bank',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Карты компании',
                        'page' => 'bank/cards',
                        'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
                        'permission' => OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY['slug']
                    ],
                    [
                        'title' => 'Добавить карты',
                        'page' => 'bank/cards/create',
                        'icon' => 'media/svg/icons/Navigation/Plus.svg',
                        'permission' => OptionsPermissions::ACCESS_TO_CREATE_CARDS['slug']
                    ],
                    [
                        'title' => 'Мои карты',
                        'page' => 'profile/cards',
                        'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
                    ],
                ]
            ],
        ],
        [
            'title' => 'Projects',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Проекты',
                        'description' => 'Список проектов',
                        'page' => 'projects',
                        'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
                    ],
                    [
                        'title' => 'Добавить проект',
                        'page' => 'projects/create',
                        'icon' => 'media/svg/icons/Navigation/Plus.svg',
                    ],
                ]
            ],
            'permission' => OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY['slug']
        ],
        [
            'title' => 'Admin',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Аккаунты',
                        'description' => 'Список проектов',
                        'page' => 'admin/accounts',
                        'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
                    ]
                ]
            ],
            'permission' => OptionsPermissions::OWNER['slug']
        ],
    ]

];
