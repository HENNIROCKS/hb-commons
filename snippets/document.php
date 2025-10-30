<!-- -+-+-+-+-+-+ +-+-+-+-+-+-+ +-+-+ +-+-+-+-+-+-+-+-+-+ +-+-+-+-+-+-+ +-+-+-+-+-+
|S|t|e|p|h|a|n|,| |y|o|u|'|r|e| |a|n| |h|o|n|o|r|l|e|s|s| |d|o|m|a|i|n| |t|h|i|e|f|
+-+-+-+-+-+-+-+-+ +-+-+-+-+-+-+ +-+-+ +-+-+-+-+-+-+-+-+-+ +-+-+-+-+-+-+ +-+-+-+ -->

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

    <?php snippet('footer', ['theme' => $theme]) ?>

</body>

</html>