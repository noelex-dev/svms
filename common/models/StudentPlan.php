<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_plan".
 *
 * @property int $id
 * @property int $elementary
 * @property int $secondary
 * @property int $college
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StudentDatum[] $studentData
 */
class StudentPlan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['college'], 'default', 'value' => 0],
            [['elementary', 'secondary', 'college', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'elementary' => 'Elementary',
            'secondary' => 'Secondary',
            'college' => 'College',
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
        return $this->hasMany(StudentData::class, ['student_plan_id' => 'id']);
    }
}
