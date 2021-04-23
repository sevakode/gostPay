<?php namespace App\Interfaces;

use App\Models\Role;

interface OptionsPermissions
{
    const
        OWNER = [
        'title' => 'Owner',
        'slug' => 'owner',
        'roles' => [
            Role::MANAGER,
            Role::ADMIN,
            Role::MAIN_USER,
            Role::USER
        ]
    ],
        DEMO = [
        'title' => 'Demo',
        'slug' => 'demo'
    ],
        ACCESS_TO_INVISIBLE = [
        'title' => 'Доступ к неведимке',
        'slug' => 'access-to-invisible'
    ],
        ACCESS_TO_PROFILE = [
        'title' => 'Доступ к профилю',
        'slug' => 'access-to-profile'
    ],
        ACCESS_TO_MANAGER = [
        'title' => 'Доступ менеджера',
        'slug' => 'access-to-manager'
    ],
        ACCESS_TO_ADD_CARDS = [
        'title' => 'Доступ к добавлению карт',
        'slug' => 'access-to-add-credit-cards'
    ],
        ACCESS_TO_CREATE_CARDS = [
        'title' => 'Доступ к созданию карт',
        'slug' => 'access-to-create-credit-cards'
    ],
        ACCESS_TO_REMOVE_CARDS = [
        'title' => 'Доступ к удалению карт',
        'slug' => 'access-to-add-remove-cards'
    ],
        ACCESS_TO_CLOSE_CARDS = [
        'title' => 'Доступ к закрытию карт',
        'slug' => 'access-to-add-close-cards'
    ];

    const
        ACCESS_TO_ALL_CARDS_COMPANY = [
            'title' => 'Доступ ко всем картам',
            'slug' => 'access-to-all-cards-company'
    ],
        ACCESS_TO_ALL_USERS_COMPANY = [
            'title' => 'Доступ ко всем картам юзера',
            'slug' => 'access-to-all-users-company'
    ],
        ACCESS_TO_CREATE_COMPANY = [
            'title' => 'Доступ к открытиям компаний',
            'slug' => 'access-to-create-company'
    ],
        ACCESS_TO_LOGOUT_COMPANY = [
            'title' => 'Доступ к выходу из компании',
            'slug' => 'access-to-logout-company'
    ],
        ACCESS_TO_UPDATE_COMPANY = [
            'title' => 'Доступ к изменинию компании',
            'slug' => 'access-to-update-company'
    ],
        ACCESS_TO_SHOW_COMPANY = [
            'title' => 'Доступ к просмотру компании',
            'slug' => 'access-to-show-company'
    ],
        ACCESS_TO_ALL_COMPANY = [
            'title' => 'Доступ ко всем компаниям',
            'slug' => 'access-to-all-company'
    ],
        ACCESS_TO_INSERT_COMPANY = [
            'title' => 'Доступ к возможности внесении данных компании',
            'slug' => 'access-to-insert-company'
    ];

    const
        ACCESS_TO_CREATE_PROJECTS_COMPANY = [
            'title' => 'Доступ к созданию проекта',
            'slug' => 'access-to-create-projects-company'
        ],
        ACCESS_TO_UPDATE_PROJECTS_COMPANY = [
            'title' => 'Доступ к обновлении проекта ',
            'slug' => 'access-to-update-projects-company'
        ],
        ACCESS_TO_SHOW_PROJECTS_COMPANY = [
            'title' => 'Доступ к просмотру проекта',
            'slug' => 'access-to-show-projects-company'
        ],
        ACCESS_TO_ALL_PROJECTS_COMPANY = [
            'title' => 'Доступ ко всем проектам компании',
            'slug' => 'access-to-all-projects-company'
        ],
        ACCESS_TO_ADD_PROJECTS_COMPANY = [
            'title' => 'доступ к добавлении проектов',
            'slug' => 'access-to-add-projects-company'
        ];

    const
        ADMIN_ROLE_SET = [
        'title' => 'Набор выдачи прав (Админ)',
        'slug' => 'admin-role-set',
        'roles' => [
            Role::ADMIN,
            Role::MAIN_USER,
            Role::USER,
        ]
    ],
        MANAGER_ROLE_SET = [
        'title' => 'Набор выдачи прав (Менеджер)',
        'slug' => 'manager-role-set',
        'roles' => [
            Role::MAIN_USER,
            Role::USER
        ]
    ];


    const ACCESS_TO_REMOVE_USERS = [
        'title' => 'Доступ к удалению пользователей',
        'slug' => 'access_to_remove_users',
        ];

    const ALL = [
        self::OWNER,
        self::DEMO,
        self::ADMIN_ROLE_SET,
        self::MANAGER_ROLE_SET,

        self::ACCESS_TO_PROFILE,
        self::ACCESS_TO_MANAGER,
        self::ACCESS_TO_ADD_CARDS,
        self::ACCESS_TO_CREATE_CARDS,
        self::ACCESS_TO_REMOVE_CARDS,
        self::ACCESS_TO_CLOSE_CARDS,
        self::ACCESS_TO_ALL_CARDS_COMPANY,
        self::ACCESS_TO_ALL_USERS_COMPANY,

        self::ACCESS_TO_CREATE_COMPANY,
        self::ACCESS_TO_LOGOUT_COMPANY,
        self::ACCESS_TO_ALL_COMPANY,

        self::ACCESS_TO_REMOVE_USERS,

        self::ACCESS_TO_UPDATE_COMPANY,
        self::ACCESS_TO_SHOW_COMPANY,
        self::ACCESS_TO_INSERT_COMPANY,

        self::ACCESS_TO_CREATE_PROJECTS_COMPANY,
        self::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
        self::ACCESS_TO_SHOW_PROJECTS_COMPANY,
        self::ACCESS_TO_ALL_PROJECTS_COMPANY,
        self::ACCESS_TO_ADD_PROJECTS_COMPANY,

        self::ACCESS_TO_INVISIBLE,
    ];
}
