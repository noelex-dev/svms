<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class StudentViolation extends \yii\db\ActiveRecord
{
    public $schoolYear;
    public $grade;
    public $strand;
    public $section;

    public static function tableName()
    {
        return 'student_violation';
    }

    public function rules()
    {
        return [
            [['schoolYear', 'grade', 'strand', 'section'], 'safe'],
            [['notification_status'], 'default', 'value' => 0],
            [['student_data_id', 'violation_id', 'user_id', 'is_settled'], 'required'],
            [['student_data_id', 'violation_id', 'notification_status', 'user_id', 'is_settled', 'created_at', 'updated_at'], 'integer'],
            [['student_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentData::class, 'targetAttribute' => ['student_data_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'student_data_id' => 'Student Name',
            'violation_id' => 'Violation',
            'notification_status' => 'Guardian Notified',
            'user_id' => 'User ID',
            'is_settled' => 'Is Settled',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',

            'schoolYear' => 'School Year',
            'grade' => 'Grade',
            'strand' => 'Strand',
            'section' => 'Section',
        ];
    }

    public function getStudentData()
    {
        return $this->hasOne(StudentData::class, ['id' => 'student_data_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
