<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_data".
 *
 * @property int $id
 * @property int $personal_information_id
 * @property int $student_information_id
 * @property int|null $guardian_id
 * @property int $student_plan_id
 * @property int $grade_level_id
 * @property int $section_id
 * @property int $strand_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property GradeLevel $gradeLevel
 * @property StudentGuardian $guardian
 * @property PersonalInformation $personalInformation
 * @property Section $section
 * @property Strand $strand
 * @property StudentInformation $studentInformation
 * @property StudentPlan $studentPlan
 * @property StudentViolation[] $studentViolations
 */
class StudentData extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['guardian_id'], 'default', 'value' => null],
            [['personal_information_id', 'student_information_id', 'student_plan_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'required'],
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Gets query for [[GradeLevel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::class, ['id' => 'grade_level_id']);
    }

    /**
     * Gets query for [[Guardian]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuardian()
    {
        return $this->hasOne(StudentGuardian::class, ['id' => 'guardian_id']);
    }

    /**
     * Gets query for [[PersonalInformation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalInformation()
    {
        return $this->hasOne(PersonalInformation::class, ['id' => 'personal_information_id']);
    }

    /**
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    /**
     * Gets query for [[Strand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrand()
    {
        return $this->hasOne(Strand::class, ['id' => 'strand_id']);
    }

    /**
     * Gets query for [[StudentInformation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentInformation()
    {
        return $this->hasOne(StudentInformation::class, ['id' => 'student_information_id']);
    }

    /**
     * Gets query for [[StudentPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPlan()
    {
        return $this->hasOne(StudentPlan::class, ['id' => 'student_plan_id']);
    }

    /**
     * Gets query for [[StudentViolations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentViolations()
    {
        return $this->hasMany(StudentViolation::class, ['student_data_id' => 'id']);
    }

}
