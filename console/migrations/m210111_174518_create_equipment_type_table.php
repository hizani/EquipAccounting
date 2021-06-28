<?php

use yii\db\Migration;

/**
 * Handles the creation of table `equipment_type`.
 */
class m210111_174518_create_equipment_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('equipment_type', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'equipment_template' => $this->json()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('equipment_type');
    }
}
