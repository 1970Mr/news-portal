<?php

return [
    'SUPER_ADMIN' => 'admin::full_access',

    'USER_INDEX' => 'user::index',
    'USER_STORE' => 'user::store',
    'USER_UPDATE' => 'user::update',
    'USER_DESTROY' => 'user::destroy',
    'USER_ROLE_ASSIGNMENT' => 'user::role_assignment',

    'ROLE_INDEX' => 'role::index',
    'ROLE_STORE' => 'role::store',
    'ROLE_UPDATE' => 'role::update',
    'ROLE_DESTROY' => 'role::destroy',

    'CATEGORY_INDEX' => 'category::index',
    'CATEGORY_STORE' => 'category::store',
    'CATEGORY_UPDATE' => 'category::update',
    'CATEGORY_DESTROY' => 'category::destroy',

    'TAG_INDEX' => 'tag::index',
    'TAG_STORE' => 'tag::store',
    'TAG_UPDATE' => 'tag::update',
    'TAG_DESTROY' => 'tag::destroy',

    'IMAGE_INDEX_ALL' => 'image::index_all',
    'IMAGE_INDEX_OWN' => 'image::index_own',
//    'IMAGE_STORE' => 'image::store',
    'IMAGE_UPDATE_ALL' => 'image::update_all',
    'IMAGE_UPDATE_OWN' => 'image::update_own',
    'IMAGE_DESTROY_ALL' => 'image::destroy_all',
    'IMAGE_DESTROY_OWN' => 'image::destroy_own',

    'ARTICLE_INDEX' => 'article::index',
    'ARTICLE_STORE' => 'article::store',
    'ARTICLE_UPDATE' => 'article::update',
    'ARTICLE_DESTROY' => 'article::destroy',

    'COMMENT_INDEX' => 'comment::index',
    'COMMENT_SHOW' => 'comment::show',
    'COMMENT_APPROVE' => 'comment::approve',
    'COMMENT_REJECT' => 'comment::reject',
    'COMMENT_DESTROY' => 'comment::destroy',

    'PROFILE_EDIT' => 'profile::edit',
    'PROFILE_CHANGE_PASSWORD' => 'profile::change_password',
    'PROFILE_CHANGE_EMAIL' => 'profile::change_email',
];
