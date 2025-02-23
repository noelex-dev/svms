<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grade_level".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StudentDatum[] $studentData
 * @property TeacherAdvisoryAssignment[] $teacherAdvisoryAssignments
 */
class GradeLevel extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grade_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[StudentData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['grade_level_id' => 'id']);
    }

    /**
     * Gets query for [[TeacherAdvisoryAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherAdvisoryAssignments()
    {
        return $this->hasMany(TeacherAdvisoryAssignment::class, ['grade_level_id' => 'id']);
    }
}
