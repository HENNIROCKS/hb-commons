<?php

/**
 * @var Kirby\Cms\Page $page
 * 
 * TODO:
 * - Make tags work and remove "disabled" option
 *   - Remove option passed to snippet in "templates/blog-article.php"
 *   - Remove styling for class "tags__link--disabled"
 */

?>

<div class="tags">
    <?php foreach ($page->tags()->split() as $tag): ?>

        <?php if ($disabled == true): ?>
            <span class="tags__link tags__link--disabled">
                <i class="icon icon__hashtag"></i>
                <?= $tag ?>
            </span>
        <?php else: ?>
            <a class="tags__link" href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>" title="">
                <i class="icon icon__hashtag"></i>
                <?= $tag ?>
            </a>
        <?php endif ?>

    <?php endforeach ?>
</div>