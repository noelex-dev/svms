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
            [['schoolYear', 'grade', 'strand', 'section', 'user_id'], 'safe'],
            [['notification_status', 'is_settled'], 'default', 'value' => 0],
            [['student_data_id', 'violation_id', 'lrn_id', 'school_year_id'], 'required'],
            [['lrn_id'], 'string'],
            [['student_data_id', 'violation_id', 'notification_status', 'user_id', 'is_settled', 'school_year_id', 'created_at', 'updated_at'], 'integer'],
            [['student_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentData::class, 'targetAttribute' => ['student_data_id' => 'id']],
            [['lrn_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentData::class, 'targetAttribute' => ['lrn_id' => 'lrn']],
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
            'lrn_id' => 'LRN',
            'student_data_id' => 'Student Name',
            'violation_id' => 'Violation',
            'notification_status' => 'Guardian Notified',
            'user_id' => 'User ID',
            'is_settled' => 'Status',
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

    public function getStudentDataLrn()
    {
        return $this->hasOne(StudentData::class, ['lrn' => 'lrn_id']);
    }

    public function getSchoolYear()
    {
        return $this->hasOne(SchoolYear::class, ['id' => 'school_year_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
