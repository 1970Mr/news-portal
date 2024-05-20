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
            'url' => route(config('app.panel_prefix', 'panel') . '.users.index'),
            'permissions' => config('permissions_list.USER_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.users.create',
                config('app.panel_prefix', 'panel') . '.users.edit',
                config('app.panel_prefix', 'panel') . '.users.role-assignment',
            ],
        ],
        'role' => [
            'title' => 'نقش‌ها',
            'icon' => 'fas fa-arrow-down-up-lock',
            'url' => route(config('app.panel_prefix', 'panel') . '.roles.index'),
            'permissions' => config('permissions_list.ROLE_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.roles.create',
                config('app.panel_prefix', 'panel') . '.roles.edit',
            ],
        ],
        'category' => [
            'title' => 'دسته‌بندی‌ها',
            'icon' => 'icon-grid',
            'url' => route(config('app.panel_prefix', 'panel') . '.categories.index'),
            'permissions' => config('permissions_list.CATEGORY_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.categories.create',
                config('app.panel_prefix', 'panel') . '.categories.edit',
            ]
        ],
        'tag' => [
            'title' => 'تگ‌ها',
            'icon' => 'icon-tag',
            'url' => route(config('app.panel_prefix', 'panel') . '.tags.index'),
            'permissions' => config('permissions_list.TAG_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.tags.create',
                config('app.panel_prefix', 'panel') . '.tags.edit',
            ]
        ],
        'image' => [
            'title' => 'تصاویر',
            'icon' => 'icon-picture',
            'url' => route(config('app.panel_prefix', 'panel') . '.images.index'),
            'permissions' => [
                config('permissions_list.IMAGE_INDEX_ALL', false),
                config('permissions_list.IMAGE_INDEX_OWN', false)
            ],
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.images.create',
                config('app.panel_prefix', 'panel') . '.images.edit',
            ]
        ],
        'article' => [
            'title' => 'اخبار',
            'icon' => 'icon-globe',
            'url' => route(config('app.panel_prefix', 'panel') . '.articles.index'),
            'permissions' => config('permissions_list.ARTICLE_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.articles.create',
                config('app.panel_prefix', 'panel') . '.articles.edit',
            ]
        ],
        'comment' => [
            'title' => 'نظرات',
            'icon' => 'icon-bubbles',
            'url' => route(config('app.panel_prefix', 'panel') . '.comments.index'),
            'permissions' => config('permissions_list.COMMENT_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.comments.show',
            ]
        ],
        'newsletter' => [
            'title' => 'خبرنامه',
            'icon' => 'icon-paper-plane',
            'url' => route(config('app.panel_prefix', 'panel') . '.newsletters.index'),
            'permissions' => config('permissions_list.NEWSLETTER_INDEX', false),
        ],
        'profile' => [
            'title' => 'پروفایل',
            'icon' => 'icon-user',
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.profile.edit',
                config('app.panel_prefix', 'panel') . '.profile.email.change',
                config('app.panel_prefix', 'panel') . '.profile.password.change',
                config('app.panel_prefix', 'panel') . '.profile.social-networks',
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
                    'url' => route(config('app.panel_prefix', 'panel') . '.profile.edit'),
                    'permissions' => config('permissions_list.PROFILE_EDIT', false),
                ],
                [
                    'title' => 'ویرایش رمز عبور',
                    'icon' => 'icon-key',
                    'url' => route(config('app.panel_prefix', 'panel') . '.profile.password.change'),
                    'permissions' => config('permissions_list.PROFILE_CHANGE_PASSWORD', false),
                ],
                [
                    'title' => 'ویرایش ایمیل',
                    'icon' => 'icon-envelope-letter',
                    'url' => route(config('app.panel_prefix', 'panel') . '.profile.email.change'),
                    'permissions' => config('permissions_list.PROFILE_CHANGE_EMAIL', false),
                ],
                [
                    'title' => 'ثبت شبکه‌های اجتماعی',
                    'icon' => 'icon-link',
                    'url' => route(config('app.panel_prefix', 'panel') . '.profile.social-networks.edit'),
                    'permissions' => config('permissions_list.PROFILE_SOCIAL_NETWORKS', false),
                ],
            ]
        ],
        'contact_us' => [
            'title' => 'تماس با ما',
            'icon' => 'icon-earphones-alt',
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.contact-us.info.edit',
                config('app.panel_prefix', 'panel') . '.contact-us.messages.index',
                config('app.panel_prefix', 'panel') . '.contact-us.messages.show',
            ],
            'permissions' => [
                config('permissions_list.CONTACT_INFO', false),
                config('permissions_list.CONTACT_MESSAGES', false),
            ],
            'children' => [
                [
                    'title' => 'ثبت اطلاعات تماس',
                    'icon' => 'icon-call-in',
                    'url' => route(config('app.panel_prefix', 'panel') . '.contact-us.info.edit'),
                    'permissions' => config('permissions_list.CONTACT_INFO', false),
                ],
                [
                    'title' => 'پیام‌های کاربران',
                    'icon' => 'icon-envelope',
                    'url' => route(config('app.panel_prefix', 'panel') . '.contact-us.messages.index'),
                    'permissions' => config('permissions_list.CONTACT_MESSAGES', false),
                    'active_routes' => [
                        config('app.panel_prefix', 'panel') . '.contact-us.messages.show',
                    ],
                ],
            ]
        ],
        'setting' => [
            'title' => 'تنظیمات سایت',
            'icon' => 'icon-settings',
            'active_routes' => [
                config('app.panel_prefix', 'panel') . '.settings.site-details.edit',
                config('app.panel_prefix', 'panel') . '.settings.social-networks.edit',
                config('app.panel_prefix', 'panel') . '.settings.about-us.edit',
            ],
            'permissions' => [
                config('permissions_list.SETTING_SITE_DETAILS', false),
                config('permissions_list.SETTING_SOCIAL_NETWORKS', false),
                config('permissions_list.SETTING_ABOUT_US', false),
            ],
            'children' => [
                [
                    'title' => 'ثبت جزئیات سایت',
                    'icon' => 'icon-wrench',
                    'url' => route(config('app.panel_prefix', 'panel') . '.settings.site-details.edit'),
                    'permissions' => config('permissions_list.SETTING_SITE_DETAILS', false),
                ],
                [
                    'title' => 'ثبت شبکه‌های اجتماعی',
                    'icon' => 'icon-link',
                    'url' => route(config('app.panel_prefix', 'panel') . '.settings.social-networks.edit'),
                    'permissions' => config('permissions_list.SETTING_SOCIAL_NETWORKS', false),
                ],
                [
                    'title' => 'درباره ما',
                    'icon' => 'icon-question',
                    'url' => route(config('app.panel_prefix', 'panel') . '.settings.about-us.edit'),
                    'permissions' => config('permissions_list.SETTING_ABOUT_US', false),
                ],
            ]
        ],
    ]
];
