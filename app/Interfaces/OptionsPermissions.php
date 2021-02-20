<?php namespace App\Interfaces;

use App\Models\Role;

interface OptionsPermissions
{
    const
        OWNER = [
        'title' => 'Owner',
        'roles' => [
            Role::ADMIN,
            Role::MANAGER,
            Role::MAIN_USER,
            Role::USER
        ]
    ],
        DEMO = [
        'title' => 'Demo'
    ],
        ACCESS_TO_PROFILE = [
        'title' => 'access to profile'
    ],
        ACCESS_TO_MANAGER = [
        'title' => 'access to manager'
    ],
        ACCESS_TO_ADD_CARDS = [
        'title' => 'access to add credit cards'
    ],
        ACCESS_TO_REMOVE_CARDS = [
        'title' => 'access to add remove cards'
    ];

    const
        ACCESS_TO_ALL_CARDS_COMPANY = [
        'title' => 'access to all cards company'
    ],
        ACCESS_TO_ALL_USERS_COMPANY = [
        'title' => 'access to all users company'
    ],
        ACCESS_TO_CREATE_COMPANY = [
            'title' => 'access to create company'
    ],
        ACCESS_TO_LOGOUT_COMPANY = [
            'title' => 'access to logout company'
    ],
        ACCESS_TO_UPDATE_COMPANY = [
            'title' => 'access to update company'
    ],
        ACCESS_TO_SHOW_COMPANY = [
            'title' => 'access to show company'
    ],
        ACCESS_TO_ALL_COMPANY = [
            'title' => 'access to all company'
    ],
        ACCESS_TO_INSERT_COMPANY = [
            'title' => 'access to insert company'
    ];

    const
        ACCESS_TO_CREATE_PROJECTS_COMPANY = [
        'title' => 'access to create projects company'
        ],
        ACCESS_TO_UPDATE_PROJECTS_COMPANY = [
        'title' => 'access to update projects company'
        ],
        ACCESS_TO_SHOW_PROJECTS_COMPANY = [
        'title' => 'access to show projects company'
        ],
        ACCESS_TO_ALL_PROJECTS_COMPANY = [
        'title' => 'access to all projects company'
        ],
        ACCESS_TO_ADD_PROJECTS_COMPANY = [
        'title' => 'access to add projects company'
        ];

    const
        ADMIN_ROLE_SET = [
        'title' => 'Admin role set',
        'roles' => [
            Role::MANAGER,
            Role::MAIN_USER,
            Role::USER,
        ]
    ],
        MANAGER_ROLE_SET = [
        'title' => 'Manager role set',
        'roles' => [
            Role::MAIN_USER,
            Role::USER
        ]
    ];

    const ALL = [
        self::OWNER,
        self::DEMO,
        self::ADMIN_ROLE_SET,
        self::MANAGER_ROLE_SET,

        self::ACCESS_TO_PROFILE,
        self::ACCESS_TO_MANAGER,
        self::ACCESS_TO_ADD_CARDS,
        self::ACCESS_TO_REMOVE_CARDS,
        self::ACCESS_TO_ALL_CARDS_COMPANY,
        self::ACCESS_TO_ALL_USERS_COMPANY,

        self::ACCESS_TO_CREATE_COMPANY,
        self::ACCESS_TO_LOGOUT_COMPANY,
        self::ACCESS_TO_ALL_COMPANY,

        self::ACCESS_TO_UPDATE_COMPANY,
        self::ACCESS_TO_SHOW_COMPANY,
        self::ACCESS_TO_INSERT_COMPANY,

        self::ACCESS_TO_CREATE_PROJECTS_COMPANY,
        self::ACCESS_TO_UPDATE_PROJECTS_COMPANY,
        self::ACCESS_TO_SHOW_PROJECTS_COMPANY,
        self::ACCESS_TO_ALL_PROJECTS_COMPANY,
        self::ACCESS_TO_ADD_PROJECTS_COMPANY,
    ];
}
