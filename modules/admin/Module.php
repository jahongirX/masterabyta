<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        if( !Yii::$app->user->isGuest ){
            if ( !Yii::$app->user->can('adminPanel') ) {
                exit('Access is denied');
            }
            if( Yii::$app->user->identity->ban == 1 ){
                exit('Access is denied');
            }
            if (empty(Yii::$app->request->userIP)) {
                exit('Access is denied');
            }
        }

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                        'denyCallback' => function($rule, $action) {
                            // return Yii::$app->response->redirect(['/login']);
                            throw new NotFoundHttpException('Страница не найдена.', 404);
                        }
                    ],
                    [
                        'allow' => true,
                        'roles' => ['adminPanel'],
                        'denyCallback' => function($rule, $action) {
                            exit('Access is denied');
                        }
                    ],
                ],
            ],
        ];
    }
}
