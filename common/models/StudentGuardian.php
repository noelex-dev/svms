<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class StudentGuardian extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'student_guardian';
    }

    public function rules()
    {
        return [
            [['contact_number', 'occupation'], 'default', 'value' => null],
            [['personal_information_id', 'relationship_id'], 'required'],
            [['personal_information_id', 'relationship_id', 'created_at', 'updated_at'], 'integer'],
            [['contact_number', 'occupation'], 'string', 'max' => 255],
            [['personal_information_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalInformation::class, 'targetAttribute' => ['personal_information_id' => 'id']],
            [['relationship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Relationship::class, 'targetAttribute' => ['relationship_id' => 'id']],
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
            'personal_information_id' => 'Personal Information ID',
            'relationship_id' => 'Relationship ID',
            'contact_number' => 'Contact Number',
            'occupation' => 'Occupation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getPersonalInformation()
    {
        return $this->hasOne(PersonalInformation::class, ['id' => 'personal_information_id']);
    }


    public function getRelationship()
    {
        return $this->hasOne(Relationship::class, ['id' => 'relationship_id']);
    }


    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['guardian_id' => 'id']);
    }
}
