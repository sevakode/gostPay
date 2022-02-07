<?php namespace App\Interfaces;

use App\Models\Permission;
use App\Models\Role;

interface OptionsRole
{
    const OWNER = [
        'title' => 'Поддержка',
        'slug' => 'owner',
        'permissions' => [
            OptionsPermissions::OWNER,

            OptionsPermissions::ACCESS_TO_INVISIBLE,
            OptionsPermissions::ACCESS_TO_SHOW_INVISIBLE,

            OptionsPermissions::MANAGER_ROLE_SET,
            OptionsPermissions::ADMIN_ROLE_SET,
            OptionsPermissions::ACCESS_TO_PROFILE,
            OptionsPermissions::ACCESS_TO_MANAGER,
            OptionsPermissions::ACCESS_TO_ADD_CARDS,
            OptionsPermissions::ACCESS_TO_CREATE_CARDS,
            OptionsPermissions::ACCESS_TO_REMOVE_CARDS,
            OptionsPermissions::ACCESS_TO_CLOSE_CARDS,
            OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY,
            OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY,

            OptionsPermissions::ACCESS_TO_REMOVE_USERS,

            OptionsPermissions::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_ALL_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_ADD_PROJECTS_COMPANY,

            OptionsPermissions::ACCESS_TO_CREATE_COMPANY,
            OptionsPermissions::ACCESS_TO_LOGOUT_COMPANY,
            OptionsPermissions::ACCESS_TO_ALL_COMPANY,

            OptionsPermissions::ACCESS_TO_EDIT_INVOICE,
            OptionsPermissions::ACCESS_TO_INSERT_INVOICE,

            OptionsPermissions::ACCESS_TO_UPDATE_COMPANY,
            OptionsPermissions::ACCESS_TO_SHOW_COMPANY,
            OptionsPermissions::ACCESS_TO_INSERT_COMPANY,

            OptionsPermissions::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PROJECTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PROJECTS,

            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY_USERS ,

            OptionsPermissions::ACCESS_TO_REVENUE_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_EXPENDITURE_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_REVENUE_BALANCE_FOR_COMPANY_USERS ,
            OptionsPermissions::ACCESS_TO_EXPENDITURE_BALANCE_FOR_COMPANY_USERS ,
        ]
    ],
        MANAGER = [
        'title' => 'Менеджер',
        'permissions' => [
            OptionsPermissions::MANAGER_ROLE_SET,
            OptionsPermissions::ADMIN_ROLE_SET,
            OptionsPermissions::ACCESS_TO_PROFILE,
            OptionsPermissions::ACCESS_TO_MANAGER,

            OptionsPermissions::ACCESS_TO_INVISIBLE,
            OptionsPermissions::ACCESS_TO_SHOW_INVISIBLE,

            OptionsPermissions::ACCESS_TO_ADD_CARDS,
//            OptionsPermissions::ACCESS_TO_CREATE_CARDS,
            OptionsPermissions::ACCESS_TO_REMOVE_CARDS,
            OptionsPermissions::ACCESS_TO_CLOSE_CARDS,
            OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY,
            OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY,

            OptionsPermissions::ACCESS_TO_REMOVE_USERS,

            OptionsPermissions::ACCESS_TO_UPDATE_COMPANY,
            OptionsPermissions::ACCESS_TO_SHOW_COMPANY,
            OptionsPermissions::ACCESS_TO_INSERT_COMPANY,

            OptionsPermissions::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_ALL_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_ADD_PROJECTS_COMPANY,

            OptionsPermissions::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PROJECTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PROJECTS,

            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY_USERS ,

            OptionsPermissions::ACCESS_TO_REVENUE_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_EXPENDITURE_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_REVENUE_BALANCE_FOR_COMPANY_USERS ,
            OptionsPermissions::ACCESS_TO_EXPENDITURE_BALANCE_FOR_COMPANY_USERS ,
        ]
    ],
        ADMIN = [
        'title' => 'Админ',
        'permissions' => [
            OptionsPermissions::ADMIN_ROLE_SET,
            OptionsPermissions::ACCESS_TO_PROFILE,
            OptionsPermissions::ACCESS_TO_MANAGER,
            OptionsPermissions::ACCESS_TO_ADD_CARDS,
            OptionsPermissions::ACCESS_TO_REMOVE_CARDS,
            OptionsPermissions::ACCESS_TO_CLOSE_CARDS,
            OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY,
            OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY,

            OptionsPermissions::ACCESS_TO_REMOVE_USERS,

            OptionsPermissions::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_ALL_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_ADD_PROJECTS_COMPANY,

            OptionsPermissions::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_COMPANY_USERS_PROJECTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PROJECTS,

            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY_USERS ,

            OptionsPermissions::ACCESS_TO_REVENUE_BALANCE_FOR_COMPANY_USERS ,
            OptionsPermissions::ACCESS_TO_EXPENDITURE_BALANCE_FOR_COMPANY_USERS ,
        ]
    ],
        DEMO = [
        'title' => 'Демо',
        'permissions' => [
            OptionsPermissions::DEMO,
            OptionsPermissions::MANAGER_ROLE_SET,
            OptionsPermissions::ADMIN_ROLE_SET,
            OptionsPermissions::ACCESS_TO_PROFILE,
            OptionsPermissions::ACCESS_TO_MANAGER,

            OptionsPermissions::ACCESS_TO_ALL_USERS_COMPANY,

            OptionsPermissions::ACCESS_TO_ALL_CARDS_COMPANY,

            OptionsPermissions::ACCESS_TO_ALL_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
        ]

    ],
        MAIN_USER = [
        'title' => 'Пользователь+',
        'slug' => 'user-plus',
        'permissions' => [
            OptionsPermissions::ACCESS_TO_PROFILE,
            OptionsPermissions::ACCESS_TO_ADD_CARDS,
            OptionsPermissions::ACCESS_TO_ADD_PROJECTS_COMPANY,

            OptionsPermissions::ACCESS_TO_SHOW_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY,
            OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY,

            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PROJECTS,

            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY ,
            OptionsPermissions::ACCESS_TO_SHOW_BALANCE_FOR_COMPANY_USERS ,

            OptionsPermissions::ACCESS_TO_CLOSE_CARDS,
//            OptionsPermissions::ACCESS_TO_REMOVE_CARDS,
        ],
    ],
        USER = [
        'title' => 'Пользователь',
        'slug' => 'user',
        'permissions' => [
            OptionsPermissions::ACCESS_TO_PROFILE,

            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PAYMENTS,
            OptionsPermissions::ACCESS_TO_SHOW_CHART_USER_PROJECTS,
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
