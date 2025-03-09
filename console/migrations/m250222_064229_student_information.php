<?php

use yii\db\Migration;

class m250222_064229_student_information extends Migration
{
    private $table = '{{%student_information}}';

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
                'language' => $this->string(),
                'height' => $this->decimal(5, 2),
                'weight' => $this->decimal(5, 2),
                'early_disease' => $this->text(),
                'serious_accident' => $this->text(),
                'hobby' => $this->string(),
                'special_talent' => $this->string(),
                'easy_subject' => $this->string(),
                'hard_subject' => $this->string(),
                'four_p_status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0),
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
