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
            [['is_settled'], 'default', 'value' => 0],
            [['student_data_id', 'school_year_id', 'violation_id', 'notification_status', 'user_id', 'is_settled', 'created_at', 'updated_at'], 'integer'],
            [['lrn_id'], 'string', 'max' => 255],
            [['lrn_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentData::class, 'targetAttribute' => ['lrn_id' => 'lrn']],
            [['school_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolYear::class, 'targetAttribute' => ['school_year_id' => 'id']],
            [['student_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentData::class, 'targetAttribute' => ['student_data_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['violation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Violation::class, 'targetAttribute' => ['violation_id' => 'id']],
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

    public function getViolation()
    {
        return $this->hasOne(Violation::class, ['id' => 'violation_id']);
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
