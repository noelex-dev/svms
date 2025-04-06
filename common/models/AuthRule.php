<?php

namespace common\models;

use Yii;

class AuthRule extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'auth_rule';
    }

    public function rules()
    {
        return [
            [['data', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::class, ['rule_name' => 'name']);
    }
}
