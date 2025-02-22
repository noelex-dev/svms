<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "personal_information".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $ext_name
 * @property string|null $birthdate
 * @property string|null $birthplace
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StudentDatum[] $studentData
 * @property StudentGuardian[] $studentGuardians
 * @property UserProfile[] $userProfiles
 */
class PersonalInformation extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['middle_name', 'ext_name', 'birthdate', 'birthplace'], 'default', 'value' => null],
            [['first_name', 'last_name', 'created_at', 'updated_at'], 'required'],
            [['birthdate'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'ext_name', 'birthplace'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Gets query for [[StudentData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentData()
    {
        return $this->hasMany(StudentDatum::class, ['personal_information_id' => 'id']);
    }

    /**
     * Gets query for [[StudentGuardians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGuardians()
    {
        return $this->hasMany(StudentGuardian::class, ['personal_information_id' => 'id']);
    }

    /**
     * Gets query for [[UserProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::class, ['personal_information_id' => 'id']);
    }

}
