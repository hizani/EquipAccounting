<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classroom".
 *
 * @property int $id
 * @property string $name
 *
 * @property AccountedEquipment[] $accountedEquipments
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'classroom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Аудитория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountedEquipments()
    {
        return $this->hasMany(AccountedEquipment::className(), ['classroom_id' => 'id']);
    }
}
