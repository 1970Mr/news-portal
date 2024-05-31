<?php

return [
    'name' => 'Common',
    'datetime_format' => 'Y/m/d H:i:s',
    'front_date_format' => 'd F Y',
    'front_datetime_format' => 'd F Y - H:i',
    'default_image' => [
        'file_path' => public_path('seeders/images/default.jpg'),
        'file_link' => asset('seeders/images/default.jpg'),
        'alt_text' => 'Default Picture',
    ]
];
