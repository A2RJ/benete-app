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
            'path' => 'Indonesian_Sea_and_Coast_Guard_Emblem.svg',
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
    'register_url' => ' ',
    'password_reset_url' => '',
    'password_email_url' => '',
    'profile_url' => 'edit.profile',
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
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-home',
            'url' => '/home',
            'icon_color' => 'white',
            'can' => 'admin'
        ],
        [
            'text' => 'Users',
            'icon' => 'ti ti-user',
            'url' => '/user',
            'icon_color' => 'white',
            'can' => 'admin'
        ],
        // bidang keuangan
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-home',
            'url' => '/home',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        [
            'text' => 'Surat Masuk',
            'url' => '/keu-surat-masuk',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        [
            'text' => 'Surat Keluar',
            'url' => '/keu-surat-keluar',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        [
            'text' => 'Bendahara Pengeluaran',
            'url' => '/keu-bendahara-pengeluaran',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        [
            'text' => 'Bendahara Penerimaan',
            'url' => '/keu-bendahara-penerimaan',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        [
            'text' => 'Pejabat Pengadaan',
            'url' => '/keu-pejabat-pengadaan',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        [
            'text' => 'Pejabat Pembuat Komitmen',
            'url' => '/keu-ppk',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        [
            'text' => 'Kuasa Pengguna Anggaran',
            'url' => '/keu-kuasa-pengguna-anggaran',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang keuangan'
        ],
        // bidang kesyabandaran
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-home',
            'url' => '/home',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        [
            'text' => 'Surat Masuk',
            'url' => '/kesya-surat-masuk',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        [
            'text' => 'Surat Keluar',
            'url' => '/kesya-surat-keluar',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        [
            'text' => 'Kesyabandaran',
            'url' => '/kesyabandaran',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        [
            'text' => 'Tertib Banar',
            'url' => '/kesya-tertib-banar',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        [
            'text' => 'Patroli',
            'url' => '/kesya-patroli',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        [
            'text' => 'Dokumen Kapal',
            'url' => '/kesya-dokumen-kapal',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        [
            'text' => 'Dokumen Awak Kapal',
            'url' => '/kesya-dokumen-awak-kapal',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kesyabandaran'
        ],
        // bidang pengelola bmn dan persediaan
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-home',
            'url' => '/home',
            'icon_color' => 'white',
            'can' => 'bidang pengelola bmn dan persediaan'
        ],
        [
            'text' => 'Surat Masuk',
            'url' => '/bmn-surat-masuk',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang pengelola bmn dan persediaan'
        ],
        [
            'text' => 'Surat Keluar',
            'url' => '/bmn-surat-keluar',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang pengelola bmn dan persediaan'
        ],
        [
            'text' => 'Bendahara Materil',
            'url' => '/bmn-bendahara-materil',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang pengelola bmn dan persediaan'
        ],
        [
            'text' => 'Pengelola BMN',
            'url' => '/bmn-pengelola-bmn',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang pengelola bmn dan persediaan'
        ],
        [
            'text' => 'Smart UPP',
            'url' => '/bmn-smart-uup-benete',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang pengelola bmn dan persediaan'
        ],
        // bidang kepegawaian atau tata usaha
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-home',
            'url' => '/home',
            'icon_color' => 'white',
            'can' => 'bidang kepegawaian atau tata usaha'
        ],
        [
            'text' => 'Surat Masuk',
            'url' => '/tu-surat-masuk',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepegawaian atau tata usaha'
        ],
        [
            'text' => 'Surat Keluar',
            'url' => '/tu-surat-keluar',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepegawaian atau tata usaha'
        ],
        [
            'text' => 'Surat Tugas',
            'url' => '/tu-surat-tugas',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepegawaian atau tata usaha'
        ],
        [
            'text' => 'Kontrak Kerja Sama',
            'url' => '/tu-kontrak-kerja-sama',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepegawaian atau tata usaha'
        ],
        // bidang kepelabuhan
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-home',
            'url' => '/home',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
        ],
        [
            'text' => 'Surat Masuk',
            'url' => '/pelabuhan-surat-masuk',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
        ],
        [
            'text' => 'Surat Keluar',
            'url' => '/pelabuhan-surat-keluar',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
        ],
        [
            'text' => 'LALA',
            'url' => '/pelabuhan-lala',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
        ],
        [
            'text' => 'Fasilitas Pelabuhan',
            'url' => '/pelabuhan-fasilitas-pelabuhan',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
        ],
        [
            'text' => 'Keagenan',
            'url' => '/pelabuhan-keagenan',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
        ],
        [
            'text' => 'PBM',
            'url' => '/pelabuhan-pbm',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
        ],
        [
            'text' => 'TKBM/JTS',
            'url' => '/pelabuhan-tkbm',
            'icon' => 'ti ti-mail',
            'icon_color' => 'white',
            'can' => 'bidang kepelabuhan'
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
