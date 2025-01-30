<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Pricetablehtml extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pricetablehtml}}';
    }


	/**
	 * Получаем Таблицы прайса HTML
	 */
	public static function getPriceTable($id, $classTable = 'table-price', $header = null) {

		if (!empty($id)) {
			$id = preg_replace('/[^\d\s\,\;]/', '', $id);
			$id = str_replace(["\r\n", "\r", "\n", ',', ';'], ',', $id);
			$id = explode(',', $id);
			if (!empty($id) && is_array($id)) {
				$id = array_unique($id);
				$id = array_diff($id, ['', ' ', '0', 0, null]);
				if (!empty($id) && is_array($id)) {
					$pricetable = Pricetablehtml::find()->where(['id' => $id])->andWhere(['visible' => 1])->asArray()->all();
					$pricetable = CustomHelper::CustomMultiParamArray($pricetable, 'id');
					if (!empty($pricetable) && is_array($pricetable)) {
						$pricetableArr = array();
						foreach ($id as $one) {
							if (!empty($one) && !empty($pricetable[$one])) {
								$pricetableArr[$one] = $pricetable[$one];
							}
						}
					}
				}
			}
		}

		$html = '';

		if (!empty($pricetableArr) && is_array($pricetableArr)) {
			foreach ($pricetableArr as $key => $value) {
				if (!empty($value)) {
					if (!empty($header)) {
						$pricetable_header = '<h2 class="b-fullprice__title">' . CustomHelper::custom_br($header) . '</h2>';
					} elseif (!empty($value['header'])) {
						$pricetable_header = '<h2 class="b-fullprice__title">' . CustomHelper::custom_br($value['header']) . '</h2>';
					} else {
						$pricetable_header = null;
					}

					$html_price = '';
					if (!empty($value['price'])) {
						preg_match_all('@<tr[^>]*>\s*<td>(.*)<\/td>\s*<\/tr>@Us', $value['price'], $price_rows);
						if (!empty($price_rows[1]) && is_array($price_rows[1])) {
							$price_rows = $price_rows[1];
							$price_rows_count = count($price_rows);
							for ($i=0; $i < $price_rows_count; $i++) { 
								if (!empty($price_rows[$i])) {
									$price_row = preg_replace('@<\/td>\s*<td>@', '</td><td>', $price_rows[$i]);
									$price_row = explode('</td><td>', $price_row);
									if (!empty($price_row) && is_array($price_row)) {
										$html_price .= '<tr>';
										if (isset($price_row[0])) {
											$html_price .= '<td>'.$price_row[0].'</td>';
										}
										if (isset($price_row[1])) {
											$html_price .= '<td>'.$price_row[1].'</td>';
										}
										if (isset($price_row[2]) && isset($price_row[3])) {
											if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['price_type']) && Yii::$app->params['city']['price_type'] == 1) {
												// московские цены
												$html_price .= '<td>'.$price_row[2].'</td>';
											} else {
												// цены для регионов
												$html_price .= '<td>'.$price_row[3].'</td>';
											}
										} else {
											if (isset($price_row[2])) {
												$html_price .= '<td>'.$price_row[2].'</td>';
											}
											if (isset($price_row[3])) {
												$html_price .= '<td>'.$price_row[3].'</td>';
											}
										}
										$html_price .= '</tr>';
									}
								}
							}
						}
					}

					$html .= $pricetable_header.'
						<div class="table-responsive">
							<table class="'.$classTable.'">
								'.$html_price.'
							</table>
						</div>';
				}
			}
		}

		return $html;
	}


	/**
	 * Получаем прайс HTML
	 */
	public static function getPrice($id) {

		if (!empty($id)) {
			$id = preg_replace('/[^\d\s\,\;]/', '', $id);
			$id = str_replace(["\r\n", "\r", "\n", ',', ';'], ',', $id);
			$id = explode(',', $id);
			if (!empty($id) && is_array($id)) {
				$id = array_unique($id);
				$id = array_diff($id, ['', ' ', '0', 0, null]);
				if (!empty($id) && is_array($id)) {
					$pricetable = Pricetablehtml::find()->where(['id' => $id])->andWhere(['visible' => 1])->asArray()->all();
					$pricetable = CustomHelper::CustomMultiParamArray($pricetable, 'id');
					if (!empty($pricetable) && is_array($pricetable)) {
						$pricetableArr = array();
						foreach ($id as $one) {
							if (!empty($one) && !empty($pricetable[$one])) {
								$pricetableArr[$one] = $pricetable[$one];
							}
						}
					}
				}
			}
		}

		$html = '';

		if (!empty($pricetableArr) && is_array($pricetableArr)) {
			foreach ($pricetableArr as $key => $value) {
				if (!empty($value)) {
					if (!empty($value['header'])) {
						$html .= '<h2 class="b-fullprice__title">' . CustomHelper::custom_br($value['header']) . '</h2>';
					}
					if (!empty($value['price'])) {
						$html .= $value['price'];
					}
				}
			}
		}

		return $html;
	}

}