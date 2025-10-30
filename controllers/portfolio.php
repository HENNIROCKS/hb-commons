<?php

/**
 * Sources:
 * https://getkirby.com/docs/cookbook/content-representations/ajax-load-more
 */

return function ($page) {

    $limit    = 6;
    $articles = collection('portfolio-pages')->paginate($limit);

    return [
        'limit'      => $limit,
        'articles'   => $articles,
        'pagination' => $articles->pagination(),
    ];
};
