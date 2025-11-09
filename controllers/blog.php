<?php

/**
 * Sources:
 * https://getkirby.com/docs/cookbook/content-representations/ajax-load-more
 */

return function ($page) {

    $limit    = 9;
    $articles = collection('blog-articles')->paginate($limit);

    return [
        'limit'      => $limit,
        'articles'   => $articles,
        'pagination' => $articles->pagination(),
    ];
};
