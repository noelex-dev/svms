<?php

use yii\db\Migration;

class m250222_064321_student_violation extends Migration
{

    private $table = '{{%student_violation}}';
    private $studentDataRefereceTable = '{{%student_data}}';

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
                'violation_id' => $this->integer()->notNull(),
                'notification_status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_student_data-student_data_id_fk',
            $this->table,
            ['student_data_id'],
            $this->studentDataRefereceTable,
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_student_data-student_data_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
