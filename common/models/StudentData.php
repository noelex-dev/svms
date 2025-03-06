<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

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
            [['personal_information_id', 'student_information_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id'], 'required'],
            [['personal_information_id', 'student_information_id', 'guardian_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'integer'],
            [['grade_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => GradeLevel::class, 'targetAttribute' => ['grade_level_id' => 'id']],
            [['guardian_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentGuardian::class, 'targetAttribute' => ['guardian_id' => 'id']],
            [['personal_information_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalInformation::class, 'targetAttribute' => ['personal_information_id' => 'id']],
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
            'personal_information_id' => 'Personal Information ID',
            'student_information_id' => 'Student Information ID',
            'guardian_id' => 'Guardian ID',
            'student_plan_id' => 'Student Plan ID',
            'grade_level_id' => 'Grade Level ID',
            'section_id' => 'Section ID',
            'strand_id' => 'Strand ID',
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
}
