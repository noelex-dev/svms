<?php

namespace common\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentData;
use common\models\PersonalInformation;
use common\models\GradeLevel;
use common\models\Section;
use common\models\Strand;
use common\models\StudentGuardian;

class StudentDataSearch extends StudentData
{
    public $studentName;
    public $guardianName;
    public $gradeLevelName;
    public $sectionName;
    public $strandName;

    public function rules()
    {
        return [
            [['studentName', 'guardianName', 'gradeLevelName', 'sectionName', 'strandName'], 'safe'],
            [['id', 'personal_information_id', 'student_information_id', 'guardian_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $formName = null)
    {
        $query = StudentData::find()
            ->joinWith('personalInformation')
            ->joinWith(['guardian' => function ($query) {
                $query->joinWith(['personalInformation' => function ($query) {
                    $query->alias('student_guardian_personal_information');
                }]);
            }])
            ->joinWith('gradeLevel')
            ->joinWith('section')
            ->joinWith('strand');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

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

        $query->andFilterWhere([
            'like',
            'CONCAT(personal_information.first_name, " ", COALESCE(personal_information.middle_name, ""), " ", personal_information.last_name, " ", COALESCE(personal_information.ext_name, ""))',
            $this->studentName
        ]);

        $query->andFilterWhere([
            'like',
            'CONCAT(student_guardian_personal_information.first_name, " ", COALESCE(student_guardian_personal_information.middle_name, ""), " ", student_guardian_personal_information.last_name, " ", COALESCE(student_guardian_personal_information.ext_name, ""))',
            $this->guardianName
        ]);

        $query->andFilterWhere(['like', GradeLevel::tableName() . '.name', $this->gradeLevelName]);
        $query->andFilterWhere(['like', Section::tableName() . '.name', $this->sectionName]);
        $query->andFilterWhere(['like', Strand::tableName() . '.name', $this->strandName]);

        return $dataProvider;
    }

    public function getPersonalInformation()
    {
        return $this->hasOne(PersonalInformation::class, ['id' => 'personal_information_id']);
    }

    public function getGuardian()
    {
        return $this->hasOne(StudentGuardian::class, ['id' => 'guardian_id']);
    }

    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::class, ['id' => 'grade_level_id']);
    }

    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    public function getStrand()
    {
        return $this->hasOne(Strand::class, ['id' => 'strand_id']);
    }
}
