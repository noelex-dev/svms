<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "school_year".
 *
 * @property int $id
 * @property int $year_start
 * @property int $year_end
 * @property int $semester_id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Semester $semester
 */
class SchoolYear extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'school_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_start', 'year_end', 'semester_id', 'name', 'created_at', 'updated_at'], 'required'],
            [['year_start', 'year_end', 'semester_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::class, 'targetAttribute' => ['semester_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_start' => 'Year Start',
            'year_end' => 'Year End',
            'semester_id' => 'Semester ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semester::class, ['id' => 'semester_id']);
    }

}
