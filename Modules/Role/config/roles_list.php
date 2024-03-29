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
            config('permissions_list.USER_INDEX'),
            config('permissions_list.CATEGORY_INDEX'),
            config('permissions_list.CATEGORY_STORE'),
            config('permissions_list.CATEGORY_UPDATE'),
            config('permissions_list.CATEGORY_DESTROY'),
            config('permissions_list.ROLE_INDEX'),
        ]
    ],
    [
        "name" => "Author",
        "local_name" => "نویسنده",
        "permissions" => []
    ],
    [
        "name" => "Subscriber",
        "local_name" => "عضو ساده",
        "permissions" => []
    ]
];
