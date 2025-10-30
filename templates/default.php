<?php

use Kirby\Toolkit\Str;

/**
 * @var Kirby\Cms\Page $page
 */

?>

<?php snippet('document', slots: true) ?>
<?php slot() ?>

<main class="main main--<?= $page->template() ?> container">
    <section class="section section--text">

        <h1 class="heading heading--h1" id="<?= Str::slug($page->title()) ?>">
            <?= $page->title() ?>
        </h1>

        <?php snippet('layouts', ['layout_src' => $page->layouts()]) ?>

    </section>
</main>

<?php endslot() ?>
<?php endsnippet() ?>