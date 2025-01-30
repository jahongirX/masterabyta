<?php 

namespace app\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class UrlHelper
{

	public static function to($param = null)
	{
		$url = Url::to(['/'], true);
        $domain = preg_replace('/(https?:)?\/\//', '', $url);
        $domain = explode('/', $domain, 2);
        $domain = $domain[0];

		$page = (!empty($param['page']) && $param['page'] !== '/') ? $param['page'] : null;
		$city = (!empty($param['city'])) ? $param['city'] : null;

		if (!empty($city)) {
			$domain_level = Yii::$app->params['domain-level'] * (-1);
			$domain = explode('.', $domain);
	        $domain = array_splice($domain, $domain_level);
	        $domain = implode('.', $domain);
	        
	        if ($city !== '/') {
				$domain = $city . '.' . $domain;
	        }
		}
		$url = 'https://' . $domain . '/';

		if (!empty($page)) {
			$page = trim($page);
			$page = trim($page, '/');
			$page = trim($page);
			$url .= $page . '/';
		}

		return $url;
	}

}




?>