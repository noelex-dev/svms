<?php

use yii\db\Migration;

class m250222_064117_strand extends Migration
{
    private $table = '{{%strand}}';

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
                'name' => $this->string()->notNull()->unique(),
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
