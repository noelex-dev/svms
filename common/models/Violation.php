<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "violation".
 *
 * @property int $id
 * @property string $name
 * @property int $violation_type_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ViolationType $violationType
 */
class Violation extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'violation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'violation_type_id', 'created_at', 'updated_at'], 'required'],
            [['violation_type_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['violation_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViolationType::class, 'targetAttribute' => ['violation_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'violation_type_id' => 'Violation Type ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ViolationType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViolationType()
    {
        return $this->hasOne(ViolationType::class, ['id' => 'violation_type_id']);
    }

}
