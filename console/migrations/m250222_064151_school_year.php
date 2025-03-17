<?php

use yii\db\Migration;

class m250222_064151_school_year extends Migration
{
    private $table = '{{%school_year}}';

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
                'year_start' => $this->date()->notNull(),
                'year_end' => $this->date()->notNull(),
                'name' => $this->string()->notNull(),
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
