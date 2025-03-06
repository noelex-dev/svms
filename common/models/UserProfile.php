<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class UserProfile extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'user_profile';
    }

    public function rules()
    {
        return [
            [['user_id', 'personal_information_id', 'role'], 'required'],
            [['user_id', 'personal_information_id', 'created_at', 'updated_at'], 'integer'],
            [['role'], 'string', 'max' => 255],
            [['personal_information_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalInformation::class, 'targetAttribute' => ['personal_information_id' => 'id']],
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
            'user_id' => 'User ID',
            'personal_information_id' => 'Personal Information ID',
            'role' => 'Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getPersonalInformation()
    {
        return $this->hasOne(PersonalInformation::class, ['id' => 'personal_information_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
