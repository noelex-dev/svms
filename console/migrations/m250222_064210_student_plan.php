<?php

use yii\db\Migration;

class m250222_064210_student_plan extends Migration
{
    private $table = '{{%student_plan}}';

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
                'elementary' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0),
                'secondary' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0),
                'college' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
