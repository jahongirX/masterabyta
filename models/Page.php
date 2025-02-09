<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Page extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * Проверяем главная ли это страница
     */
    public static function isFrontPage()
    {
        if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['permalink']) && Yii::$app->params['page']['permalink'] === '/') {
            return true;
        }
        return false;
    }

    /**
     * Проверяем главный ли ипользуется шаблон на странице
     */
    public static function isFrontPageTemplate()
    {
        if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['template']) && Yii::$app->params['page']['template'] == '1') {
            return true;
        }
        return false;
    }

    /**
     * Получаем заголовок страницы
     */
    public static function getTitle()
    {
        if (!empty(Yii::$app->params['page'])) {
            if (City::isMainCity()) {
                if (!empty(Yii::$app->params['page']['name'])) {
                    $title = Yii::$app->params['page']['name'];
                }
            } else {
                if (!empty(Yii::$app->params['page']['content_two_title_on'])) {
                    if (!empty(Yii::$app->params['page']['content_two_title'])) {
                        $title = Yii::$app->params['page']['content_two_title'];
                    }
                } else {
                    if (!empty(Yii::$app->params['page']['name'])) {
                        $title = Yii::$app->params['page']['name'];
                    }
                }
            }
        }
        if (!empty($title)) {

            // если это не главная страница
            if (!City::isMainCity()) {
                // вырезаем участки текста, предназначенные только для главной страницы
                $title = preg_replace('@\[home\](.*?)\[\/home\]@s', '', $title);
            } else {
                $title = str_replace('[home]', '', $title);
                $title = str_replace('[/home]', '', $title);
            }

            return $title;
        }
        return false;
    }

    /**
     * Форматирование текста
     */
    public static function ContentFormatting($string)
    {
        $string = trim($string);

        // Вырезаем теги из строки
        // $strippedTags = preg_replace('/<\/?(h[1-6]|aside|table)( [^>]*)?\>/', '\r\n$0\r\n', $string);
        $strippedTags = preg_replace('/(<p( [^>]*)?\>.*<\/p>|<ul( [^>]*)?\>.*<\/ul>|<iframe( [^>]*)?\>.*<\/iframe>|<div( [^>]*)?\>.*<\/div>|<h1( [^>]*)?\>.*<\/h1>|<h2( [^>]*)?\>.*<\/h2>|<h3( [^>]*)?\>.*<\/h3>|<h4( [^>]*)?\>.*<\/h4>|<h5( [^>]*)?\>.*<\/h5>|<h6( [^>]*)?\>.*<\/h6>|<aside( [^>]*)?\>.*<\/aside>|<table( [^>]*)?\>.*<\/table>)/Usi', '\r\n$0\r\n', $string);

        // Разбиваем строку на массив
        // $parts = preg_split("/\r\n/", $strippedTags, null, PREG_SPLIT_NO_EMPTY);
        $parts = array_filter(explode('\r\n', $strippedTags));

        $partsArray = array();
        if (!empty($parts)) {
            foreach ($parts as $one) {
                $onePart = trim($one);
                if ($onePart !== '') {
                    $partsArray[] = $onePart;
                }
            }
        }

        $parts = $partsArray;
        unset($partsArray);

        // Обрабатываем элементы массива функцией
        foreach ($parts as &$part) {
            preg_match_all('/(<p( [^>]*)?\>.*<\/p>|<ul( [^>]*)?\>.*<\/ul>|<iframe( [^>]*)?\>.*<\/iframe>|<div( [^>]*)?\>.*<\/div>|<h1( [^>]*)?\>.*<\/h1>|<h2( [^>]*)?\>.*<\/h2>|<h3( [^>]*)?\>.*<\/h3>|<h4( [^>]*)?\>.*<\/h4>|<h5( [^>]*)?\>.*<\/h5>|<h6( [^>]*)?\>.*<\/h6>|<aside( [^>]*)?\>.*<\/aside>|<table( [^>]*)?\>.*<\/table>)/Usi', $part, $matches);
            if (empty($matches[0])) {
                if (!empty($part)) {
                    $part = '<p>'.CustomHelper::custom_br($part).'</p>';
                }
            } else {
                preg_match_all('/(<iframe( [^>]*)?\>.*<\/iframe>|<table( [^>]*)?\>.*<\/table>|<ul( [^>]*)?\>.*<\/ul>)/Usi', $part, $matches);
                if (empty($matches[0])) {
                    if (!empty($part)) {
                        $part = CustomHelper::custom_br($part);
                    }
                }
            }
        }

        // Собираем обратно в строку и вставляем вырезанные теги на их прежние места
        $result = implode('', $parts);
        $result = preg_replace('/(<br\s?\/?>)+/s', '<br>', $result);

        return $result;
    }


    /**
     * Получаем таблицу с ценами
     */
    public static function getPriceTable($price_id)
    {
        if (!empty($price_id)) {
            $price = Price::find()->where(['id' => $price_id])->andWhere(['visible' => 1])->orderBy(['number' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();
            if (!empty($price)) {
                $html = '';
                $html .= '<div class="table-responsive">';
                $html .= '   <table class="table-price">';
                $html .= '      <tr>';
                $html .= '        <td>Наименование работ</td>';
                $html .= '        <td style="white-space:nowrap">Ед. изм.</td>';
                $html .= '        <td style="white-space:nowrap">Стоимость, руб. (от)</td>';
                $html .= '      </tr>';
                
                if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['price_type']) && Yii::$app->params['city']['price_type'] == 1) {
                    $price_type = 'price_msk';
                } else {
                    $price_type = 'price_region';
                }

                foreach($price as $pricerow){
                    $pricerow_amount = (int) $pricerow[$price_type];
                    if (empty($pricerow_amount)) {
                        $pricerow_amount = 'Бесплатно';
                    }

                    $html .= '<tr>';
                    if (!empty($pricerow['link'])) {
                        $html .= '  <td style="width:150px"><a href="'.$pricerow['link'].'">'. $pricerow['name'] .'</a></td>';
                    } else {
                        $html .= '  <td>'. $pricerow['name'] .'</td>';
                    }
                    $html .= '  <td style="width:150px">'. $pricerow['unit'] .'</td>';
                    $html .= '  <td style="width:150px">'. $pricerow_amount .'</td>';
                    $html .= '</tr>';
                }

                $html .= '    </table>';
                $html .= '  </div>';

                return $html;
            }
        }

        return false;
    }


    /**
     * Получаем таблицы Customprice
     */
    public static function getCustompriceTable($customprice)
    {
        if (!empty($customprice)) {
            $customprice = trim($customprice);
            $customprice = preg_replace("@[\r\n]+@", '\r\n', $customprice);
            $customprice = explode('\r\n', $customprice);
            $customprice = array_map('trim', $customprice);
            $customprice_count = count($customprice);
            $custompriceArr = array();
            for ($i=0; $i < $customprice_count; $i++) { 
                $one = explode('||', $customprice[$i]);
                if (!empty($one[0]) && !empty($one[1])) {
                    $one = array_map('trim', $one);
                    $custompriceArr[$one[0]] = $one[1];

                    if (!empty($one[2])) {
                        $one[2] = strtolower($one[2]);
                        if ($one[2] === 'html') {
                            $custompriceArr[$one[0]] = 'html'.$one[1];
                        }
                    }

                }
            }
            if (!empty($custompriceArr)) {
                $pricetable_id = array_values($custompriceArr);
                if (!empty($pricetable_id)) {
                    $pricetable = Pricetable::find()->select(['id', 'price'])->where(['id' => $pricetable_id])->andWhere(['visible' => 1])->asArray()->all();
                    if (!empty($pricetable)) {
                        $pricetable_count = count($pricetable);
                        for ($i=0; $i < $pricetable_count; $i++) { 
                            if (!empty($pricetable[$i]['price'])) {
                                $pricetable[$i]['price'] = explode(',', $pricetable[$i]['price']);
                                $pricetable[$i]['price'] = array_map('trim', $pricetable[$i]['price']);
                                $pricetable[$i]['price-list'] = Price::find()->where(['id' => $pricetable[$i]['price']])->andWhere(['visible' => 1])->orderBy(['number' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();
                            }
                        }
                    }
                    $pricetable = CustomHelper::customMultiParamArray($pricetable, 'id');
                }
            }

            if (!empty($custompriceArr)) {
                $pricetableFull = array();

                foreach ($custompriceArr as $key => $value) {
                    if (!empty($pricetable) && !empty($pricetable[$value]['price'])) {
                        $pricetableFull[] = array(
                            'id' => $value,
                            'name' => $key,
                            'price' => $pricetable[$value]['price-list'],
                            );
                    } else {
                        if (strripos($value, 'html') === 0) {
                            $pricetablehtml_id = str_replace('html', '', $value);
                            $pricetablehtml = Pricetablehtml::getPriceTable($pricetablehtml_id, 'table-price', $key);
                            $pricetableFull[] = array(
                                'id' => $pricetablehtml_id,
                                'name' => $key,
                                'price' => null,
                                'pricetablehtml' => $pricetablehtml,
                                );
                        }
                    }
                }
                // \app\helpers\CustomHelper::debug($pricetableFull);
            }

            if (!empty($pricetableFull)) {
                $html = '';

                if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['price_type']) && Yii::$app->params['city']['price_type'] == 1) {
                    $price_type = 'price_msk';
                } else {
                    $price_type = 'price_region';
                }

                $html .='<div class="price-oglav">';
                $pricetableFull_count = count($pricetableFull);
                for ($i=0; $i < $pricetableFull_count; $i++) { 
                    if (!empty($pricetableFull[$i]['price']) || !empty($pricetableFull[$i]['pricetablehtml'])) {
                        $html .='<p><a class="scroll-link" href="#customprice-'.$i.'">'.$pricetableFull[$i]['name'].'</a></p>';
                    }
                }
                $html .='</div>';

                for ($i=0; $i < $pricetableFull_count; $i++) {
                    if (!empty($pricetableFull[$i]['price'])) {
                        $html .= '<h2 class="customprice-title" id="customprice-'.$i.'">'.$pricetableFull[$i]['name'].'</h2>';
                        $html .= '<div class="table-responsive">';
                        $html .= '  <table class="table-price">';
                        $html .= '     <tr>';
                        $html .= '      <th>Наименование</th>';
                        $html .= '      <th>Ед. изм.</th>';
                        $html .= '      <th>Цена, руб. (от)</th>';
                        $html .= '    </tr>';


                        foreach($pricetableFull[$i]['price'] as $pricerow){
                            $pricerow_amount = (int) $pricerow[$price_type];
                            if (empty($pricerow_amount)) {
                                $pricerow_amount = 'Бесплатно';
                            }

                            $html .= '<tr>';
                            if (!empty($pricerow['link'])) {
                                $html .= '  <td><a href="'.$pricerow['link'].'">'. $pricerow['name'] .'</a></td>';
                            } else {
                                $html .= '  <td>'. $pricerow['name'] .'</td>';
                            }
                            $html .= '  <td style="width:100px !important">'. $pricerow['unit'] .'</td>';
                            $html .= '  <td style="width:120px !important">'. $pricerow_amount .'</td>';
                            $html .= '</tr>';
                        }

                        $html .= '  </table>';
                        $html .= '</div>';
                    } elseif (!empty($pricetableFull[$i]['pricetablehtml'])) {
                        $html .= '<div id="customprice-'.$i.'">' . $pricetableFull[$i]['pricetablehtml'] . '</div>';
                    }
                }

                return $html;
            }
        }
        return false;
    }


    /**
     * Получаем контент страницы
     */
    public static function getContent()
    {
        if (!empty(Yii::$app->params['page'])) {
            if (City::isMainCity()) {
                if (!empty(Yii::$app->params['page']['content'])) {
                    $content = Yii::$app->params['page']['content'];
                    if (Yii::$app->params['page']['content_aside']) {
//                        $content = Yii::$app->params['page']['content_aside'] . $content;
                    }
                }
            } else {
                if (!empty(Yii::$app->params['page']['content_two_on'])) {
                    if (!empty(Yii::$app->params['page']['content_two'])) {
                        $content = Yii::$app->params['page']['content_two'];
                        if (Yii::$app->params['page']['content_two_aside']) {
//                            $content = Yii::$app->params['page']['content_two_aside'] . $content;
                        }
                    }
                } else {
                    if (!empty(Yii::$app->params['page']['content'])) {
                        $content = Yii::$app->params['page']['content'];
                        if (Yii::$app->params['page']['content_aside']) {
//                            $content = Yii::$app->params['page']['content_aside'] . $content;
                        }
                    }
                }
            }
        }

        // вставляем шорткоды прайсов
        if (!empty($content)) {
            $content = preg_replace('/<p(\s[^\>]*)?>\s*(\[\s?price\sid=(\d+)\s?\])\s*<\/p>/', "$2", $content);
            preg_match_all('/\[\s?price\sid=(\d+)\s?\]/', $content, $price_shortcode);
            if (!empty($price_shortcode[1]) && is_array($price_shortcode[1])) {
                $price_shortcode_count = count($price_shortcode);
                for ($i=0; $i < $price_shortcode_count; $i++) { 
                    if (!empty($price_shortcode[0][$i]) && !empty($price_shortcode[1][$i])) {
                        $shortcode = $price_shortcode[0][$i];
                        $pricetable_id = $price_shortcode[1][$i];
                        $pricetable = Pricetable::find()->select(['id', 'price'])->where(['id' => $pricetable_id])->andWhere(['visible' => 1])->limit(1)->asArray()->one();
                        if (!empty($pricetable) && !empty($pricetable['price'])) {
                            $price = explode(',', $pricetable['price']);
                            if (!empty($price)) {
                                $pricetable_html = static::getPriceTable($price);
                                $content = str_replace($shortcode, $pricetable_html, $content);
                            }
                        }
                    }
                }
            }
        }

        // вставляем шорткоды таблиц цен HTML
        if (!empty($content)) {
            $content = preg_replace('/<p(\s[^\>]*)?>\s*(\[\s?pricetablehtml\s+id=(\d+)\s?\])\s*<\/p>/', "$2", $content);
            preg_match_all('/\[\s?pricetablehtml\s+id=(\d+)\s?\]/', $content, $price_shortcode);
            if (!empty($price_shortcode[1]) && is_array($price_shortcode[1])) {
                $price_shortcode_count = count($price_shortcode[1]);
                for ($i=0; $i < $price_shortcode_count; $i++) { 
                    if (!empty($price_shortcode[0][$i]) && !empty($price_shortcode[1][$i])) {
                        $shortcode = $price_shortcode[0][$i];
                        $pricetable_id = $price_shortcode[1][$i];
                        $pricetable = Pricetablehtml::getPriceTable($pricetable_id);
                        if (!empty($pricetable)) {
                            $content = str_replace($shortcode, $pricetable, $content);
                        }
                    }
                }
            }
            $content = preg_replace('/\[\s?pricetablehtml\s+id=(\d+)\s?\]/', '', $content);
        }

        // вставляем шорткод customprice
        if (!empty(Yii::$app->params['page']['customprice'])) {
            if (!empty($content)) {
                $customprice = static::getCustompriceTable(Yii::$app->params['page']['customprice']);
                $content = str_replace('[customprice]', $customprice, $content);
            }
        }

        if (!empty($content)) {

            // если это не главная страница
            if (!City::isMainCity()) {
                // вырезаем участки текста, предназначенные только для главной страницы
                $content = preg_replace('@\[home\](.*?)\[\/home\]@s', '', $content);
            } else {
                $content = str_replace('[home]', '', $content);
                $content = str_replace('[/home]', '', $content);
            }

            return static::ContentFormatting($content);
        }
        return false;
    }

    /**
     * Получаем массив название шаблонов
     */
    public static function getTemplateNamesArray()
    {
        if (!empty(Yii::$app->params['templates']) && is_array(Yii::$app->params['templates'])) {
            $templates = array();
            foreach (Yii::$app->params['templates'] as $key => $value) {
                if (!empty($value) && !empty($value['name'])) {
                    $templates[$key] = $value['name'];
                }
            }
            if (!empty($templates)) {
                return $templates;
            }
        }
        return false;
    }

    /**
     * Получаем название файла шаблона страницы
     */
    public function getTemplateFilename()
    {
        if (!empty(Yii::$app->params['templates']) && is_array(Yii::$app->params['templates'])) {
            if (isset($this->template) && $this->template !== null) {
                if (!empty(Yii::$app->params['templates'][$this->template]) && !empty(Yii::$app->params['templates'][$this->template]['file'])) {
                    $template = Yii::$app->params['templates'][$this->template]['file'];
                }
            }
            if (empty($template)) {
                if (!empty(Yii::$app->params['templates'][0]) && !empty(Yii::$app->params['templates'][0]['file'])) {
                    $template = Yii::$app->params['templates'][0]['file'];
                }
            }
            return '//template' . DIRECTORY_SEPARATOR . $template;
        }
        return false;
    }

}