<?php

use yii\db\Migration;

class m250326_023214_insert_auth_item_child_data extends Migration
{
    // public function safeUp()
    // {
    //     $auth = Yii::$app->authManager;

    //     $adminRole = $auth->getRole('Administrator');
    //     if (!$adminRole) {
    //         $adminRole = $auth->createRole('Administrator');
    //         $auth->add($adminRole);
    //     }

    //     $cmsRole = $auth->createRole('cms');
    //     $auth->add($cmsRole);

    //     $recordRole = $auth->createRole('record');
    //     $auth->add($recordRole);

    //     $this->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
    //         ['cms', '/cms/*'],
    //         ['record', '/record/*'],
    //     ]);
    // }

    // public function safeDown()
    // {
    //     $this->delete('{{%auth_item_child}}', ['parent' => 'cms', 'child' => '/cms/*']);
    //     $this->delete('{{%auth_item_child}}', ['parent' => 'record', 'child' => '/record/*']);
    // }
}
