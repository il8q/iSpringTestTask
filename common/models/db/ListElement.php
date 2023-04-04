<?php

namespace common\models\db;

/**
 * This is the model class for table "listElement".
 *
 * @property int $listElementId
 * @property string|null $description
 * @property int|null $isCompleted
 * @property int|null $createdAt
 * @property int|null $updatedAt
 */
class ListElement extends \common\models\db\BaseListElement
{
    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if (empty($this->createdAt)) {
            $this->createdAt = time();
        }
        if (empty($this->updatedAt)) {
            $this->updatedAt = time();
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            [['description'], 'required', 'message' => 'Сообщение не может быть пустым'],
            ['description',
                'string',
                'min' => 2,
                'max' => 1000,
                'tooShort' => 'Сообщение может быть пустым',
                'tooLong' => 'Сообщение должно быть не длинее 1000 символов',
            ],
            ['isCompleted', 'default', 'value' => 0],
        ]);
    }

    public function serializeShortToArray(): array
    {
        $result = [];
        $result['listElementId'] = (int)$this->listElementId;
        $result['description'] = $this->description;
        $result['isCompleted'] = (bool)$this->isCompleted;
        return $result;
    }

    public function serializeToArray(): array
    {
        $result = $this->serializeShortToArray();
        $result['createdAt'] = (int)$this->createdAt;
        $result['updatedAt'] = (int)$this->updatedAt;
        return $result;
    }

    public function markASCompleted()
    {
        if (!$this->isCompleted) {
            $this->isCompleted = 1;
        }
    }
}
