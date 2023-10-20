<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    | Here you can change the default title of your admin panel.
    |
    */

    'title' => 'Tablar',
    'title_prefix' => '',
    'title_postfix' => '',
    'bottom_title' => 'Tablar',
    'current_version' => 'v2.9',


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    */

    'logo' => '<b>Tab</b>LAR',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can set up an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'assets/logo.svg',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look at the layout section here:
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_light_sidebar' => null,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,
    'layout_class' => 'layout-fluid', //layout-fluid, layout-boxed, default is also available

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions, you can look at the auth classes section here:
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions, you can look at the admin panel classes here:
    |
    */

    'classes_body' => '',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions, you can look at the urls section here:
    |
    */

    'use_route_url' => true,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password.request',
    'password_email_url' => 'password.email',
    'profile_url' => false,
    'setting_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Display Alert
    |--------------------------------------------------------------------------
    |
    | Display Alert Visibility.
    |
    */
    'display_alert' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    |
    */

    'menu' => [
        // Navbar items:
        [
            'text' => 'Home',
            'icon' => 'ti ti-home',
            'url' => '/home'
        ],
        [
            'text' => 'Users',
            'icon' => 'ti ti-user',
            'url' => '/user'
        ],
        [
            'text' => 'Bidang Keuangan',
            'url' => '#',
            'icon' => 'ti ti-mail',
            'submenu' => [
                [
                    'text' => 'Surat Masuk',
                    'url' => '/keu-surat-masuk',
                ],
                [
                    'text' => 'Surat Keluar',
                    'url' => '/keu-surat-keluar',
                ],
                [
                    'text' => 'Bendahara Pengeluaran',
                    'url' => '/keu-bendahara-pengeluaran',
                ],
                [
                    'text' => 'Bendahara Penerimaan',
                    'url' => '/keu-bendahara-penerimaan',
                ],
                [
                    'text' => 'Pejabat Pengadaan',
                    'url' => '/keu-pejabat-pengadaan',
                ],
                [
                    'text' => 'Pejabat Pembuat Komitmen',
                    'url' => '/keu-ppk',
                ],
                [
                    'text' => 'Kuasa Pengguna Anggaran',
                    'url' => '/keu-kuasa-pengguna-anggaran',
                ],
            ],
        ],
        [
            'text' => 'Bidang Kesyabadaran',
            'url' => '#',
            'icon' => 'ti ti-mail',
            'submenu' => [
                [
                    'text' => 'Kesyabandaran',
                    'url' => '/kesyabandaran',
                ],
                [
                    'text' => 'Surat Masuk',
                    'url' => '/kesya-surat-masuk',
                ],
                [
                    'text' => 'Surat Keluar',
                    'url' => '/kesya-surat-keluar',
                ],
                [
                    'text' => 'Tertib Banar',
                    'url' => '/kesya-tertib-banar',
                ],
                [
                    'text' => 'Patroli',
                    'url' => '/kesya-patroli',
                ],
                [
                    'text' => 'Dokumen Kapal',
                    'url' => '/kesya-dokumen-kapal',
                ],
                [
                    'text' => 'Dokumen Awak Kapal',
                    'url' => '/kesya-dokumen-awak-kapal',
                ]
            ]
        ],
        [
            'text' => 'BMN dan Persediaan',
            'url' => '#',
            'icon' => 'ti ti-mail',
            'submenu' => [
                [
                    'text' => 'Surat Masuk',
                    'url' => '/bmn-surat-masuk',
                ],
                [
                    'text' => 'Surat Keluar',
                    'url' => '/bmn-surat-keluar',
                ],
                [
                    'text' => 'Bendahara Materil',
                    'url' => '/bmn-bendahara-materil',
                ],
                [
                    'text' => 'Pengelola BMN',
                    'url' => '/bmn-pengelola-bmn',
                ],
                [
                    'text' => 'Smart UPP',
                    'url' => '/bmn-smart-uup-benete',
                ]
            ]
        ],
        [
            'text' => 'Bidang Kepegawaian TU',
            'url' => '#',
            'icon' => 'ti ti-mail',
            'submenu' => [
                [
                    'text' => 'Surat Masuk',
                    'url' => '/tu-surat-masuk',
                ],
                [
                    'text' => 'Surat Keluar',
                    'url' => '/tu-surat-keluar',
                ],
                [
                    'text' => 'Surat Tugas',
                    'url' => '/tu-surat-tugas',
                ],
                [
                    'text' => 'Kontrak Kerja Sama',
                    'url' => '/tu-kontrak-kerja-sama',
                ]
            ]
        ],
        [
            'text' => 'Bidang Kepelabuhan',
            'url' => '#',
            'icon' => 'ti ti-mail',
            'submenu' => [
                [
                    'text' => 'Surat Masuk',
                    'url' => '/pelabuhan-surat-masuk',
                ],
                [
                    'text' => 'Surat Keluar',
                    'url' => '/pelabuhan-surat-keluar',
                ],
                [
                    'text' => 'LALA',
                    'url' => '/pelabuhan-lala',
                ],
                [
                    'text' => 'Fasilitas Pelabuhan',
                    'url' => '/pelabuhan-fasilitas-pelabuhan',
                ],
                [
                    'text' => 'Keagenan',
                    'url' => '/pelabuhan-keagenan',
                ],
                [
                    'text' => 'PBM',
                    'url' => '/pelabuhan-pbm',
                ],
                [
                    'text' => 'TKBM/JTS',
                    'url' => '/pelabuhan-tkbm',
                ]
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    |
    */

    'filters' => [
        TakiElias\Tablar\Menu\Filters\GateFilter::class,
        TakiElias\Tablar\Menu\Filters\HrefFilter::class,
        TakiElias\Tablar\Menu\Filters\SearchFilter::class,
        TakiElias\Tablar\Menu\Filters\ActiveFilter::class,
        TakiElias\Tablar\Menu\Filters\ClassesFilter::class,
        TakiElias\Tablar\Menu\Filters\LangFilter::class,
        TakiElias\Tablar\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Vite
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Vite support.
    |
    | For detailed instructions you can look the Vite here:
    | https://laravel-vite.dev
    |
    */

    'vite' => true,
];
