<?php

use yii\db\Migration;

class m250222_064151_school_year extends Migration
{
    private $table = '{{%school_year}}';
    private $semesterRefereceTable = '{{%semester}}';

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
                'year_start' => $this->integer()->notNull(),
                'year_end' => $this->integer()->notNull(),
                'semester_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );


        $this->addForeignKey(
            'svms_school_year-semester_id_fk',
            $this->table,
            ['semester_id'],
            $this->semesterRefereceTable,
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_school_year-semester_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
