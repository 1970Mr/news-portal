<?php

return [
    'name' => 'User',
    'admin_name' => env('ADMIN_NAME', 'test'),
    'admin_email' => env('ADMIN_EMAIL', 'test@gmail.com'),
    'admin_password' => env('ADMIN_PASSWORD', 'password'),
//    'default_profile_picture' => module_path('User', 'Database/Seeders/data/images/profile_picture.jpg')
    'default_profile_picture' => [
        'file_path' => public_path('seeders/images/profile_picture.jpg'),
        'file_link' => asset('seeders/images/profile_picture.jpg'),
        'alt_text' => 'Default Profile Picture',
    ]
];
