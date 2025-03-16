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
            [['student_data_id', 'violation_id'], 'required'],
            [['student_data_id', 'violation_id', 'notification_status', 'created_at', 'updated_at'], 'integer'],
            [['student_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentData::class, 'targetAttribute' => ['student_data_id' => 'id']],
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
            'student_data_id' => 'Student Data ID',
            'violation_id' => 'Violation ID',
            'notification_status' => 'Guardian Notification Status',
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
}
