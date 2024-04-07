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
                'user.role-assignment',
            ],
        ],
        'role' => [
            'title' => 'نقش‌ها',
            'icon' => 'fas fa-arrow-down-up-lock',
            'url' => route('role.index'),
            'active_routes' => [
                'role.create',
                'role.edit',
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
        'tag' => [
            'title' => 'تگ',
            'icon' => 'icon-tag',
            'url' => route('tag.index'),
            'active_routes' => [
                'tag.create',
                'tag.edit',
            ]
        ],
        'image' => [ // TODO: FileManager instead of Image
            'title' => 'تصاویر',
            'icon' => 'icon-picture',
            'url' => route('image.index'),
            'active_routes' => [
                'image.create',
                'image.edit',
            ]
        ],
    ]
];
