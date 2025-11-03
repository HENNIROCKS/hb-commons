<?php

/**
 * @var Kirby\Cms\Page $page
 */

?>

<div class="tags">
    <?php foreach ($page->tags()->split() as $tag): ?>
        <a class="tags__link" href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>" title="">
            <?= $tag ?>
        </a>
    <?php endforeach ?>
</div>