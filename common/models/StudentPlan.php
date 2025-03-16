<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class StudentPlan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'student_plan';
    }

    public function rules()
    {
        return [
            [['higher_education', 'employment', 'entrepreneurship', 'tesda'], 'default', 'value' => 0],
            [['higher_education', 'employment', 'entrepreneurship', 'tesda', 'created_at', 'updated_at'], 'integer']
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
            'higher_education' => 'Higher Education (College)',
            'employment' => 'Employment',
            'entrepreneurship' => 'Entrepreneurship',
            'tesda' => 'Midddle-Level Skills (TESDA)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['student_plan_id' => 'id']);
    }
}
