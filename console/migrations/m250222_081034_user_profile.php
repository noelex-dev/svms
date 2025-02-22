<?php

use yii\db\Migration;

class m250222_081034_user_profile extends Migration
{
    private $table = '{{%user_profile}}';
    private $userRefereceTable = '{{%user}}';
    private $personalInfoRefereceTable = '{{%personal_information}}';

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
                'personal_information_id' => $this->integer()->notNull(),
                'role' => $this->string()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_user_profile-user_id_fk',
            $this->table,
            ['user_id'],
            $this->userRefereceTable,
            ['id'],
            'NO ACTION',
            'CASCADE'
        );

        $this->addForeignKey(
            'svms_user_profile-personal_information_id_fk',
            $this->table,
            ['personal_information_id'],
            $this->personalInfoRefereceTable,
            ['id'],
            'NO ACTION',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_user_profile-user_id_fk', $this->table);
        $this->dropForeignKey('svms_user_profile-personal_information_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
