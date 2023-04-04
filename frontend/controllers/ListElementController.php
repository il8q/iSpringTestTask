<?php

namespace frontend\controllers;

use common\models\db\ListElement;
use frontend\models\CheckListForm;
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
                'only' => ['add', 'my-list'],
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
                    'my-list' => ['get'],
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

    /**
     * Выдает чек лист.
     * GET-метод.
     * Параметры: limit - кол-во в пачке, offset - сдвиг от начала
     * @return array
     */
    public function actionMyList(): array
    {
        $form = new CheckListForm();
        $form->load($this->request->get(), '');
        if ($form->validate() && $form->getMyList()) {
            return $form->serializeToArray();
        }
        return ['errors' => $form->getFirstErrors()];
    }
}
