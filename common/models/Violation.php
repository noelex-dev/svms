<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Violation extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'violation';
    }

    public function rules()
    {
        return [
            [['name', 'violation_type_id'], 'required'],
            [['violation_type_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['violation_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViolationType::class, 'targetAttribute' => ['violation_type_id' => 'id']],
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
            'name' => 'Name',
            'violation_type_id' => 'Violation Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getViolationType()
    {
        return $this->hasOne(ViolationType::class, ['id' => 'violation_type_id']);
    }

    public static function getDropdownData(): array
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
