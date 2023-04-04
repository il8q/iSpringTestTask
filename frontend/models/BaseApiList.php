<?php

namespace frontend\models;

use common\models\db\ListElement;
use Yii;
use yii\base\Model;

/**
 * Сериализует чек лист
 */
class BaseApiList extends Model
{
    public $offset;
    public $limit;

    public function rules(): array
    {
        return [
          [['offset', 'limit'], 'integer'],
          ['offset', 'default', 'value' => 0],
          ['limit', 'default', 'value' => 10],
        ];
    }
}
