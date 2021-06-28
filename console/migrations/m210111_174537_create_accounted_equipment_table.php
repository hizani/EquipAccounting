<?php

use yii\db\Migration;

/**
 * Handles the creation of table `accounted_equipment`.
 */
class m210111_174537_create_accounted_equipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('accounted_equipment', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'equipment_type_id' => $this->integer()->notNull(),
            'equipment_attributes' => $this->string(500)->notNull(),
            'is_in_stock'=>$this->boolean()->notNull(),
            'classroom_id'=>$this->integer()->null()
        ]);

        $this->createIndex(
            'idx-accounted_equipment-equipment_type_id',
            'accounted_equipment',
            'equipment_type_id'
        );

        $this->addForeignKey(
            'fk-accounted_equipment-equipment_type_id',
            'accounted_equipment',
            'equipment_type_id',
            'equipment_type',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-accounted_equipment-classroom_id',
            'accounted_equipment',
            'classroom_id'
        );

        $this->addForeignKey(
            'fk-accounted_equipment-classroom_id',
            'accounted_equipment',
            'classroom_id',
            'classroom',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-accounted_equipment-equipment_type_id',
            'accounted_equipment'
        );

        $this->dropIndex(
            'idx-accounted_equipment-equipment_type_id',
            'accounted_equipment'
        );

        $this->dropForeignKey(
            'fk-accounted_equipment-classroom_id',
            'accounted_equipment'
        );

        $this->dropIndex(
            'idx-accounted_equipment-classroom_id',
            'accounted_equipment'
        );

        $this->dropTable('accounted_equipment');
    }
}
