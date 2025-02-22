<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher_advisory_assignment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $grade_level_id
 * @property int $section_id
 * @property int $strand_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property GradeLevel $gradeLevel
 * @property Section $section
 * @property Strand $strand
 * @property User $user
 */
class TeacherAdvisoryAssignment extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher_advisory_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'integer'],
            [['grade_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => GradeLevel::class, 'targetAttribute' => ['grade_level_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['section_id' => 'id']],
            [['strand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Strand::class, 'targetAttribute' => ['strand_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
