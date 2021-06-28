<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipment_type".
 *
 * @property int $id
 * @property string $name
 * @property string $equipment_template
 *
 * @property AccountedEquipment[] $accountedEquipments
 */
class EquipmentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'equipment_template'], 'required'],
            [['equipment_template'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'equipment_template' => 'Список характеристик',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountedEquipments()
    {
        return $this->hasMany(AccountedEquipment::className(), ['equipment_type_id' => 'id']);
    }
}
