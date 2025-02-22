<?php

use yii\db\Migration;

class m250222_081728_teacher_advisory_assignment extends Migration
{
    private $table = '{{%teacher_advisory_assignment}}';
    private $userRefereceTable = '{{%user}}';
    private $gradeLevelRefereceTable = '{{%grade_level}}';
    private $sectionRefereceTable = '{{%section}}';
    private $strandRefereceTable = '{{%strand}}';

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
                'user_id' => $this->integer()->notNull(),
                'grade_level_id' => $this->integer()->notNull(),
                'section_id' => $this->integer()->notNull(),
                'strand_id' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_teacher_advisory_assignment-user_id_fk',
            $this->table,
            ['user_id'],
            $this->userRefereceTable,
            ['id'],
            'NO ACTION',
            'CASCADE'
        );

        $this->addForeignKey(
            'svms_teacher_advisory_assignment-grade_level_id_fk',
            $this->table,
            ['grade_level_id'],
            $this->gradeLevelRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'svms_teacher_advisory_assignment-section_id_fk',
            $this->table,
            ['section_id'],
            $this->sectionRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'svms_teacher_advisory_assignment-strand_id_fk',
            $this->table,
            ['strand_id'],
            $this->strandRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_teacher_advisory_assignment-user_id_fk', $this->table);
        $this->dropForeignKey('svms_teacher_advisory_assignment-grade_level_id_fk', $this->table);
        $this->dropForeignKey('svms_teacher_advisory_assignment-section_id_fk', $this->table);
        $this->dropForeignKey('svms_teacher_advisory_assignment-strand_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
