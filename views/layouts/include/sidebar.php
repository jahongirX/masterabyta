<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Page;
use app\models\Blocktechnical;
use app\models\Setting;


$sidebar = (!empty(Yii::$app->params['blocktechnical']) && !empty(Yii::$app->params['blocktechnical'][3])) ? Yii::$app->params['blocktechnical'][3] : null;

?>


<?php if (!empty($sidebar)): ?>

<aside>

<button class="sidebar-collapse-button" id="sidebar-collapse-button">Показать услуги <i class="fa fa-caret-down" aria-hidden="true"></i></button>

<div id="sidebar-collapse">

	<!-- Sidebar menu block  -->
	<div class="sidebar-block">

		<?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['sidebar_menu'])): ?>

			<?php 
				$page_sidebar_menu = Yii::$app->params['page']['sidebar_menu'];
				$page_sidebar_menu = trim($page_sidebar_menu);
				$page_sidebar_menu = trim($page_sidebar_menu, ',');
				$page_sidebar_menu = trim($page_sidebar_menu);
				$page_sidebar_menu = explode(',', $page_sidebar_menu);
				$page_sidebar_menu = array_map('trim', $page_sidebar_menu);
			?>
			<?php foreach ($page_sidebar_menu as $one): ?>
				<?php if (!empty($one)): ?>
					<section class="widget widget_nav_menu">
						<div class="h6 widget-title"><?= Menu::getMenuName($one) ?></div>
						<div class="menu-uslugi-muzha-na-chas-container">
							<?php if (!empty($one)): ?>
								<?php $one_menu = Menu::getMenuHtml($one, 'menu'); ?>
								<?php if (!empty($one_menu)): ?>
									<?= $one_menu ?>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</section>
				<?php endif; ?>
			<?php endforeach; ?>

		<?php else: ?>

			<?php if (!empty($sidebar['menu1'])): ?>
				<section class="widget widget_nav_menu">
					<div class="h6 widget-title"><?= Menu::getMenuName($sidebar['menu1']) ?></div>
					<div class="menu-uslugi-muzha-na-chas-container">
						<?php if (!empty($sidebar['menu1'])): ?>
							<?php $sidebar_menu1 = Menu::getMenuHtml($sidebar['menu1'], 'menu'); ?>
							<?php if (!empty($sidebar_menu1)): ?>
								<?= $sidebar_menu1 ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</section>
			<?php endif; ?>

			<?php if (!empty($sidebar['menu2'])): ?>
				<section class="widget widget_nav_menu">
					<div class="h6 widget-title"><?= Menu::getMenuName($sidebar['menu2']) ?></div>
					<div class="menu-uslugi-muzha-na-chas-container">
						<?php if (!empty($sidebar['menu2'])): ?>
							<?php $sidebar_menu2 = Menu::getMenuHtml($sidebar['menu2'], 'menu'); ?>
							<?php if (!empty($sidebar_menu2)): ?>
								<?= $sidebar_menu2 ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</section>
			<?php endif; ?>

		<?php endif; ?>
	</div>


	<?php if (!empty($sidebar['item'])): ?>
		<?= $sidebar['item'] ?>
	<?php endif; ?>


</div>

</aside>

<?php endif; ?>