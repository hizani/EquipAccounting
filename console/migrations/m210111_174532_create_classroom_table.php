<?php

use yii\db\Migration;

/**
 * Handles the creation of table `classroom`.
 */
class m210111_174532_create_classroom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('classroom', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('classroom');
    }
}
