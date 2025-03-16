<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
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
            'is_active' => 'Is Active',
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

    public static function getAvailableSchoolYears(): array
    {
        $usedSchoolYearIds = self::find()
            ->select('school_year_id')
            ->column();

        $availableSchoolYears = SchoolYear::find()
            ->where(['NOT IN', 'id', $usedSchoolYearIds])
            ->all();

        return $availableSchoolYears;
    }

    public static function getActiveSchoolYear()
    {
        return self::findOne(['is_active' => 1])->schoolYear->id;
    }

    public static function getDropdownData(): array
    {
        $availableSchoolYears = self::getAvailableSchoolYears();
        return $availableSchoolYears ? ArrayHelper::map($availableSchoolYears, 'id', 'name') : [];
    }
}
