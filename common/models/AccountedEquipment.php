<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accounted_equipment".
 *
 * @property int $id
 * @property string $name
 * @property int $equipment_type_id
 * @property string $equipment_attributes
 * @property int $is_in_stock
 * @property int $classroom_id
 *
 * @property Classroom $classroom
 * @property EquipmentType $equipmentType
 */
class AccountedEquipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounted_equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'equipment_type_id', 'equipment_attributes', 'is_in_stock'], 'required'],
            [['equipment_type_id', 'classroom_id'], 'integer'],
            [['equipment_attributes'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['is_in_stock'], 'string', 'max' => 1],
            [['classroom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classroom::className(), 'targetAttribute' => ['classroom_id' => 'id']],
            [['equipment_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipmentType::className(), 'targetAttribute' => ['equipment_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'equipment_type_id' => 'Тип оборудования',
            'equipment_attributes' => 'Атрибуты оборудования',
            'is_in_stock' => 'На складе',
            'classroom_id' => 'Аудитория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassroom()
    {
        return $this->hasOne(Classroom::className(), ['id' => 'classroom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipmentType()
    {
        return $this->hasOne(EquipmentType::className(), ['id' => 'equipment_type_id']);
    }
}
