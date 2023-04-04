<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "listElement".
 *
 * @property int $listElementId
 * @property string|null $description
 * @property int|null $isCompleted
 * @property int|null $createAt
 * @property int|null $updateAt
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
            [['isCompleted', 'createAt', 'updateAt'], 'integer'],
            [['description'], 'string', 'max' => 255],
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
            'createAt' => 'Create At',
            'updateAt' => 'Update At',
        ];
    }
}
