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
class ListElement extends \common\models\db\BaseListElement
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return array_merge([
            [['description'], 'length' => 1000],
        ]);
    }
}
