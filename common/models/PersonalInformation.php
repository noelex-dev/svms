<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class PersonalInformation extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'personal_information';
    }

    public function rules()
    {
        return [
            [['middle_name', 'ext_name', 'birthdate', 'birthplace'], 'default', 'value' => null],
            [['first_name', 'last_name'], 'required'],
            [['birthdate'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'ext_name', 'birthplace'], 'string', 'max' => 255],
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
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'ext_name' => 'Ext Name',
            'birthdate' => 'Birthdate',
            'birthplace' => 'Birthplace',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['personal_information_id' => 'id']);
    }

    public function getStudentGuardians()
    {
        return $this->hasMany(StudentGuardian::class, ['personal_information_id' => 'id']);
    }

    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::class, ['personal_information_id' => 'id']);
    }

    public function getFullName()
    {
        $firstName = $this->first_name;
        $middleName = '';

        if ($this->middle_name) {
            $middleName = strlen($this->middle_name) === 1 ? ' ' . $this->middle_name . '.' : ' ' . $this->middle_name;
        }

        $lastName = ' ' . $this->last_name;
        $extName = $this->ext_name ? ', ' . $this->ext_name : '';

        return $firstName . $middleName . $lastName . $extName;
    }
}
