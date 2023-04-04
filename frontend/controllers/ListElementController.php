<?php

namespace frontend\controllers;

use common\models\db\ListElement;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class ListElementController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['add', 'all'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'languages' => [
                    'en',
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Добавляет элемент в чек-лист.
     * POST-метод. Обязательный параметр - description
     * @return array
     */
    public function actionAdd(): array
    {
        $listElement = new ListElement();
        $listElement->load($this->request->post(), '');
        if ($listElement->validate() && $listElement->save()) {
            return $listElement->serializeToArray();
        }
        return ['errors' => $listElement->getFirstErrors()];
    }
}
