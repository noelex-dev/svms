<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class StudentData extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'student_data';
    }

    public function rules()
    {
        return [
            [['guardian_id'], 'default', 'value' => null],
            [['personal_information_id', 'student_information_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id', 'school_year_id', 'lrn'], 'required'],
            [['lrn'], 'unique'],
            [['personal_information_id', 'student_information_id', 'guardian_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id', 'school_year_id', 'created_at', 'updated_at'], 'integer'],
            [['grade_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => GradeLevel::class, 'targetAttribute' => ['grade_level_id' => 'id']],
            [['guardian_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentGuardian::class, 'targetAttribute' => ['guardian_id' => 'id']],
            [['personal_information_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalInformation::class, 'targetAttribute' => ['personal_information_id' => 'id']],
            [['school_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolYear::class, 'targetAttribute' => ['school_year_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['section_id' => 'id']],
            [['strand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Strand::class, 'targetAttribute' => ['strand_id' => 'id']],
            [['student_information_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentInformation::class, 'targetAttribute' => ['student_information_id' => 'id']],
            [['student_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentPlan::class, 'targetAttribute' => ['student_plan_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lrn' => 'Learner Reference Number (LRN)',
            'personal_information_id' => 'Personal Information ID',
            'student_information_id' => 'Student Information ID',
            'guardian_id' => 'Guardian ID',
            'student_plan_id' => 'Student Plan ID',
            'grade_level_id' => 'Grade Level',
            'section_id' => 'Section',
            'strand_id' => 'Strand',
            'school_year_id' => 'School Year',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::class, ['id' => 'grade_level_id']);
    }

    public function getGuardian()
    {
        return $this->hasOne(StudentGuardian::class, ['id' => 'guardian_id']);
    }

    public function getPersonalInformation()
    {
        return $this->hasOne(PersonalInformation::class, ['id' => 'personal_information_id']);
    }

    public function getSchoolYear()
    {
        return $this->hasOne(SchoolYear::class, ['id' => 'school_year_id']);
    }

    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    public function getStrand()
    {
        return $this->hasOne(Strand::class, ['id' => 'strand_id']);
    }

    public function getStudentInformation()
    {
        return $this->hasOne(StudentInformation::class, ['id' => 'student_information_id']);
    }

    public function getStudentPlan()
    {
        return $this->hasOne(StudentPlan::class, ['id' => 'student_plan_id']);
    }

    public function getStudentViolations()
    {
        return $this->hasMany(StudentViolation::class, ['student_data_id' => 'id']);
    }

    public function getStudentClass()
    {
        $grade = $this->getGradeLevel()->one();
        $strand = $this->getStrand()->one();
        $section = $this->getSection()->one();

        $gradeName = $grade ? $grade->name : 'N/A';
        $strandName = $strand ? $strand->name : 'N/A';
        $sectionName = $section ? $section->name : 'N/A';

        return $gradeName . ' - ' . $strandName . ' - ' . $sectionName;
    }
}
