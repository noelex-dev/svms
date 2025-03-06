<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class SchoolYear extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'school_year';
    }

    public function rules()
    {
        return [
            [['year_start', 'year_end', 'semester_id', 'name'], 'required'],
            [['year_start', 'year_end', 'semester_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::class, 'targetAttribute' => ['semester_id' => 'id']],
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
            'year_start' => 'Year Start',
            'year_end' => 'Year End',
            'semester_id' => 'Semester',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getSemester()
    {
        return $this->hasOne(Semester::class, ['id' => 'semester_id']);
    }
}
