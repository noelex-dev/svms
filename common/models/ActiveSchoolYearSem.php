<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ActiveSchoolYearSem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'active_schoolyear_sem';
    }

    public function rules()
    {
        return [
            [['school_year_id', 'semester_id', 'is_active'], 'required'],
            [['school_year_id', 'semester_id', 'is_active', 'created_at', 'updated_at'], 'integer'],
            [['school_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolYear::class, 'targetAttribute' => ['school_year_id' => 'id']],
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
            'school_year_id' => 'School Year',
            'semester_id' => 'Semester',
            'is_active' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getSchoolYear()
    {
        return $this->hasOne(SchoolYear::class, ['id' => 'school_year_id']);
    }

    public function getSemester()
    {
        return $this->hasOne(Semester::class, ['id' => 'semester_id']);
    }

    public static function getActiveSchoolYearId()
    {
        $active = self::find()->where(['is_active' => 1])->one();
        return $active ? $active->school_year_id : null;
    }

    public static function getActiveSchoolYearDropdown()
    {
        $active = self::find()
            ->with(['schoolYear', 'semester'])
            ->where(['is_active' => 1])
            ->all();

        return ArrayHelper::map($active, 'school_year_id', function ($model) {
            return $model->schoolYear->name . ' - ' . $model->semester->name;
        });
    }
}
