<?= $site->hiddenmessage() ?>

<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Template\Slot $slot
 */

$theme = option('activeTheme');

?>

<!DOCTYPE html>
<html class="scroll-smooth" lang="de">

<head>
    <?php snippet('head', ['theme' => $theme]) ?>
</head>

<body class="body body--<?= str_replace('/', '-', $theme) ?>">

    <?php /* if ($page->protected()->toBool() === true) : ?>
        <?php if (!$kirby->user()) go('/') ?>
    <?php endif */ ?>

    <?php snippet('navigation-main') ?>

    <?= $slot ?>

    <?php snippet('stoerer') ?>

    <?php snippet('footer', ['theme' => $theme]) ?>

    <?= js([
        'media/plugins/' . $theme . '/js/scripts.js',
        // 'media/plugins/' . $theme . '/js/templates/' . $page->template()  . '.js',
    ]) ?>

</body>

</html>