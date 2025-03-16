<?php

use yii\db\Migration;

class m250222_064308_student_data extends Migration
{
    private $table = '{{%student_data}}';
    private $personalInfoRefereceTable = '{{%personal_information}}';
    private $studentInfoRefereceTable = '{{%student_information}}';
    private $studentGuardianRefereceTable = '{{%student_guardian}}';
    private $studentPlanRefereceTable = '{{%student_plan}}';
    private $gradeLevelRefereceTable = '{{%grade_level}}';
    private $sectionRefereceTable = '{{%section}}';
    private $strandRefereceTable = '{{%strand}}';
    private $schoolyearRefereceTable = '{{%school_year}}';

    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            $this->table,
            [
                'id' => $this->primaryKey(),
                'personal_information_id' => $this->integer()->notNull(),
                'student_information_id' => $this->integer()->notNull(),
                'guardian_id' => $this->integer(),
                'student_plan_id' => $this->integer()->notNull(),
                'grade_level_id' => $this->integer()->notNull(),
                'section_id' => $this->integer()->notNull(),
                'strand_id' => $this->integer()->notNull(),
                'school_year_id' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_student_data-personal_information_id_fk',
            $this->table,
            ['personal_information_id'],
            $this->personalInfoRefereceTable,
            ['id'],
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'svms_student_data-student_information_id_fk',
            $this->table,
            ['student_information_id'],
            $this->studentInfoRefereceTable,
            ['id'],
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'svms_student_data-guardian_id_fk',
            $this->table,
            ['guardian_id'],
            $this->studentGuardianRefereceTable,
            ['id'],
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'svms_student_data-student_plan_id_fk',
            $this->table,
            ['student_plan_id'],
            $this->studentPlanRefereceTable,
            ['id'],
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'svms_student_data-grade_level_id_fk',
            $this->table,
            ['grade_level_id'],
            $this->gradeLevelRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'svms_student_data-section_id_fk',
            $this->table,
            ['section_id'],
            $this->sectionRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'svms_student_data-strand_id_fk',
            $this->table,
            ['strand_id'],
            $this->strandRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'svms_student_data-school_year_id_fk',
            $this->table,
            ['school_year_id'],
            $this->schoolyearRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_student_data-personal_information_id_fk', $this->table);
        $this->dropForeignKey('svms_student_data-student_information_id_fk', $this->table);
        $this->dropForeignKey('svms_student_data-guardian_id_fk', $this->table);
        $this->dropForeignKey('svms_student_data-student_plan_id_fk', $this->table);
        $this->dropForeignKey('svms_student_data-grade_level_id_fk', $this->table);
        $this->dropForeignKey('svms_student_data-section_id_fk', $this->table);
        $this->dropForeignKey('svms_student_data-strand_id_fk', $this->table);
        $this->dropForeignKey('svms_student_data-school_year_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
