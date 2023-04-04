<?php

namespace frontend\models;

use common\models\db\ListElement;
use yii\base\Model;
use yii\db\StaleObjectException;

/**
 * Проверяет наличие, затем отмечает элемент списка выполненным
 */
class DeleteListElementForm extends Model
{
    public $id;

    public function rules(): array
    {
        return [
            [['id',], 'required'],
            [['id',], 'integer'],
            [
                'id',
                'exist',
                'targetClass' => ListElement::class,
                'targetAttribute' => ['id' => 'listElementId'],
                'message' => 'Элемент не найден',
            ],
        ];
    }

    /**
     * В этои методе делаюся необходимые запросы для удаления элемента списка
     * @return true
     */
    public function delete(): bool
    {
        $element = ListElement::findOne($this->id);
        try {
            return $element->delete() !== false;
        } catch (StaleObjectException $e) {
            $this->addError('id', $e->getMessage());
        } catch (\Throwable $e) {
            $this->addError('id', $e->getMessage());
        }
        return false;
    }

    public function serializeToArray(): array
    {
        return ['success' => true];
    }
}
