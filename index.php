<?php

/** 
 * TODO: 
 * - Make sure "hennirocks/hb-commons" is always loaded before any theme;
 *   As of now, overwriting blueprints, snippets etc. just works because
 *   of the naming of the plugins automatically puts dependencies in order.
 */

/**
 * @var \Kirby\Cms\App $kirby
 */

use Kirby\Cms\App as Kirby;

$mapFiles = function (string $subdir, array $exts): array {
    /**
     * Build a map of files from a given subdirectory to their absolute paths.
     *
     * The function scans the directory located at __DIR__ . '/' . $subdir recursively
     * (skipping "." and ".." entries) and returns an associative array where:
     *  - keys are the file paths relative to the provided $subdir, normalized to use
     *    forward slashes and with the matched extension removed, and
     *  - values are the absolute pathnames as returned by SplFileInfo::getPathname().
     *
     * Behavior/details:
     *  - If the computed directory does not exist, an empty array is returned.
     *  - Only regular files are included; directories and non-file entries are ignored.
     *  - Files are included only if their extension (the substring after the final '.')
     *    matches one of the entries in $exts.
     *  - The extension check used to decide inclusion is strict (in_array with strict
     *    comparison) against the lowercase extension derived from the file. To avoid
     *    surprises, provide $exts in lowercase (e.g. ['php', 'html']).
     *  - The key-generation step removes the file extension using a case-insensitive
     *    regex built from $exts (so "File.PHP" will have its extension stripped even if
     *    $exts contains 'php').
     *  - If multiple files produce the same key (e.g. foo/index.php and foo/index.html
     *    when both extensions are allowed), later entries in the iteration overwrite
     *    earlier ones.
     *
     * Parameters:
     *  @param string   $subdir Relative subdirectory path (relative to this file's __DIR__).
     *  @param string[] $exts   List of allowed file extensions (without the leading dot).
     *
     * Return:
     *  @return array<string,string> Map of "relative/path/without/extension" => "absolute/path/to/file"
     *
     * Example:
     *  Given directory structure:
     *    site/plugins/my-plugin/snippets/header.php
     *    site/plugins/my-plugin/snippets/partials/nav.html
     *
     *  Calling:
     *    $mapFiles('snippets', ['php', 'html']);
     *
     *  Might return:
     *    [
     *      'header' => '/full/path/to/site/plugins/my-plugin/snippets/header.php',
     *      'partials/nav' => '/full/path/to/site/plugins/my-plugin/snippets/partials/nav.html',
     *    ]
     *
     * Performance:
     *  - The function walks the directory tree once; runtime is proportional to the
     *    number of files and directories under $subdir.
     */

    $dir = __DIR__ . '/' . $subdir;
    $result = [];

    if (!is_dir($dir)) {
        return $result;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    $extPattern = implode('|', array_map('preg_quote', $exts));

    foreach ($iterator as $file) {
        if (!$file->isFile()) {
            continue;
        }

        $ext = strtolower(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
        if (!in_array($ext, $exts, true)) {
            continue;
        }

        $relative = str_replace($dir . DIRECTORY_SEPARATOR, '', $file->getPathname());
        $relative = str_replace('\\', '/', $relative);
        $key = preg_replace('#\.(' . $extPattern . ')$#i', '', $relative);

        $result[$key] = $file->getPathname();
    }

    return $result;
};

Kirby::plugin('hennirocks/hb-commons', [
    'blueprints' => $mapFiles('blueprints', ['yml', 'yaml']),
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
    'hooks' => [],
    'icons' => [
        // https://getkirby.com/docs/reference/plugins/extensions/icons
    ],
    'models' => [],
    'options' => [],
    'roots' => [
        // 'assets' => __DIR__ . '/../assets',
        // 'assets' => __DIR__ . '/media/plugins/hennirocks/hb-theme-v13',
    ],
    'snippets'   => $mapFiles('snippets', ['php']),
    'tags' => [
        'heart' => [
            'html' => function ($tag) {
                return '<i class="icon icon__heart"></i>';
            }
        ]
    ],
    'templates'  => $mapFiles('templates', ['php']),
    'translations' => [
        // 'de' => require 'languages/de.php',
        // 'en' => require 'languages/en.php',
    ],
]);
