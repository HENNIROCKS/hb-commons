<?php

/**
 * @var \Kirby\Cms\Block $block
 */

// shared options (without the image)
$baseOptions = [
    'imgAttributes' => [
        'shared' => [
            'class' => 'pages__image',
            'decoding' => 'async',
        ],
    ],
    'srcsetName' => 'previewimage',
    'critical' => false,
];

// helper to build the full options for a given image
$makeOptions = function ($image) use ($baseOptions) {
    return array_merge(['image' => $image], $baseOptions);
};

?>

<div class="pages">
    <div class="pages__articles">

        <?php foreach ($block->pages()->toPages() as $article): ?>
            <article class="pages__article">
                <a class="pages__link" href="<?= $article->url() ?>" title="Zur Seite <?= $article->title() ?>"></a>

                <?php if ($image = $article->previewimage()->toFile() ?? $article->images()->first()): ?>
                    <?php snippet('imagex-picture', $makeOptions($image)) ?>
                <?php endif ?>

                <span class="pages__title">
                    <?= $article->title() ?>
                </span>

            </article>
        <?php endforeach ?>

        <?php if ($block->pages()->toPages()->count() == 1): ?>
            <div class="pages__article--placeholder"></div>
        <?php endif ?>

    </div>
</div>