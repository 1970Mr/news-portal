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
            'url' => route('users.index'),
            'icon' => ' icon-people',
        ],
    ]
];
