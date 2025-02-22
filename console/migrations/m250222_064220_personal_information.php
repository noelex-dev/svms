<?php

use yii\db\Migration;

class m250222_064220_personal_information extends Migration
{

    private $table = '{{%personal_information}}';

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
                'first_name' => $this->string()->notNull(),
                'middle_name' => $this->string(),
                'last_name' => $this->string()->notNull(),
                'ext_name' => $this->string(),
                'birthdate' => $this->date(),
                'birthplace' => $this->string(),
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
