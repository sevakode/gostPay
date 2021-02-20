<?php namespace App\Interfaces;

use App\Models\Permission;
use App\Models\Role;

interface OptionsRole
{
    const OWNER = [
        'title' => 'Owner',
        'permissions' => [
            Permission::OWNER,
            Permission::ADMIN_ROLE_SET,
            Permission::MANAGER_ROLE_SET,

            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_MANAGER,
            Permission::ACCESS_TO_ADD_CARDS,
            Permission::ACCESS_TO_REMOVE_CARDS,
            Permission::ACCESS_TO_ALL_CARDS_COMPANY,
            Permission::ACCESS_TO_ALL_USERS_COMPANY,

            Permission::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            Permission::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ALL_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ADD_PROJECTS_COMPANY,

            Permission::ACCESS_TO_CREATE_COMPANY,
            Permission::ACCESS_TO_LOGOUT_COMPANY,
            Permission::ACCESS_TO_ALL_COMPANY,

            Permission::ACCESS_TO_UPDATE_COMPANY,
            Permission::ACCESS_TO_SHOW_COMPANY,
            Permission::ACCESS_TO_INSERT_COMPANY,
        ]
    ],
        ADMIN = [
        'title' => 'Admin',
        'permissions' => [
            Permission::ADMIN_ROLE_SET,
            Permission::MANAGER_ROLE_SET,
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_MANAGER,
            Permission::ACCESS_TO_ADD_CARDS,
            Permission::ACCESS_TO_REMOVE_CARDS,
            Permission::ACCESS_TO_ALL_USERS_COMPANY,
            Permission::ACCESS_TO_ALL_CARDS_COMPANY,

            Permission::ACCESS_TO_UPDATE_COMPANY,
            Permission::ACCESS_TO_SHOW_COMPANY,
            Permission::ACCESS_TO_INSERT_COMPANY,

            Permission::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            Permission::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ALL_PROJECTS_COMPANY,
            Permission::ACCESS_TO_ADD_PROJECTS_COMPANY,
        ]

    ],
        DEMO = [
        'title' => 'Demo',
        'permissions' => [
            Permission::DEMO,
            Permission::ADMIN_ROLE_SET,
            Permission::MANAGER_ROLE_SET,
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_MANAGER,
            Permission::ACCESS_TO_ADD_CARDS,
            Permission::ACCESS_TO_REMOVE_CARDS,
            Permission::ACCESS_TO_ALL_USERS_COMPANY,
            Permission::ACCESS_TO_ALL_CARDS_COMPANY,
        ]

    ],
        MANAGER = [
        'title' => 'Manager',
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
        ]
    ],
        MAIN_USER = [
        'title' => 'Main User',
        'permissions' => [
            Permission::ACCESS_TO_PROFILE,
            Permission::ACCESS_TO_ADD_CARDS,
            Permission::ACCESS_TO_ADD_PROJECTS_COMPANY,
        ],
    ],
        USER = [
        'title' => 'User',
        'permissions' => [
            Permission::ACCESS_TO_PROFILE,
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
