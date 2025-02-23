<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_guardian".
 *
 * @property int $id
 * @property int $personal_information_id
 * @property int $relationship_id
 * @property string|null $contact_number
 * @property string|null $occupation
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PersonalInformation $personalInformation
 * @property Relationship $relationship
 * @property StudentDatum[] $studentData
 */
class StudentGuardian extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_guardian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_number', 'occupation'], 'default', 'value' => null],
            [['personal_information_id', 'relationship_id', 'created_at', 'updated_at'], 'required'],
            [['personal_information_id', 'relationship_id', 'created_at', 'updated_at'], 'integer'],
            [['contact_number', 'occupation'], 'string', 'max' => 255],
            [['personal_information_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalInformation::class, 'targetAttribute' => ['personal_information_id' => 'id']],
            [['relationship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Relationship::class, 'targetAttribute' => ['relationship_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Gets query for [[PersonalInformation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalInformation()
    {
        return $this->hasOne(PersonalInformation::class, ['id' => 'personal_information_id']);
    }

    /**
     * Gets query for [[Relationship]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelationship()
    {
        return $this->hasOne(Relationship::class, ['id' => 'relationship_id']);
    }

    /**
     * Gets query for [[StudentData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['guardian_id' => 'id']);
    }
}
