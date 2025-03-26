<?php

use yii\db\Migration;

class m250326_023100_insert_auth_assignment extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%auth_assignment}}', ['item_name', 'user_id', 'created_at'], [
            ['Administrator', '1', time()],
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%auth_assignment}}', ['item_name' => 'Administrator', 'user_id' => '1']);
    }
}
