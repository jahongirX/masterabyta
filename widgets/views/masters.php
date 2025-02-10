<div class="masters-block">
    <div class="wrap">
        <span class="blocktitle">Наши лучшие мастера</span>
        <div class="masters-slider-wrapper">
            <div class="masters-slider-prev">◄</div>
            <div class="masters-slider-next">►</div>
            <div class="masters-slider carousel">
                <?php if (!empty($models)): ?>
                    <?php foreach ($models as $model): ?>
                        <div class="masters-slide">
                            <div class="masters-slide-inner">
                                <div class="masters-slide-photo"><img src="<?=$model->image?>"></div>
                                <div class="masters-slide-name"><?=$model->name?></div>
                                <div class="masters-slide-occupation"><?=$model->specialization?></div>
                                <div class="masters-slide-opyt">Опыт работы
                                    <?php
                                        if (!empty($model->experience)){
                                            if ($model->experience == 1){
                                               echo $model->experience . ' год';
                                            }else if($model->experience >= 2 && $model->experience <= 5){
                                                echo  $model->experience . ' года';
                                            }else {
                                                echo $model->experience . ' лет';
                                            }
                                        }
                                    ?>
                                    </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>