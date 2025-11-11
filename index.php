<?php

/**
 * @var \Kirby\Cms\App $kirby
 */

namespace Hennirocks;

require_once __DIR__ . '/src/Helpers.php';

use Kirby\Cms\App as Kirby;
use Hennirocks\Helpers;

Kirby::plugin('hennirocks/hb-commons', [
    'blueprints' => Helpers::mapFiles(__DIR__, 'blueprints', ['yml', 'yaml']),
    'collections' => [
        'blog-articles'    => require 'collections/blog-articles.php',
        'links'            => require 'collections/links.php',
        'pages-footermenu' => require 'collections/pages-footermenu.php',
        'pages-legal'      => require 'collections/pages-legal.php',
        'pages-listed'     => require 'collections/pages-listed.php',
        'pages-published'  => require 'collections/pages-published.php',
        'portfolio-pages'  => require 'collections/portfolio-pages.php',
    ],
    'controllers' => [
        'blog.json' => require 'controllers/blog.json.php',
        'blog'      => require 'controllers/blog.php',
    ],
    'hooks' => [
        'kirbytext:after' => function ($text) {
            $search = [
                '<table>',
                '<thead>',
                '<th>',
                '<tbody>',
                '<tr>',
                '<td>',
            ];
            $replace = [
                '<table class="table">',
                '<thead class="table__head">',
                '<th class="table__column">',
                '<tbody class="table__body">',
                '<tr class="table__row">',
                '<td class="table__column">',
            ];
            return str_replace($search, $replace, $text);
        }
    ],
    'icons' => [
        // https://getkirby.com/docs/reference/plugins/extensions/icons
    ],
    'models' => [],
    'options' => [],
    'roots' => [],
    'snippets' => Helpers::mapFiles(__DIR__, 'snippets', ['php']),
    'tags' => [
        'heart' => [
            'html' => function ($tag) {
                return '<i class="icon icon--heart"></i>';
            }
        ]
    ],
    'templates' => Helpers::mapFiles(__DIR__, 'templates', ['php']),
    'translations' => [],
]);
