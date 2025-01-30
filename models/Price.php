<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Price extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%price}}';
    }

    public static function getPrices($id = null)
    {
    	$price_query = Price::find()->where(['visible' => 1]);
        if (!empty($id)) {
            $id = preg_replace('/[^\d,]/', '', $id);
            $id = explode(',', $id);
            $price_query->andWhere(['id' => $id]);
        }
        $price = $price_query->orderBy(['number' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();

        $price_section = PriceSection::find()->where(['visible' => 1])->orderBy(['number' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();
        $price_section_id = CustomHelper::customMultiParamArray($price_section, 'id');

    	if (!empty($price)) {
    		$res = array();
    		foreach ($price as $one) {
    			if (!empty($one)) {
    				$one_price_section = (int) $one['price_section'];
    				if (empty($res[$one_price_section]) && !empty($price_section_id[$one_price_section])) {
    					$res[$one_price_section] = array(
                            'name' => $price_section_id[$one_price_section]['name'],
                            'number' => (int) $price_section_id[$one_price_section]['number'],
                            'city_msk' => $price_section_id[$one_price_section]['city_msk'],
                            'visible_subtitle' => $price_section_id[$one_price_section]['visible_subtitle'],
                            'price' => array()
                        );
    				}

                    $cost = $one['price_region'];
                    if (!empty($res[$one_price_section]['city_msk'])) {
                        if (is_string($res[$one_price_section]['city_msk'])) {
                            $res[$one_price_section]['city_msk'] = explode(',', $res[$one_price_section]['city_msk']);
                        }
                        if (!empty($res[$one_price_section]['city_msk']) && is_array($res[$one_price_section]['city_msk'])) {
                            if (!empty(Yii::$app->params['city']['id']) && in_array(Yii::$app->params['city']['id'], $res[$one_price_section]['city_msk'])) {
                                $cost = $one['price_msk'];
                            }
                        }
                    }

                    if (!empty(Yii::$app->params['country']) && !empty(Yii::$app->params['country']['iso']) && Yii::$app->params['country']['iso'] !== 'ru') {
                        if (Yii::$app->params['country']['iso'] === 'by') {
                            $cost = $one['price_by'];
                        } elseif(Yii::$app->params['country']['iso'] === 'kz') {
                            $cost = $one['price_kz'];
                        }
                    }

    				$value = array(
                        'name' => $one['name'],
                        'alias' => $one['alias'],
                        'unit' => $one['unit'],
                        'cost' => $cost,
                        'link' => $one['link']
    					);
    				$res[$one_price_section]['price'][] = $value;
    			}
    		}
    	}
    	if (empty($res)) {
    		$res = null;
    	} else {
            usort($res, function($a, $b) {
                if (!isset($a['number']) || !isset($b['number'])) {
                    return 0;
                }
                if ($a['number'] == $b['number']) {
                    return 0;
                }
                return ($a['number'] < $b['number']) ? -1 : 1;
            });
    	}
    	return $res;
    }

}