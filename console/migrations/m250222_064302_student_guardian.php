<?php

use yii\db\Migration;

class m250222_064302_student_guardian extends Migration
{
    private $table = '{{%student_guardian}}';
    private $personalInformationRefereceTable = '{{%personal_information}}';
    private $relationshipRefereceTable = '{{%relationship}}';

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
                'personal_information_id' => $this->integer()->notNull(),
                'relationship_id' => $this->integer()->notNull(),
                'contact_number' => $this->string(),
                'occupation' => $this->string(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'svms_student_guardian-personal_information_id_fk',
            $this->table,
            ['personal_information_id'],
            $this->personalInformationRefereceTable,
            ['id'],
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'svms_student_guardian-relationship_id_fk',
            $this->table,
            ['relationship_id'],
            $this->relationshipRefereceTable,
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('svms_student_guardian-personal_information_id_fk', $this->table);
        $this->dropForeignKey('svms_student_guardian-relationship_id_fk', $this->table);
        $this->dropTable($this->table);
    }
}
