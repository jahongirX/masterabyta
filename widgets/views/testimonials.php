<div class="reviewblock">
    <div class="wrap">
        <span class="blocktitle">Отзывы наших клиентов</span>
        <div class="carousel articles">
            <?php if (!empty($models)): ?>
                <?php foreach ($models as $model): ?>
                    <div class="article">
                        <div class="top">
                            <img width="80" height="80" src="<?=$model->user_image?>"
                                 class="attachment-photo size-photo wp-post-image" alt="" decoding="async"
                                 srcset="<?=$model->user_image?> 80w, <?=$model->user_image?> 150w"
                                 sizes="(max-width: 80px) 100vw, 80px" /> <span class="name"><?=$model->name?></span>
                        </div>
                        <p><?=$model->text?></p>
                        <?php if (!empty($model->image)): ?>
                        <a href="<?=$model->image?>" data-fancybox="gallery">смотреть бланк отзыва</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <a href="/otzyvy/" class="btn">Все отзывы</a>
    </div>
</div>