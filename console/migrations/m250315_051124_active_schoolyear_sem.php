<?php

use yii\db\Migration;

class m250315_051124_active_schoolyear_sem extends Migration
{
    private $table = '{{%active_schoolyear_sem}}';
    private $schoolyearRefereceTable = '{{%school_year}}';
    private $semesterRefereceTable = '{{%semester}}';

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
                'school_year_id' => $this->integer()->notNull(),
                'semester_id' => $this->integer()->notNull(),
                'is_active' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_active_schoolyear_sem-school_year_id_fk',
            $this->table,
            ['school_year_id'],
            $this->schoolyearRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'svms_active_schoolyear_sem-semester_id_fk',
            $this->table,
            ['semester_id'],
            $this->semesterRefereceTable,
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_active_schoolyear_sem-school_year_id_fk', $this->table);
        $this->dropForeignKey('svms_active_schoolyear_sem-semester_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
