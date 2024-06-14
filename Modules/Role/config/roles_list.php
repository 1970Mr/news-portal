<?php

return [
    [
        "name" => "Admin",
        "local_name" => "مدیر",
        "permissions" => [
            config('permissions_list.SUPER_ADMIN')
        ]
    ],
    [
        "name" => "Editor",
        "local_name" => "ویرایشگر",
        "permissions" => [
            config('permissions_list.ARTICLE_INDEX'),
            config('permissions_list.ARTICLE_STORE'),
            config('permissions_list.ARTICLE_UPDATE'),
            config('permissions_list.ARTICLE_DESTROY'),
            config('permissions_list.ARTICLE_EDITOR_CHOICE'),
            config('permissions_list.ARTICLE_HOTNESS'),
            config('permissions_list.COMMENT_INDEX'),
            config('permissions_list.COMMENT_SHOW'),
            config('permissions_list.COMMENT_APPROVE'),
            config('permissions_list.COMMENT_REJECT'),
            config('permissions_list.COMMENT_DESTROY'),
            config('permissions_list.CATEGORY_INDEX'),
            config('permissions_list.CATEGORY_STORE'),
            config('permissions_list.CATEGORY_UPDATE'),
            config('permissions_list.CATEGORY_DESTROY'),
            config('permissions_list.TAG_INDEX'),
            config('permissions_list.TAG_STORE'),
            config('permissions_list.TAG_UPDATE'),
            config('permissions_list.TAG_DESTROY'),
            config('permissions_list.TAG_HOTNESS'),
            config('permissions_list.MENU_INDEX'),
            config('permissions_list.MENU_STORE'),
            config('permissions_list.MENU_UPDATE'),
            config('permissions_list.MENU_DESTROY'),
            config('permissions_list.MENU_HOTNESS'),
            config('permissions_list.IMAGE_INDEX_ALL'),
            config('permissions_list.IMAGE_UPDATE_ALL'),
            config('permissions_list.IMAGE_DESTROY_ALL'),
            config('permissions_list.SETTING_SOCIAL_NETWORKS'),
            config('permissions_list.SETTING_ABOUT_US'),
            config('permissions_list.SETTING_SITE_DETAILS'),
            config('permissions_list.SEO_MANAGEMENT'),
        ]
    ],
    [
        "name" => "Author",
        "local_name" => "نویسنده",
        "permissions" => [
            config('permissions_list.ARTICLE_INDEX'),
            config('permissions_list.ARTICLE_STORE'),
            config('permissions_list.ARTICLE_UPDATE'),
            config('permissions_list.ARTICLE_DESTROY'),
            config('permissions_list.CATEGORY_INDEX'),
            config('permissions_list.CATEGORY_STORE'),
            config('permissions_list.TAG_INDEX'),
            config('permissions_list.TAG_STORE'),
            config('permissions_list.IMAGE_INDEX_OWN'),
            config('permissions_list.IMAGE_UPDATE_OWN'),
            config('permissions_list.IMAGE_DESTROY_OWN'),
        ]
    ],
    [
        "name" => "Subscriber",
        "local_name" => "عضو ساده",
        "permissions" => [
            config('permissions_list.PROFILE_EDIT'),
            config('permissions_list.PROFILE_CHANGE_PASSWORD'),
            config('permissions_list.PROFILE_CHANGE_EMAIL'),
            config('permissions_list.PROFILE_SOCIAL_NETWORKS'),
            config('permissions_list.VIEW_AVERAGE_VISITORS'),
        ]
    ]
];

