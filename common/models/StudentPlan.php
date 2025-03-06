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
            [['college'], 'default', 'value' => 0],
            [['elementary', 'secondary', 'college', 'created_at', 'updated_at'], 'integer'],
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
            'elementary' => 'Elementary',
            'secondary' => 'Secondary',
            'college' => 'College',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['student_plan_id' => 'id']);
    }
}
