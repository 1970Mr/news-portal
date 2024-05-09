<?php

return [
    'sidebar_menus' => [
        'panel' => [
            'title' => 'پیشخوان',
            'icon' => 'icon-home',
            'url' => route(config('app.panel_prefix', 'panel') . '.index'),
        ],
        'user' => [
            'title' => 'کاربران',
            'icon' => ' icon-people',
            'url' => route('user.index'),
            'permissions' => config('permissions_list.USER_INDEX', false),
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
            'permissions' => config('permissions_list.ROLE_INDEX', false),
            'active_routes' => [
                'role.create',
                'role.edit',
            ],
        ],
        'category' => [
            'title' => 'دسته‌بندی‌ها',
            'icon' => 'icon-grid',
            'url' => route('category.index'),
            'permissions' => config('permissions_list.CATEGORY_INDEX', false),
            'active_routes' => [
                'category.create',
                'category.edit',
            ]
        ],
        'tag' => [
            'title' => 'تگ‌ها',
            'icon' => 'icon-tag',
            'url' => route('tag.index'),
            'permissions' => config('permissions_list.TAG_INDEX', false),
            'active_routes' => [
                'tag.create',
                'tag.edit',
            ]
        ],
        'image' => [
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
            'permissions' => config('permissions_list.ARTICLE_INDEX', false),
            'active_routes' => [
                'article.create',
                'article.edit',
            ]
        ],
        'comment' => [
            'title' => 'نظرات',
            'icon' => 'icon-bubbles',
            'url' => route('admin.comments.index'),
            'permissions' => config('permissions_list.COMMENT_INDEX', false),
            'active_routes' => [
                'admin.comments.show',
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
            'permissions' => [
                config('permissions_list.PROFILE_EDIT', false),
                config('permissions_list.PROFILE_CHANGE_PASSWORD', false),
                config('permissions_list.PROFILE_CHANGE_EMAIL', false),
            ],
            'children' => [
                [
                    'title' => 'ویرایش پروفایل',
                    'icon' => 'icon-note',
                    'url' => route('profile.edit'),
                    'permissions' => config('permissions_list.PROFILE_EDIT', false),
                ],
                [
                    'title' => 'ویرایش رمز عبور',
                    'icon' => 'icon-key',
                    'url' => route('profile.password.change'),
                    'permissions' => config('permissions_list.PROFILE_CHANGE_PASSWORD', false),
                ],
                [
                    'title' => 'ویرایش ایمیل',
                    'icon' => 'icon-envelope-letter',
                    'url' => route('profile.email.change'),
                    'permissions' => config('permissions_list.PROFILE_CHANGE_EMAIL', false),
                ],
            ]
        ],
    ]
];
