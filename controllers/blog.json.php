<?php

return function ($page) {

    $limit      = 3;
    $articles   = collection('blog-articles')->paginate($limit);
    $pagination = $articles->pagination();
    $more       = $pagination->hasNextPage();

    return [
        'articles' => $articles,
        'more'     => $more,
        'html'     => '',
        'json'     => [],
    ];
};
