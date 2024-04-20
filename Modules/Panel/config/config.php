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
            'permissions' => config('permissions_list.USER_INDEX'),
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
            'permissions' => config('permissions_list.ROLE_INDEX'),
            'active_routes' => [
                'role.create',
                'role.edit',
            ],
        ],
        'category' => [
            'title' => 'دسته‌بندی',
            'icon' => 'icon-grid',
            'url' => route('category.index'),
            'permissions' => config('permissions_list.CATEGORY_INDEX'),
            'active_routes' => [
                'category.create',
                'category.edit',
            ]
        ],
        'tag' => [
            'title' => 'تگ',
            'icon' => 'icon-tag',
            'url' => route('tag.index'),
            'permissions' => config('permissions_list.TAG_INDEX'),
            'active_routes' => [
                'tag.create',
                'tag.edit',
            ]
        ],
        'image' => [ // TODO: FileManager instead of Image
            'title' => 'تصاویر',
            'icon' => 'icon-picture',
            'url' => route('image.index'),
            'permissions' => [
                config('permissions_list.IMAGE_INDEX_ALL', false),
                config('permissions_list.IMAGE_INDEX_OWN', false)
            ],
            'active_routes' => [
                'image.create',
                'image.edit',
            ]
        ],
        'article' => [
            'title' => 'اخبار',
            'icon' => 'icon-globe',
            'url' => route('article.index'),
            'permissions' => config('permissions_list.ARTICLE_INDEX'),
            'active_routes' => [
                'article.create',
                'article.edit',
            ]
        ],
        'profile' => [
            'title' => 'پروفایل',
            'icon' => 'icon-user',
            'active_routes' => [
                'profile.edit',
                'profile.email.change',
                'profile.password.change',
            ],
            'children' => [
                [
                    'title' => 'ویرایش پروفایل',
                    'icon' => 'icon-note',
                    'url' => route('profile.edit'),
    //            'permissions' => config('permissions_list.ARTICLE_INDEX'),
                ],
                [
                    'title' => 'ویرایش رمزعبور',
                    'icon' => 'icon-key',
                    'url' => route('profile.password.change'),
                    //            'permissions' => config('permissions_list.ARTICLE_INDEX'),
                ],
                [
                    'title' => 'ویرایش ایمیل',
                    'icon' => 'icon-envelope-letter',
                    'url' => route('profile.email.change'),
                    //            'permissions' => config('permissions_list.ARTICLE_INDEX'),
                ],
            ]
        ]
    ]
];
