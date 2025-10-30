<?php

// use Kirby\Toolkit\I18n;
// use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Site $site
 */

$text = $site->footertext()->or('Made with Kirby and <i class="icon icon__heart"></i> &copy; (date: year)');

?>

<footer class="footer">

    <div class="footer__text">
        <?= $text->kt() ?>
    </div>

</footer>

<?= js([
    // 'assets/js/scripts.js',
    // '@auto'
    'media/plugins/' . $theme . '/js/scripts.js',
    'media/plugins/' . $theme . '/js/templates/' . $page->template()  . '.js',
]) ?>