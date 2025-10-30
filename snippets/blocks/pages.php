<?php

/**
 * @var \Kirby\Cms\Block $block
 */

$theme = option('activeTheme');

?>

<div class="pages">
    <div class="pages__articles">

        <?php foreach ($block->pages()->toPages() as $article): ?>
            <article class="pages__article">
                <a class="pages__link" href="<?= $article->url() ?>" title="Zur Seite <?= $article->title() ?>"></a>

                <?php if ($image = $article->previewimage()->toFile() ?? $article->images()->first()): ?>
                    <img alt="" class="pages__image" src="<?= $image->crop(640, 250, 80)->url() ?>" />
                <?php endif ?>

                <span class="pages__title">
                    <?= $article->title() ?>
                </span>

            </article>
        <?php endforeach ?>

    </div>
</div>