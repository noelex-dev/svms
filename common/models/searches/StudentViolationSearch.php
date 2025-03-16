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
            [['id', 'student_data_id', 'violation_id', 'notification_status', 'created_at', 'updated_at'], 'integer'],
            [['schoolYear', 'grade', 'strand', 'section'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $formName = null)
    {
        $query = StudentViolation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if ($this->schoolYear) {
            $query->joinWith('studentData')->andWhere(['student_data.school_year_id' => $this->schoolYear]);
        }

        if ($this->grade) {
            $query->joinWith('studentData')->andWhere(['student_data.grade_level_id' => $this->grade]);
        }

        if ($this->strand) {
            $query->joinWith('studentData')->andWhere(['student_data.strand_id' => $this->strand]);
        }

        if ($this->section) {
            $query->joinWith('studentData')->andWhere(['student_data.section_id' => $this->section]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'student_data_id' => $this->student_data_id,
            'violation_id' => $this->violation_id,
            'notification_status' => $this->notification_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
