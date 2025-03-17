<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class SchoolYear extends \yii\db\ActiveRecord
{
    public $date_range;

    public static function tableName()
    {
        return 'school_year';
    }

    public function rules()
    {
        return [
            [['year_start', 'year_end', 'name'], 'required'],
            [['year_start', 'year_end'], 'safe'],
            [['date_range'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getActiveSchoolyearSem()
    {
        return $this->hasOne(ActiveSchoolyearSem::class, ['school_year_id' => 'id']);
    }

    public static function getDropdownData(): array
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
