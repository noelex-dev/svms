<?php

use common\models\User;
use yii\db\Migration;

class m250326_022941_create_admin_user extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $adminRole = $auth->getRole('Administrator');
        if (!$adminRole) {
            $adminRole = $auth->createRole('Administrator');
            $adminRole->description = 'Full access administrator';
            $auth->add($adminRole);
        }

        $principalRole = $auth->getRole('Principal');
        if (!$principalRole) {
            $principalRole = $auth->createRole('Principal');
            $principalRole->description = 'School Principal';
            $auth->add($principalRole);
        }

        $guidanceRole = $auth->getRole('Guidance');
        if (!$guidanceRole) {
            $guidanceRole = $auth->createRole('Guidance');
            $guidanceRole->description = 'Guidance Counselor';
            $auth->add($guidanceRole);
        }

        $teacherRole = $auth->getRole('Teacher');
        if (!$teacherRole) {
            $teacherRole = $auth->createRole('Teacher');
            $teacherRole->description = 'Class Adviser';
            $auth->add($teacherRole);
        }

        $passwordHash = Yii::$app->security->generatePasswordHash('password123');
        $authKey = Yii::$app->security->generateRandomString();
        $time = time();

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password_hash' => $passwordHash,
            'auth_key' => $authKey,
            'status' => 10,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        $userId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%user}}')
            ->where(['username' => 'admin'])
            ->scalar();

        if ($userId) {
            $auth->assign($adminRole, $userId);
        } else {
            echo "Error: Admin user creation failed.\n";
            return false;
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $userId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%user}}')
            ->where(['username' => 'admin'])
            ->scalar();

        if ($userId) {
            $auth->revokeAll($userId);
        }

        $this->delete('{{%user}}', ['username' => 'admin']);

        $adminRole = $auth->getRole('Administrator');
        if ($adminRole) {
            $auth->remove($adminRole);
        }

        $principalRole = $auth->getRole('Principal');
        if ($principalRole) {
            $auth->remove($principalRole);
        }

        $guidanceRole = $auth->getRole('Guidance');
        if ($guidanceRole) {
            $auth->remove($guidanceRole);
        }

        $teacherRole = $auth->getRole('Teacher');
        if ($teacherRole) {
            $auth->remove($teacherRole);
        }
    }
}
