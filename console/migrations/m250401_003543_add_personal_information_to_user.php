<?php

use yii\db\Migration;

class m250401_003543_add_personal_information_to_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'personal_information_id', $this->integer()->unique()->after('id'));

        $this->addForeignKey(
            'fk-user-personal_information_id',
            '{{%user}}',
            'personal_information_id',
            '{{%personal_information}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user-personal_information_id',
            '{{%user}}'
        );

        $this->dropColumn('{{%user}}', 'personal_information_id');
    }
}
