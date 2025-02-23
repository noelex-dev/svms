<?php

namespace common\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentData;

/**
 * StudentDataSearch represents the model behind the search form of `common\models\StudentData`.
 */
class StudentDataSearch extends StudentData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'personal_information_id', 'student_information_id', 'guardian_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = StudentData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
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

        return $dataProvider;
    }
}
