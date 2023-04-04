<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "listElement".
 *
 * @property int $listElementId
 * @property string|null $description
 * @property int|null $isCompleted
 * @property int|null $createdAt
 * @property int|null $updatedAt
 */
class BaseListElement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listElement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['isCompleted', 'createdAt', 'updatedAt'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'listElementId' => 'List Element ID',
            'description' => 'Description',
            'isCompleted' => 'Is Completed',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
