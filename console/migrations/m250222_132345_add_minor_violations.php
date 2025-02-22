<?php

use yii\db\Migration;

class m250222_132345_add_minor_violations extends Migration
{
    public function safeUp()
    {
        $minorOffensesTypeId = \common\models\ViolationType::find()->select('id')->where(['name' => 'Minor Offenses'])->scalar();

        if ($minorOffensesTypeId === null) {
            throw new \Exception("Violation type 'Minor Offenses' not found.  Run the migration that adds violation types first.");
        }

        $violations = [
            ['Littering', $minorOffensesTypeId],
            ['Staying in places other than the officially designated places during flag ceremony and other assemblies.', $minorOffensesTypeId],
            ['Improper behaviour during flag ceremony and other assemblies.', $minorOffensesTypeId],
            ['Wearing excessive make up, nail polish, dyed hair, unbecoming hairstyle, etc.', $minorOffensesTypeId],
            ['Tardiness', $minorOffensesTypeId],
            ['Failure to bring excuse letter from absence.', $minorOffensesTypeId],
            ['Petty quarrels with classmates', $minorOffensesTypeId],
            ["Leaving the classroom without the teacher\'s permission.", $minorOffensesTypeId],
            ['Playing harmful practical jokes.', $minorOffensesTypeId],
            ['Use of mobile phones and electronic devices during classes (the teacher has the right to confiscate them when used during his/her class. Only the parent/guardian can claim them.', $minorOffensesTypeId],
            ['Cutting Classes', $minorOffensesTypeId],
            ['Loitering in any part of the school vicinity during class hours.', $minorOffensesTypeId],
            ['Disrespect and misbehaviour.', $minorOffensesTypeId],
            ['Wearing of inappropriate dress code (e.g., tattered jeans, croptop, skirt above the knee, sleeveless, shorts)', $minorOffensesTypeId],
            ['Using of cigarettes and vape inside the school premises', $minorOffensesTypeId],
        ];

        $time = time();

        $dataToInsert = [];
        foreach ($violations as $violation) {
            $dataToInsert[] = [$violation[0], $minorOffensesTypeId, $time, $time];
        }

        $this->batchInsert('{{%violation}}', ['name', 'violation_type_id', 'created_at', 'updated_at'], $dataToInsert);
    }

    public function safeDown()
    {
        $minorOffensesTypeId = \common\models\ViolationType::find()->select('id')->where(['name' => 'Minor Offenses'])->scalar();

        if ($minorOffensesTypeId !== null) {
            $this->delete('{{%violation}}', ['violation_type_id' => $minorOffensesTypeId]);
        }
    }
}
