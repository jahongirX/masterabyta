<?php

namespace app\commands;

use Yii;
use yii\helpers\Url;
use yii\console\Controller;
use yii\console\ExitCode;

use app\models\LoginForm;
use app\models\Blocktechnical;
use app\models\City;
use app\models\Page;
use app\models\Partner;
use app\models\Price;
use app\models\Request;
use app\models\Setting;
use app\models\Tag;
use app\models\User;
use app\helpers\CustomHelper;
use app\helpers\LibmailHelper;
use app\helpers\SmsRuHelper;
use app\helpers\RecaptchaV3Helper;
use \stdClass;

/**
 * Фоновые скрипты
 */
class DaemonController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actionBefore()
    {

    }



    /**
     * Проверяем коды ответа страниц
     */
    public function actionAnalysisCode()
    {
        $result_data = array();
        $result_filename = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'httpcode-control.csv';
        $result_array = array();
        
        $pages_filename = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'pages.csv';
        if (file_exists($pages_filename)) {
            $pages_list = file_get_contents($pages_filename);
            $pages_list = str_replace('https://egdu.ru', 'http://egdu.loc', $pages_list);
            if (!empty($pages_list)) {
                $pages_list = explode("\r\n", $pages_list);
                if (!empty($pages_list) && is_array($pages_list)) {

                    foreach ($pages_list as $one) {
                        if (!empty($one)) {

                            $httpcode = \app\helpers\CurlHelper::newObj()->get($one)->code();

                            $result_data[] = array($one, $httpcode);
                            
                        }
                    }
                }
            }
        }

        $result_data_count = count($result_data);

        $data = array();
        for ($i = 0; $i < $result_data_count; $i++) {
            $data[$i] = implode(';', $result_data[$i]);
        }

        $data = implode("\r\n", $data);
        file_put_contents($result_filename, $data);

        \app\helpers\CustomHelper::debug($result_data);
        exit;
    }


    /**
     * Проверяем коды ответа страниц
     */
    public function actionAnalysisShortcodeControl()
    {
        $shortcode_array = array();
        $shortcode_array_full = array();
        $result_filename = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'shortcodes.csv';
        $result_filename_full = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'shortcodes-full.csv';
        
        $pages_filename = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'pages.csv';
        if (file_exists($pages_filename)) {
            $pages_list = file_get_contents($pages_filename);
            $pages_list = str_replace('https://egdu.ru', 'http://egdu.loc', $pages_list);
            if (!empty($pages_list)) {
                $pages_list = explode("\r\n", $pages_list);
                if (!empty($pages_list) && is_array($pages_list)) {

                    foreach ($pages_list as $url) {
                        if (!empty($url)) {

                            $html = \app\helpers\CurlHelper::newObj()->get($url)->body();
                            if (!empty($html)) {
                            	preg_match_all('/\[[^\[\]]+\]/', $html, $shortcode);
                            }

                            if (!empty($shortcode[0])) {
                            	$shortcode_array = array_merge($shortcode_array, $shortcode[0]);
                            	foreach ($shortcode[0] as $key => $value) {
                            		if (empty($shortcode_array_full[$value])) {
                            			$shortcode_array_full[$value] = array();
                            		}
                            		$shortcode_array_full[$value][] = $url;
                            	}
                            }
                            
                        }
                    }
                }
            }
        }

        $shortcode_array = array_unique($shortcode_array);

        $data = implode("\r\n", $shortcode_array);
        file_put_contents($result_filename, $data);


        $data_full = array();
        foreach ($shortcode_array_full as $key => $value) {
        	$data_full[] = $key . ';' . implode(';', $value);
        }
        $data_full = implode("\r\n", $data_full);


        file_put_contents($result_filename, $data);
        file_put_contents($result_filename_full, $data_full);

        \app\helpers\CustomHelper::debug($shortcode_array);
        exit;
    }


}
