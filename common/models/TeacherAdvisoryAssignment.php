<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class TeacherAdvisoryAssignment extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'teacher_advisory_assignment';
    }


    public function rules()
    {
        return [
            [['user_id', 'school_year_id', 'grade_level_id', 'section_id', 'strand_id'], 'required'],
            [['user_id', 'school_year_id', 'grade_level_id', 'section_id', 'strand_id', 'created_at', 'updated_at'], 'integer'],
            [['school_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolYear::class, 'targetAttribute' => ['school_year_id' => 'id']],
            [['grade_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => GradeLevel::class, 'targetAttribute' => ['grade_level_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['section_id' => 'id']],
            [['strand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Strand::class, 'targetAttribute' => ['strand_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User',
            'school_year_id' => 'School Year',
            'grade_level_id' => 'Grade Level',
            'section_id' => 'Section',
            'strand_id' => 'Strand',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getSchoolYear()
    {
        return $this->hasOne(SchoolYear::class, ['id' => 'school_year_id']);
    }

    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::class, ['id' => 'grade_level_id']);
    }

    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    public function getStrand()
    {
        return $this->hasOne(Strand::class, ['id' => 'strand_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getAssignedGradeLevels($userId)
    {
        $ids = static::find()
            ->select('grade_level_id')
            ->where(['user_id' => $userId])
            ->distinct()
            ->column();

        return GradeLevel::find()->where(['id' => $ids])->select(['name', 'id'])->indexBy('id')->column();
    }

    public static function getAssignedStrands($userId)
    {
        $ids = static::find()
            ->select('strand_id')
            ->where(['user_id' => $userId])
            ->distinct()
            ->column();

        return Strand::find()->where(['id' => $ids])->select(['name', 'id'])->indexBy('id')->column();
    }

    public static function getAssignedSections($userId)
    {
        $ids = static::find()
            ->select('section_id')
            ->where(['user_id' => $userId])
            ->distinct()
            ->column();

        return Section::find()->where(['id' => $ids])->select(['name', 'id'])->indexBy('id')->column();
    }
}
