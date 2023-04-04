<?php

namespace frontend\controllers;

use common\models\db\ListElement;
use frontend\models\CheckListForm;
use frontend\models\DeleteListElementForm;
use frontend\models\MarkListElementForm;
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
                'only' => ['add', 'my-list', 'mark-as-completed', 'delete'],
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
     * http://frontend.test/list-element/add - POST-метод.
     * Обязательный параметр - description
     * @return array - полностью сериализованный элемент или ошибки
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
     * http://frontend.test/list-element/my-list - GET-метод.
     * Параметры:
     *      limit - кол-во в пачке,
     *      offset - сдвиг от начала,(нужно для пакетной выдачи данных)
     *      isCompleted - все(незадано)/0(незавершенные)/1(завершенные)
     * @return array - список коротко сериализованных элементов или ошибки
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

    /**
     * Выдает чек лист.
     * http://frontend.test/list-element/mark-as-completed - POST-метод.
     * Параметры: id - номер элемента
     * @return array - массив с success=true или ошибки
     */
    public function actionMarkAsCompleted(): array
    {
        $form = new MarkListElementForm();
        $form->load($this->request->post(), '');
        if ($form->validate() && $form->markAsCompleted()) {
            return $form->serializeToArray();
        }
        return ['errors' => $form->getFirstErrors()];
    }

    /**
     * Выдает чек лист.
     * http://frontend.test/list-element/delete - POST-метод.
     * Параметры: id - номер элемента
     * @return array - массив с success=true или ошибки
     */
    public function actionDelete(): array
    {
        $form = new DeleteListElementForm();
        $form->load($this->request->post(), '');
        if ($form->validate() && $form->delete()) {
            return $form->serializeToArray();
        }
        return ['errors' => $form->getFirstErrors()];
    }
}
