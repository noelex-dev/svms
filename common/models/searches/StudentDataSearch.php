<?php

namespace common\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentData;

class StudentDataSearch extends StudentData
{
    public $fullName;

    public function rules()
    {
        return [
            [['fullName'], 'safe'],
            [['id', 'personal_information_id', 'student_information_id', 'guardian_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $formName = null)
    {
        $query = StudentData::find();

        $query->joinWith(['personalInformation']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'personal_information_id' => $this->personal_information_id,
            'student_information_id' => $this->student_information_id,
            'guardian_id' => $this->guardian_id,
            'student_plan_id' => $this->student_plan_id,
            'grade_level_id' => $this->grade_level_id,
            'section_id' => $this->section_id,
            'strand_id' => $this->strand_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'CONCAT(first_name, " ", last_name)', $this->fullName]);

        return $dataProvider;
    }

    public function getFullName()
    {
        return $this->personalInformation ? $this->personalInformation->getFullName() : null;
    }
}
