<?php 
   
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\BlockHelper;
use app\models\Setting;
use yii\widgets\ActiveForm;

?>



<div class="container content">
    <div class="row p-t-md">
        <div class="three-mod columns">

            <?php require_once __DIR__.'/../layouts/include/sidebar.php'; ?>

        </div>
        <div class="nine-mod columns">

			<?php $searchValue = (isset(Yii::$app->params['s'])) ? (string) Yii::$app->params['s'] : ''; ?>

			<div class="block b-search">
				<div class="container">
					<?php if ($page['header']): ?>
						<h1 class="b-search__title"><?= CustomHelper::custom_br($page['header']) ?></h1>
					<?php endif; ?>

					<?php if (!empty($result)): ?>
						<ul class="b-search__list">
							<?php foreach ($result as $one): ?>
								<?php if (!empty($one) && !empty($one['href'])): ?>
									<?php $page_name = (!empty($one['page_name'])) ? $one['page_name'] : $one['href']; ?>
									<li><a href="<?= $one['href'] ?>"><?= $page_name ?></a></li>
								<?php endif ?>
							<?php endforeach; ?>
						</ul>
					<?php else: ?>
						<div class="alert alert-danger">По запросу <b><?= Html::encode($searchValue) ?></b> ничего не найдено.</div>
					<?php endif; ?>
				</div>
			</div>


            <?php require_once __DIR__.'/../layouts/include/leadback-price.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/usluga-bottom.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/how-we-work.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/ulicy.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/leadback-2.php'; ?>

        </div>
    </div>
</div>