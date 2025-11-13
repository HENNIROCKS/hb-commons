<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Site $site
 */

$title       = $site->customtitle()->or($page->customtitle());
$author      = $site->author()->or('Hendrik Berends');
$description = $page->description()->or($site->description());
$keywords    = $page->keywords()->or($site->keywords());
$robots      = $page->robots();

?>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php e($title->isNotEmpty(), $title, $page->title() . ' – ' . $site->title()) ?></title>

<meta name="author" content="<?= $author ?>">

<meta name="description" content="<?= $description ?>">

<meta name="keywords" content="<?= $keywords ?>">

<meta name="robots" content="<?php e($robots->toBool() === true, 'noindex, nofollow', 'index, follow') ?>">

<?= css([
  'media/plugins/' . $theme . '/css/style.min.css',
  // 'media/plugins/' . $theme . '/css/templates/' . $page->template()  . '.css',
]) ?>

<link rel="shortcut icon" href="/favicon.ico">

<?php /*
// TRASH, CLEAN UP

htmlhead()
->recommended_minimum()
->title($page->meta_title()->or($page->title() . ' – ' . $site->meta_title()))
->base()
->script_js_async([
  '/assets/js/scripts.js'
])
->script_js([
  '/assets/js/vendors/lightbox-plus-jquery.min.js',
])
->link_css([
  '/assets/css/vendors/lightbox.min.css',
  '/assets/css/styles.css'
])
->meta_robots($page->toggle_robots()->toBool() ? 'noindex, nofollow' : 'index, follow')
->meta_author(site()->author()->or('Hendrik Berends'))
->meta_description($page->meta_description()->or($site->meta_description()))
->meta_opengraph(description: $page->description())
->link_feedrss()

<?php if ($page->toggle_robots()->toBool() === true) : ?>
  <meta name="robots" content="noindex, nofollow">
<?php else : ?>
  <meta name="robots" content="index, follow">
<?php endif; ?>
*/ ?>