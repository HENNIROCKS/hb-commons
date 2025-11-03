<?php

/**
 * Sources:
 * https://getkirby.com/docs/cookbook/content-representations/ajax-load-more
 */

return function ($page) {

    // // $limit    = 4;
    // // $articles = collection('blog-articles')->paginate($limit);
    // $articles = collection('blog-articles');

    // return [
    //     // 'limit'      => $limit,
    //     'articles'   => $articles,
    //     // 'pagination' => $articles->pagination(),
    // ];


    $articles = collection('blog-articles');

    $tags = $articles->pluck('tags', ',', true);

    sort($tags);

    if ($tag = param('tag')) {
        $articles = $articles->filterBy('tags', $tag, ',');
    }

    $articles   = $articles->paginate(8);
    $pagination = $articles->pagination();

    return compact('articles', 'tags', 'tag', 'pagination');
};
