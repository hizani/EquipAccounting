<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccountedEquipment;

/**
 * AccountedEquipmentSearch represents the model behind the search form of `common\models\AccountedEquipment`.
 */
class AccountedEquipmentSearch extends AccountedEquipment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'equipment_type_id', 'classroom_id'], 'integer'],
            [['name', 'equipment_attributes', 'is_in_stock'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AccountedEquipment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'equipment_type_id' => $this->equipment_type_id,
            'classroom_id' => $this->classroom_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'equipment_attributes', $this->equipment_attributes])
            ->andFilterWhere(['like', 'is_in_stock', $this->is_in_stock]);

        return $dataProvider;
    }
}
