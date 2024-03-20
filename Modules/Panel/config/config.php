<?php

return [
    'sidebar_menus' => [
        'panel' => [
            'title' => 'پیشخوان',
            'icon' => 'icon-home',
            'url' => route('panel.index'),
        ],
        'user' => [
            'title' => 'کاربران',
            'icon' => ' icon-people',
            'url' => route('user.index'),
            'active_routes' => [
                'user.create',
                'user.edit',
            ],
        ],
        'category' => [
            'title' => 'دسته‌بندی',
            'icon' => 'icon-grid',
            'url' => route('category.index'),
            'active_routes' => [
                'category.create',
                'category.edit',
            ]
        ],
    ]
];
