<?php

namespace app\models\db;

class ListElement extends BaseListElement
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['isCompleted', 'createAt', 'updateAt'], 'integer'],
            [['description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'listElementId' => 'List Element ID',
            'description' => 'Description',
            'isCompleted' => 'Is Completed',
            'createAt' => 'Create At',
            'updateAt' => 'Update At',
        ];
    }
}
