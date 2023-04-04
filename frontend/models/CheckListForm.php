<?php

namespace frontend\models;

use common\models\db\ListElement;

/**
 * Сериализует чек лист
 */
class CheckListForm extends BaseApiList
{
    public $isCompleted;

    private $listQuery;

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            [['isCompleted',], 'integer'],
            ['isCompleted', 'in', 'range' => [0, 1]]
        ]);
    }

    /**
     * В этои методе делаюся необходимые запросы для получения списка
     * @return true
     */
    public function getMyList(): bool
    {
        $this->listQuery = ListElement::find()
            ->andFilterWhere([
                'isCompleted' => $this->isCompleted
            ])
            ->offset($this->offset)
            ->limit($this->limit);
        return true;
    }

    public function serializeToArray(): array
    {
        $result = [];
        /** @var ListElement $element */
        foreach ($this->listQuery->each() as $element) {
            $result[] = $element->serializeShortToArray();
        }
        return ['listElements' => $result];
    }
}
