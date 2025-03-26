<?php

namespace common\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentViolation;

class StudentViolationSearch extends StudentViolation
{
    public function rules()
    {
        return [
            [['id', 'student_data_id', 'violation_id', 'notification_status', 'user_id', 'is_settled', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $formName = null)
    {
        $query = StudentViolation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'student_data_id' => $this->student_data_id,
            'violation_id' => $this->violation_id,
            'notification_status' => $this->notification_status,
            'user_id' => $this->user_id,
            'is_settled' => $this->is_settled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
