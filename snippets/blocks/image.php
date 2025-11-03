<?php

use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;

/** 
 * @var \Kirby\Cms\Block $block 
 */

$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$src     = null;

if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt    = $alt->or($image->alt());
    $src    = $image->url();
    $srcset = $image->srcset('default');
}

$options = [
    'image' => $block->image()->toFile(),
    'imgAttributes' => [
        'shared' => [
            'alt' => $block->alt()->esc(),
            'decoding' => 'async',
        ],
    ],
    'srcsetName' => 'default',
    'critical' => false,
];

?>

<?php if ($src): ?>
    <figure class="image" <?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>

        <?php if ($link->isNotEmpty()): ?>
            <a class="image__link" href="<?= Str::esc($link->toUrl()) ?>">
                <?php snippet('imagex-picture', $options) ?>
            </a>
        <?php else: ?>
            <?php snippet('imagex-picture', $options) ?>
        <?php endif ?>

        <?php if ($caption->isNotEmpty()): ?>
            <figcaption class="image__caption">
                <?= $caption ?>
            </figcaption>
        <?php endif ?>

    </figure>
<?php endif ?>