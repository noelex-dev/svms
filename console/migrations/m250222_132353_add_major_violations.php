<?php

use yii\db\Migration;

class m250222_132353_add_major_violations extends Migration
{
    public function safeUp()
    {
        $majorOffensesTypeId = \common\models\ViolationType::find()->select('id')->where(['name' => 'Major Offenses'])->scalar();

        if ($majorOffensesTypeId === null) {
            throw new \Exception("Violation type 'Major Offenses' not found. Run the migration that adds violation types first.");
        }

        $violations = [
            ['Fighting, physical abuse of any person or conduct which threatens and/or endangers the health and safety of any person.', $majorOffensesTypeId],
            ['Direct assault upon a person or a member of the faculty, administration or non-teaching staff of any person vested with authority or any student.', $majorOffensesTypeId],
            ['Lying or giving false testimony during school investigation.', $majorOffensesTypeId],
            ['Slander/Utterance of offensive words that tend to cause dishonor or discredit or contempt in the name of the school (e.g. misbehavior in the public places, shoplifting, etc)', $majorOffensesTypeId],
            ['Stealing the school property and that of others.', $majorOffensesTypeId],
            ['Defacing the school places and other acts of vandalism.', $majorOffensesTypeId],
            ['Tampering, alteration or misuse of academic or official records (report cards, form 137, clearances, excuse letter, etc.)', $majorOffensesTypeId],
            ['Forgery of signature of a person in authority or parent in an official communication.', $majorOffensesTypeId],
            ['Loitering in public places during class hours.', $majorOffensesTypeId],
            ["Using somebody else\'s ID card.", $majorOffensesTypeId],
            ['Exhibition and display of any obscene of pornographic magazine, pictures or videos within the school campus.', $majorOffensesTypeId],
            ['Gambling in any form in campus.', $majorOffensesTypeId],
            ['Encouraging others to violate school policies.', $majorOffensesTypeId],
            ['Gross misconduct, repeated disregard of school policies and regulations (major and minor)', $majorOffensesTypeId],
            ['Cheating/violating rules during an examination. A learner caught cheating during an examination will get zero in the said test.', $majorOffensesTypeId],
        ];

        $time = time();

        $dataToInsert = [];
        foreach ($violations as $violation) {
            $dataToInsert[] = [$violation[0], $majorOffensesTypeId, $time, $time];
        }

        $this->batchInsert('{{%violation}}', ['name', 'violation_type_id', 'created_at', 'updated_at'], $dataToInsert);
    }

    public function safeDown()
    {
        $majorOffensesTypeId = \common\models\ViolationType::find()->select('id')->where(['name' => 'Major Offenses'])->scalar();

        if ($majorOffensesTypeId !== null) {
            $this->delete('{{%violation}}', ['violation_type_id' => $majorOffensesTypeId]);
        }
    }
}
