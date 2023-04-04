<?php

use yii\db\Migration;

/**
 * Handles the creation of table `listElement`.
 */
class m230404_074227_create_listElement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('listElement', [
            'listElementId' => $this->primaryKey(),
            'description' => $this->text(),
            'isCompleted' => $this->boolean(),
            'createdAt' => $this->bigInteger(),
            'updatedAt' => $this->bigInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('listElement');
    }
}
