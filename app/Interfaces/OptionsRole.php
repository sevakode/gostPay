<?php namespace App\Interfaces;

use App\Models\Permission;
use App\Models\Role;

interface OptionsRole
{
    const OWNER = [
        'title' => 'Поддержка',
        'slug' => 'owner',
        'permissions' => [
            Permission::OWNER,

            Permission::ACCESS_TO_INVISIBLE,
            Permission::ACCESS_TO_SHOW_INVISIBLE,

            Permission::ADMIN_ROLE_SET,
            Permission::MANAGER_ROLE_SET,
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_MANAGER,
            Permission::ACCESS_TO_ADD_CARDS,
            Permission::ACCESS_TO_CREATE_CARDS,
            Permission::ACCESS_TO_REMOVE_CARDS,
            Permission::ACCESS_TO_CLOSE_CARDS,
            Permission::ACCESS_TO_ALL_CARDS_COMPANY,
            Permission::ACCESS_TO_ALL_USERS_COMPANY,

            Permission::ACCESS_TO_REMOVE_USERS,

            Permission::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            Permission::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ALL_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ADD_PROJECTS_COMPANY,

            Permission::ACCESS_TO_CREATE_COMPANY,
            Permission::ACCESS_TO_LOGOUT_COMPANY,
            Permission::ACCESS_TO_ALL_COMPANY,

            Permission::ACCESS_TO_EDIT_INVOICE,
            Permission::ACCESS_TO_INSERT_INVOICE,

            Permission::ACCESS_TO_UPDATE_COMPANY,
            Permission::ACCESS_TO_SHOW_COMPANY,
            Permission::ACCESS_TO_INSERT_COMPANY,

            Permission::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PROJECTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PROJECTS,
        ]
    ],
        MANAGER = [
        'title' => 'Менеджер',
        'permissions' => [
            Permission::ADMIN_ROLE_SET,
            Permission::MANAGER_ROLE_SET,
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_MANAGER,

            Permission::ACCESS_TO_INVISIBLE,
            Permission::ACCESS_TO_SHOW_INVISIBLE,

            Permission::ACCESS_TO_ADD_CARDS,
//            Permission::ACCESS_TO_CREATE_CARDS,
            Permission::ACCESS_TO_REMOVE_CARDS,
            Permission::ACCESS_TO_CLOSE_CARDS,
            Permission::ACCESS_TO_ALL_USERS_COMPANY,
            Permission::ACCESS_TO_ALL_CARDS_COMPANY,

            Permission::ACCESS_TO_REMOVE_USERS,

            Permission::ACCESS_TO_UPDATE_COMPANY,
            Permission::ACCESS_TO_SHOW_COMPANY,
            Permission::ACCESS_TO_INSERT_COMPANY,

            Permission::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            Permission::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ALL_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ADD_PROJECTS_COMPANY,

            Permission::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PROJECTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PROJECTS,
        ]
    ],
        ADMIN = [
        'title' => 'Админ',
        'permissions' => [
            Permission::MANAGER_ROLE_SET,
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_MANAGER,
            Permission::ACCESS_TO_ADD_CARDS,
            Permission::ACCESS_TO_REMOVE_CARDS,
            Permission::ACCESS_TO_ALL_USERS_COMPANY,
            Permission::ACCESS_TO_ALL_CARDS_COMPANY,

            Permission::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            Permission::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ALL_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ADD_PROJECTS_COMPANY,

            Permission::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PROJECTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PROJECTS,
        ]
    ],
        DEMO = [
        'title' => 'Демо',
        'permissions' => [
            Permission::DEMO,
            Permission::ADMIN_ROLE_SET,
            Permission::MANAGER_ROLE_SET,
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_MANAGER,

            Permission::ACCESS_TO_ALL_USERS_COMPANY,

            Permission::ACCESS_TO_ALL_CARDS_COMPANY,

            Permission::ACCESS_TO_ALL_PROJECTS_COMPANY,
            Permission::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            Permission::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
        ]

    ],
        MAIN_USER = [
        'title' => 'Пользователь+',
        'slug' => 'user-plus',
        'permissions' => [
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_ADD_CARDS,
            Permission::ACCESS_TO_ADD_PROJECTS_COMPANY,

            Permission::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PROJECTS,
        ],
    ],
        USER = [
        'title' => 'Пользователь',
        'slug' => 'user',
        'permissions' => [
            Permission::ACCESS_TO_PROFILE,

            Permission::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            Permission::ACCESS_TO_SHOW_CHART_USER_PROJECTS,
        ]
    ];

    const ALL = [
        self::OWNER,
        self::DEMO,
        self::MANAGER,
        self::USER,
        self::ADMIN,
        self::MAIN_USER,
    ];
}
