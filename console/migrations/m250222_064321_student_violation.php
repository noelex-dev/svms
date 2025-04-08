<?php

use yii\db\Migration;

class m250222_064321_student_violation extends Migration
{

    private $table = '{{%student_violation}}';
    private $studentDataRefereceTable = '{{%student_data}}';
    private $userReferenceTable = '{{%user}}';
    private $schoolYearReferenceTabe = '{{%school_year}}';
    private $violationReferenceTable = '{{%violation}}';

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
                'student_data_id' => $this->integer()->notNull(),
                'lrn_id' => $this->string()->notNull(),
                'school_year_id' => $this->integer()->notNull(),
                'violation_id' => $this->integer()->notNull(),
                'notification_status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0),
                'user_id' => $this->integer()->defaultValue(null),
                'is_settled' => $this->integer()->notNull()->defaultValue(0),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_student_violation-student_data_id_fk',
            $this->table,
            ['student_data_id'],
            $this->studentDataRefereceTable,
            ['id'],
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'svms_student_violation-lrn_id_fk',
            $this->table,
            ['lrn_id'],
            $this->studentDataRefereceTable,
            ['lrn'],
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'svms_student_violation-school_year_id_fk',
            $this->table,
            ['school_year_id'],
            $this->schoolYearReferenceTabe,
            ['id'],
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'svms_student_violation-violation_id_fk',
            $this->table,
            ['violation_id'],
            $this->violationReferenceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'svms_student_violation-user_id_fk',
            $this->table,
            ['user_id'],
            $this->userReferenceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION',
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_student_violation-student_data_id_fk', $this->table);
        $this->dropForeignKey('svms_student_violation-lrn_id_fk', $this->table);
        $this->dropForeignKey('svms_student_violation-school_year_id_fk', $this->table);
        $this->dropForeignKey('svms_student_violation-violation_id_fk', $this->table);
        $this->dropForeignKey('svms_student_violation-user_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
