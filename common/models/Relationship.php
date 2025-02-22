<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "relationship".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StudentGuardian[] $studentGuardians
 */
class Relationship extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relationship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[StudentGuardians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGuardians()
    {
        return $this->hasMany(StudentGuardian::class, ['relationship_id' => 'id']);
    }

}
