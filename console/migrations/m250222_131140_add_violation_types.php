<?php

use yii\db\Migration;

class m250222_131140_add_violation_types extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%violation_type}}', ['name', 'created_at', 'updated_at'], [
            ['Minor Offenses', time(), time()],
            ['Major Offenses', time(), time()],
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%violation_type}}', ['name' => ['Minor Offenses', 'Major Offenses']]);
    }
}
