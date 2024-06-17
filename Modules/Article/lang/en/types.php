<?php

use Modules\Article\App\Models\Article;

return [
    __('article::types.' . Article::ARTICLE) => Article::ARTICLE,
    __('article::types.' . Article::NEWS) => Article::NEWS,
];
