<?php

namespace frontend\models;

use common\models\db\ListElement;
use yii\base\Model;

/**
 * Проверяет наличие, затем отмечает элемент списка выполненным
 */
class MarkListElementForm extends Model
{
    public $id;

    private ?ListElement $element;

    public function rules(): array
    {
        return [
            [['id',], 'required'],
            [['id',], 'integer'],
            [
                'id',
                'exist',
                'targetClass' => ListElement::class,
                'targetAttribute' => ['id' => 'listElementId']
            ],
        ];
    }

    /**
     * В этои методе делаюся необходимые запросы для получения списка
     * @return true
     */
    public function markAsCompleted(): bool
    {
        $this->element = ListElement::findOne($this->id);
        $this->element->markASCompleted();
        return $this->element->save();
    }

    public function serializeToArray(): array
    {
        return ['listElement' => $this->element->serializeToArray()];
    }
}
