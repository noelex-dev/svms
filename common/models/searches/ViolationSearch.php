<?php

namespace common\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Violation;
use common\models\ViolationType;

class ViolationSearch extends Violation
{
    public $violationTypeName;

    public function rules()
    {
        return [
            [['id', 'violation_type_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'violationTypeName'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $formName = null)
    {
        $query = Violation::find()->joinWith('violationType');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'violation_type_id' => $this->violation_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', Violation::tableName() . '.name', $this->name]);
        $query->andFilterWhere(['like', ViolationType::tableName() . '.name', $this->violationTypeName]);

        return $dataProvider;
    }

    public function getViolation()
    {
        return $this->hasOne(Violation::class, ['id' => 'violation_id']);
    }

    public function getViolationType()
    {
        return $this->hasOne(ViolationType::class, ['id' => 'violation_type_id']);
    }
}
