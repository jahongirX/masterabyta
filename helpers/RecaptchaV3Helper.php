<?php

namespace app\helpers;

use Yii;
use app\models\Setting;

class RecaptchaV3Helper
{
	protected $value = null;
	protected $public_key = null;
	protected $secret_key = null;
	protected $script = '<script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key&trustedtypes=true"></script>';
	protected $siteverify_url = 'https://www.google.com/recaptcha/api/siteverify';

	/**
	 * Инициализируем переменные
	 */
	public function __construct() {
		$this->value = (float) Setting::getSetting('recaptcha-value');
		$this->value = round($this->value, 1);
		$this->public_key = Setting::getSetting('recaptcha-public-key');
		$this->secret_key = Setting::getSetting('recaptcha-secret-key');
	}

	/**
	 * Получаем js скрипт reCAPTCHA
	 */
	public function getScript() {
		if ($this->value > 0 && !empty($this->public_key) && !empty($this->secret_key)) {
			$script = str_replace('reCAPTCHA_site_key', $this->public_key, $this->script);
			return $script;
		}
		return false;
	}

	/**
	 * Получаем публичный ключ reCAPTCHA
	 */
	public function getPublicKey() {
		if ($this->value > 0 && !empty($this->public_key) && !empty($this->secret_key)) {
			return $this->public_key;
		}
		return false;
	}

	/**
	 * Javascript обработчик reCAPTCHA
	 * $form_id - ID формы, которую нужно защитить (string)
	 * $action - название действия, которое проверяется (string)
	 */
	public function getJsFormHandler($form_id, $action) {
		if ($this->value > 0 && !empty($this->public_key) && !empty($this->secret_key)) {
			$var_block = 'JsFormHandler_'.$action.'_block';
			$js = <<<JS
				var {$var_block} = 0;
				$(document).on('submit', '#{$form_id}', function(e){
					if ({$var_block} == 1) {
						return false;
					}
			        if ({$var_block} == 0) {
				        e.preventDefault();
				        var form = $(this);
			        	{$var_block} = 1;

				        grecaptcha.ready(function() {
				          grecaptcha.execute('{$this->public_key}', {action: '{$action}'}).then(function(token) {
				              if (form.find('input[name="g-recaptcha-response"]').length == 0) {
				              	form.append('<input type="hidden" class="hidden" name="g-recaptcha-response">');
				              }
				              form.find('input[name="g-recaptcha-response"]').val(token);
				              {$var_block} = 2;
				              form.submit();
				              {$var_block} = 0;
				          });
				        });
			        }
				});
JS;

    		return $js;
    	}
    	return false;
	}

	/**
	 * Проверка reCAPTCHA (boolean)
	 * $action - название действия, которое проверяется (string)
	 */
	public function validate($action) {
		if ($this->value > 0) {
		    if(!empty($_POST['g-recaptcha-response'])){
		        $g_recaptcha_response = $_POST['g-recaptcha-response'];
		        $post = array(
		            'secret' => $this->secret_key,
		            'response' => $g_recaptcha_response,
		            'remoteip' => Yii::$app->request->userIP
		        );
		        $res = CustomHelper::custom_curl($this->siteverify_url, $post);		        
			    if($res){
			    	$res = json_decode($res, true);
			        if(!empty($res) && !empty($res['success']) && !empty($res['score'])){
			        	if ($res['score'] >= $this->value) {
			        		if (!empty($res['action']) && $res['action'] === $action) {
			            		return true;
			        		}
			        	}
			        }
			    }
		    }
		    return false;
		} else {
			return true;
		}
	}



}