<?php

/**
 * @var \Kirby\Cms\App $kirby
 */

namespace Hennirocks;

require_once __DIR__ . '/src/Helpers.php';

use Kirby\Cms\App as Kirby;
use Hennirocks\Helpers;

Kirby::plugin('hennirocks/hb-commons', [
    'blueprints' => Helpers::mapFiles(__DIR__, 'blueprints', ['yml']),
    'snippets'   => Helpers::mapFiles(__DIR__, 'snippets',   ['php']),
    'templates'  => Helpers::mapFiles(__DIR__, 'templates',  ['php']),

    'collections' => Helpers::mapRequires(__DIR__, 'collections', ['php']),
    'controllers' => Helpers::mapRequires(__DIR__, 'controllers', ['php']),

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

    'tags' => [
        'heart' => [
            'html' => function ($tag) {
                return '<i class="icon icon--heart"></i>';
            }
        ]
    ],
]);
