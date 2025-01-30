<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\CustomHelper;

class Menu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * Получаем массив активных страниц
     */
    public static function getActivePages()
    {
        if (!empty(Yii::$app->params['active-pages'])) {
            return Yii::$app->params['active-pages'];
        }
        $active_pages_query = Page::find()->select(['id', 'permalink'])->where(['visible' => 1]);
        if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['id'])) {
            $active_pages_query->andWhere([
                'OR',
                ['like', 'city', Yii::$app->params['city']['id'], false],
                ['like', 'city', Yii::$app->params['city']['id'].',%', false],
                ['like', 'city', '%,'.Yii::$app->params['city']['id'], false],
                ['like', 'city', '%,'.Yii::$app->params['city']['id'].',%', false],
            ]);
        }
        if (!City::isMainCity()) {
            $active_pages_query->andWhere([
                'OR',
                ['skryt_na_poddomene' => 0],
                ['skryt_na_poddomene' => null],
            ]);
        }
        $active_pages = $active_pages_query->asArray()->all();
        if (!empty($active_pages)) {
            $data = array();
            foreach ($active_pages as $one) {
                if (!empty($one['id']) && !empty($one['permalink']) ) {
                    $key = 'page='.$one['id'];
                    $data[$key] = $one['permalink'];
                    $data[$one['permalink']] = $one['permalink'];
                }
            }
            Yii::$app->params['active-pages'] = $data;
            unset($data);
            return Yii::$app->params['active-pages'];
        }
        return null;
    }

    /**
     * Проверяем ссылки в меню на доступность страниц
     * $data - строка пунктов меню (string)
     */
    public static function controlMenuArray($data)
    {
        $menu = array();

        if (!empty($data)) {
            $active_pages = static::getActivePages();

            $data = preg_replace_callback('/\[[^\[\]]*\]/s', function($matches){
                return str_replace(["\r\n", "\r", "\n"], '*', $matches[0]);
            }, $data);

            $data = str_replace(["\r\n", "\r", "\n"], '\r\n', $data);
            $data = explode('\r\n', $data);

            if (!empty($data) && is_array($data)) {
                foreach ($data as $one) {
                    if (!empty($one)) {
                        if (substr($one, 0, 1) === '[' && substr($one, -1) === ']') {
                            // если это многоуровневое меню
                            $one_row = trim($one, '[*]');
                            if (!empty($one_row)) {
                                $one_row = explode('*', $one_row);
                                if (!empty($one_row)) {
                                    $one_row_count = count($one_row);
                                    if ($one_row_count > 1) {
                                        $one_row_name = trim($one_row[0]);
                                        $submenu = array();
                                        for ($i=1; $i < $one_row_count; $i++) { 
                                            $one_row_submenu = explode('||', $one_row[$i], 2);
                                            if (isset($one_row_submenu[0]) && isset($one_row_submenu[1])) {
                                                $one_row_submenu_name = trim($one_row_submenu[0]);
                                                $one_row_submenu_link = trim($one_row_submenu[1]);
                                                $one_row_submenu_link = trim($one_row_submenu_link, '/');
                                                $one_row_submenu_link = trim($one_row_submenu_link);

                                                if (!empty($active_pages[$one_row_submenu_link])) {
                                                    $one_row_submenu_link = '/' . $active_pages[$one_row_submenu_link];
                                                    $submenu[] = array(
                                                        'name' => $one_row_submenu_name,
                                                        'link' => $one_row_submenu_link.'/'
                                                        );
                                                } elseif (strpos($one_row_submenu_link, 'http') === 0) {
                                                    $submenu[] = array(
                                                        'name' => $one_row_submenu_name,
                                                        'link' => $one_row_submenu_link
                                                        );
                                                } elseif (strpos($one_row_submenu_link, '#') === 0) {
                                                    $one_row_submenu_link = '/' . $one_row_submenu_link;
                                                    $submenu[] = array(
                                                        'name' => $one_row_submenu_name,
                                                        'link' => $one_row_submenu_link
                                                        );
                                                }

                                            }
                                        }
                                        $menu[] = array(
                                            'name' => $one_row_name,
                                            'link' => $submenu
                                        );
                                    }
                                }
                            }
                        } else {
                            // простое одноуровневое меню
                            $one_row = explode('||', $one, 2);
                            if (isset($one_row[0]) && isset($one_row[1])) {
                                $one_row_name = trim($one_row[0]);
                                $one_row_link = trim($one_row[1]);
                                $one_row_link = trim($one_row_link, '/');
                                $one_row_link = trim($one_row_link);

                                if (!empty($active_pages[$one_row_link])) {
                                    $one_row_link = '/' . $active_pages[$one_row_link];
                                    $menu[] = array(
                                        'name' => $one_row_name,
                                        'link' => $one_row_link.'/'
                                        );
                                } elseif (strpos($one_row_link, 'http') === 0) {
                                    $menu[] = array(
                                        'name' => $one_row_name,
                                        'link' => $one_row_link
                                        );
                                } elseif (strpos($one_row_link, '#') === 0) {
                                    $one_row_link = '/' . $one_row_link;
                                    $menu[] = array(
                                        'name' => $one_row_name,
                                        'link' => $one_row_link
                                        );
                                }
                            }
                        }
                    }
                }
            }
        }
        return $menu;
    }

    /**
     * Получаем массив пунктов меню
     */
    public static function getMenuArray($id)
    {
        $data = static::find()->select(['menu'])->where(['id' => $id])->andWhere(['visible' => 1])->limit(1)->scalar();
        return static::controlMenuArray($data);
    }

    /**
     * Получаем Заголовок меню
     */
    public static function getMenuName($id)
    {
    	if (!empty($id)) {
    		return static::find()->select(['name'])->where(['id' => $id])->andWhere(['visible' => 1])->limit(1)->scalar();
    	}
    	return false;
    }

    /**
     * Получаем готовое меню в формате html (string)
     * $id - ID меню
     * $class - html класс меню (string)
     * $max_count - максимальное количество пунктов меню (остальные будут свернуты) (int)
     */
    public static function getMenuHtml($id, $class, $max_count = null)
    {
        if (!empty($id)) {
            $menu = static::getMenuArray($id);
            if (!empty($menu)) {
                return static::formatMenuHtml($menu, $class, $max_count);
            }
        }
        return false;
    }

    /**
     * Формируем html разметку для пунктов меню (string)
     * $menu - массив пунктов меню (array)
     * $class - html класс меню (string)
     * $max_count - максимальное количество пунктов меню (остальные будут свернуты) (int)
     */
    public static function formatMenuHtml($menu, $class, $max_count = null)
    {
        if (!empty($menu)) {
            if (!empty(Yii::$app->params['page']) && isset(Yii::$app->params['page']['permalink'])) {
                $permalink = trim(Yii::$app->params['page']['permalink']);
                $permalink = trim($permalink, '/');
                $permalink = trim($permalink);
            }

            $html = '';
            $html .= '<ul class="'.$class.'">';
            $item_counter = 0;
            foreach ($menu as $one) {
                if (!empty($one) && !empty($one['name'])) {
                    $max_count = (int) $max_count;
                    if (!empty($max_count)) {
                        if ($item_counter < $max_count) {
                            $item_class = 'hidden open always-open';
                        } else {
                            $item_class = 'hidden';
                        }
                    } else {
                        $item_class = '';
                    }
                    if (isset($one['link'])) {
                        if (!is_array($one['link'])) {
                            $one_link = trim($one['link'], '/');
                            if (isset($permalink) && $permalink === $one_link) {
                                $html .= '<li class="menu-item current-menu-item '.$item_class.'"><a href="'.$one['link'].'">'.$one['name'].'</a></li>';
                            } else {
                                $html .= '<li class="menu-item '.$item_class.'"><a href="'.$one['link'].'">'.$one['name'].'</a></li>';
                            }
                        } else {
                            $html .= '<li class="menu-item menu-item-has-children '.$item_class.'"><a href="#">'.$one['name'].'</a>';
                            $html .= '  <ul class="sub-menu">';
                            foreach ($one['link'] as $subitem) {
                                if (!empty($subitem) && !empty($subitem['name'])) {

                                    if (isset($subitem['link'])) {
                                        if (!is_array($subitem['link'])) {
                                            $subitem_link = trim($subitem['link'], '/');
                                            if (isset($permalink) && $permalink === $subitem_link) {
                                                $html .= '<li class="menu-item current-menu-item"><a href="'.$subitem['link'].'">'.$subitem['name'].'</a></li>';
                                            } else {
                                                $html .= '<li class="menu-item"><a href="'.$subitem['link'].'">'.$subitem['name'].'</a></li>';
                                            }
                                        } else {
                                            $html .= '<li class="menu-item menu-item-has-children"><a href="#">'.$subitem['name'].'</a>';
                                            $html .= '  <ul class="sub-menu">';
                                            foreach ($subitem['link'] as $subitem2) {
                                                if (!empty($subitem2) && !empty($subitem2['name'])) {

                                                    if (isset($subitem2['link'])) {
                                                        if (!is_array($subitem2['link'])) {
                                                            $subitem2_link = trim($subitem2['link'], '/');
                                                            if (isset($permalink) && $permalink === $subitem2_link) {
                                                                $html .= '<li class="menu-item current-menu-item"><a href="'.$subitem2['link'].'">'.$subitem2['name'].'</a></li>';
                                                            } else {
                                                                $html .= '<li class="menu-item"><a href="'.$subitem2['link'].'">'.$subitem2['name'].'</a></li>';
                                                            }
                                                        } else {
                                                            $html .= '<li class="menu-item"><a href="#">'.$subitem2['name'].'</a></li>';
                                                        }
                                                    } else {
                                                        $html .= '<li class="menu-item"><a href="#">'.$subitem2['name'].'</a></li>';
                                                    }

                                                }
                                            }
                                            $html .= '  </ul>';
                                            $html .= '</li>';
                                        }
                                    } else {
                                        $html .= '<li class="menu-item"><a href="#">'.$subitem['name'].'</a></li>';
                                    }

                                }
                            }
                            $html .= '  </ul>';
                            $html .= '</li>';
                        }
                    } else {
                        $html .= '<li class="menu-item '.$item_class.'"><a href="#">'.$one['name'].'</a></li>';
                    }

                    $item_counter++;
                }
            }
            if (!empty($max_count) && $item_counter > $max_count) {
                $html .= '<li class="menu-item-open-toggle"><a role="button" class="menu-item-open-toggle-btn"><span class="text-close">Смотреть весь список...</span><span class="text-open">Свернуть список...</span></a></li>';
            }
            $html .= '</ul>';
            return $html;
        }
        return false;
    }




}