<?php

/**
 * @var Kirby\Cms\Page $page
 */

?>

<div class="tags">
    <?php foreach ($page->tags()->split() as $tag): ?>

        <?php if ($disabled == true): ?>
            <span class="tags__link tags__link--disabled">
                <?= $tag ?>
            </span>
        <?php else: ?>
            <a class="tags__link" href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>" title="">
                <?= $tag ?>
            </a>
        <?php endif ?>

    <?php endforeach ?>
</div>