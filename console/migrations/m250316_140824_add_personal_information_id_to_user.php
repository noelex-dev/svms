<?php

use yii\db\Migration;

class m250316_140824_add_personal_information_id_to_user extends Migration
{
    private $table = '{{%user}}';

    public function up()
    {
        $this->addColumn($this->table, 'personal_information_id', $this->integer()->notNull());

        $this->addForeignKey(
            'fk_user_personal_information',
            $this->table,
            'personal_information_id',
            '{{%personal_information}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_personal_information', $this->table);

        $this->dropColumn($this->table, 'personal_information_id');
    }
}
