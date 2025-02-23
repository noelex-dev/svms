<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_information".
 *
 * @property int $id
 * @property string|null $language
 * @property float|null $height
 * @property float|null $weight
 * @property string|null $early_disease
 * @property string|null $serious_accident
 * @property string|null $hobby
 * @property string|null $special_talent
 * @property string|null $easy_subject
 * @property string|null $hard_subject
 * @property int $four_p_status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StudentDatum[] $studentData
 */
class StudentInformation extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language', 'height', 'weight', 'early_disease', 'serious_accident', 'hobby', 'special_talent', 'easy_subject', 'hard_subject'], 'default', 'value' => null],
            [['four_p_status'], 'default', 'value' => 0],
            [['height', 'weight'], 'number'],
            [['early_disease', 'serious_accident'], 'string'],
            [['four_p_status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['language', 'hobby', 'special_talent', 'easy_subject', 'hard_subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Gets query for [[StudentData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentData()
    {
        return $this->hasMany(StudentData::class, ['student_information_id' => 'id']);
    }
}
