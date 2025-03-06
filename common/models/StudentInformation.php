<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class StudentInformation extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'student_information';
    }


    public function rules()
    {
        return [
            [['language', 'height', 'weight', 'early_disease', 'serious_accident', 'hobby', 'special_talent', 'easy_subject', 'hard_subject'], 'default', 'value' => null],
            [['four_p_status'], 'default', 'value' => 0],
            [['height', 'weight'], 'number'],
            [['early_disease', 'serious_accident'], 'string'],
            [['four_p_status', 'created_at', 'updated_at'], 'integer'],
            [['language', 'hobby', 'special_talent', 'easy_subject', 'hard_subject'], 'string', 'max' => 255],
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
            'language' => 'Language',
            'height' => 'Height',
            'weight' => 'Weight',
            'early_disease' => 'Early Disease',
            'serious_accident' => 'Serious Accident',
            'hobby' => 'Hobby',
            'special_talent' => 'Special Talent',
            'easy_subject' => 'Easy Subject',
            'hard_subject' => 'Hard Subject',
            'four_p_status' => '4ps Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['student_information_id' => 'id']);
    }
}
