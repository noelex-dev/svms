<?php

use common\models\User;
use yii\db\Migration;

class m250326_022941_create_admin_user extends Migration
{
    public function safeUp()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@example.com';
        $user->setPassword('password123');
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        $user->created_at = time();
        $user->updated_at = time();

        if (!$user->save()) {
            echo "Error creating admin user:\n";
            print_r($user->errors);
            return false;
        }
    }

    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'admin']);
    }
}
