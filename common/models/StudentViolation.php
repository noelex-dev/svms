<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_violation".
 *
 * @property int $id
 * @property int $student_data_id
 * @property int $violation_id
 * @property int $notification_status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StudentDatum $studentData
 */
class StudentViolation extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_violation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notification_status'], 'default', 'value' => 0],
            [['student_data_id', 'violation_id', 'created_at', 'updated_at'], 'required'],
            [['student_data_id', 'violation_id', 'notification_status', 'created_at', 'updated_at'], 'integer'],
            [['student_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentDatum::class, 'targetAttribute' => ['student_data_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_data_id' => 'Student Data ID',
            'violation_id' => 'Violation ID',
            'notification_status' => 'Notification Status',
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
        return $this->hasOne(StudentData::class, ['id' => 'student_data_id']);
    }
}
