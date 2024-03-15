<?php

return [
    'sidebar_menus' => [
        'panel' => [
            'title' => 'پیشخوان',
            'url' => route('panel.index'),
            'icon' => 'icon-home',
        ],
        'user' => [
            'title' => 'کاربران',
            'icon' => ' icon-people',
            'children' => [
                'index' => [
                    'title' => 'لیست کاربران',
                    'url' => route('users.index'),
                    'icon' => 'icon-people',
                ],
                'create' => [
                    'title' => 'ایجاد کاربر جدید',
                    'url' => route('users.create'),
                    'icon' => 'icon-user-follow',
                ],
            ]
        ],
        'category' => [
            'title' => 'دسته بندی',
            'icon' => 'icon-grid',
            'url' => route('category.index'),
        ],
    ]
];
