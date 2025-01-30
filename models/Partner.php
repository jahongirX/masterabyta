<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Partner extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%partner}}';
    }

    public static function getPartner($city = null, $page = null) {
    	if (!empty($city) && !empty($page)) {
    		$partner = static::find()->where([
                'OR',
                ['like', 'city', $city, false],
                ['like', 'city', $city.',%', false],
                ['like', 'city', '%,'.$city, false],
                ['like', 'city', '%,'.$city.',%', false],
            ])->andWhere([
                'OR',
                ['like', 'page', $page, false],
                ['like', 'page', $page.',%', false],
                ['like', 'page', '%,'.$page, false],
                ['like', 'page', '%,'.$page.',%', false],
            ])->andWhere(['visible' => 1])->orderBy(['id' => SORT_ASC])->asArray()->limit(1)->one();

            if (!empty($partner)) {
                // Парсим параметры для переменных
                if (!empty($partner['params']) && is_string($partner['params'])) {
                    $params = array();
                    $partner['params'] = trim($partner['params']);
                    $partner['params'] = preg_replace("@[\r\n]+@", '\r\n', $partner['params']);
                    $partner['params'] = explode('\r\n', $partner['params']);
                    $partner['params'] = array_map('trim', $partner['params']);
                    if (!empty($partner['params']) && is_array($partner['params'])) {
                        foreach ($partner['params'] as $one) {
                            $param = explode('=', $one, 2);
                            if (isset($param[0]) && isset($param[1])) {
                                $params[$param[0]] = $param[1];
                            }
                        }
                        $partner['params'] = $params;
                    }
                }

                if (!empty($partner['back_email']) && is_string($partner['back_email'])) {
                    $partner['back_email'] = trim($partner['back_email']);
                    $partner['back_email'] = trim($partner['back_email'], ',');
                    $partner['back_email'] = trim($partner['back_email']);
                    $partner['back_email'] = explode(',', $partner['back_email']);
                    $partner['back_email'] = array_map('trim', $partner['back_email']);
                }

                $partnercontact = Partnercontact::find()->where(['partner_id' => $partner['id']])->orderBy(['id' => SORT_ASC])->asArray()->limit(1)->one();
                if (!empty($partnercontact)) {
                    if (!empty($partnercontact['phone'])) {
                        $partner['phone'] = $partnercontact['phone'];
                    }
                    if (!empty($partnercontact['token_cpa_rukiizplech'])) {
                        $partner['token_cpa_rukiizplech'] = $partnercontact['token_cpa_rukiizplech'];
                    }

                    if (!empty($partnercontact['token_cpa_servicelead'])) {
                        $partner['token_cpa_servicelead'] = $partnercontact['token_cpa_servicelead'];

                        if (!empty($partnercontact['thread_id_cpa_servicelead'])) {
                            $partner['thread_id_cpa_servicelead'] = $partnercontact['thread_id_cpa_servicelead'];
                        } else {
                            $partner['thread_id_cpa_servicelead'] = null;
                        }

                        if (!empty($partnercontact['offer_id_cpa_servicelead'])) {
                            $partner['offer_id_cpa_servicelead'] = $partnercontact['offer_id_cpa_servicelead'];
                        } else {
                            $partner['offer_id_cpa_servicelead'] = 0;
                        }
                    }

                    if (!empty($partnercontact['token_cpa_leadcentre'])) {
                        $partner['token_cpa_leadcentre'] = $partnercontact['token_cpa_leadcentre'];
                    }

                }
            }
    	}

    	if (empty($partner)) {
    		$partner = null;
    	}
    	return $partner;
    }

}