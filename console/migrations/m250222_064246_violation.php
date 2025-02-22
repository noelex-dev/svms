<?php

use yii\db\Migration;

class m250222_064246_violation extends Migration
{

    private $table = '{{%violation}}';
    private $violationTypeRefereceTable = '{{%violation_type}}';

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
                'name' => $this->string()->notNull(),
                'violation_type_id' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),

            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_violation-violation_type_id_fk',
            $this->table,
            ['violation_type_id'],
            $this->violationTypeRefereceTable,
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_violation-violation_type_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
