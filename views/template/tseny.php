<?= \app\widgets\Zastavka::widget()?>

<?php
$models = \app\models\Pricetablehtml::find()->where(['visible' => 1])->all();
//echo '<pre>';
//print_r($models);

?>

<div class="pagecontent price-content mt0">
    <div class="wrap">
        <div class="breadcrumbs">
            <span><span><a href="https://masterabyta.ru/">Главная</a></span> / <span class="breadcrumb_last" aria-current="page">Цены</span></span>      </div>
        <h1 class="blocktitle"> Прайс-лист на услуги «Муж на час» </h1>

        <p><img decoding="async" class="alignright wp-image-4754" src="/wp-content/uploads/2020/08/Prajs-list-na-uslugi-Muzh-na-chas-300x220.jpg" alt="Прайс-лист на услуги Муж на час" width="241" height="177" srcset="https://masterabyta.ru/wp-content/uploads/2020/08/Prajs-list-na-uslugi-Muzh-na-chas-300x220.jpg 300w, https://masterabyta.ru/wp-content/uploads/2020/08/Prajs-list-na-uslugi-Muzh-na-chas.jpg 500w" sizes="(max-width: 241px) 100vw, 241px">На странице прикреплен подробный прайс-лист с расценками «Муж на час» в Москве на мелкий ремонт. Мы обслуживаем квартиры, частные дома и офисы. Работаем по договору.</p>
        <p>Наши мастера ежедневно проходят медицинский осмотр и работают на объекте заказчика исключительно в масках и перчатках. Высокая скорость проведения мелкого бытового ремонта обусловлена профессионализмом опытных специалистов, а также применением инновационного инструмента и брендового оборудования.</p>
        <p>Сроки выполнения заказа – минимальные и зависят от объема работ. Даем гарантию на услуги.</p>
        <?php if (!empty($models)): ?>
        <?php foreach ($models as $model): ?>
        <h2 class="blocktitle"><?=$model->name?></h2>
        <p>
        </p>
        <div class="table-responsive">
            <?=$model->price?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
