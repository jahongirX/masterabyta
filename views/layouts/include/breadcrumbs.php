<?php 

use app\models\Page;
use yii\widgets\Breadcrumbs;

$isFrontPage = Page::isFrontPage();

if (!$isFrontPage) {
	# code...
	echo Breadcrumbs::widget([
	    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	    'homeLink' => [
	        'label' => 'Главная',
	        'url' => ['/'],
	    ]
	]);
}

?>