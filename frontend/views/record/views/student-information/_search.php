<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="student-information-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'height') ?>

    <?= $form->field($model, 'weight') ?>

    <?= $form->field($model, 'early_disease') ?>

    <?php // echo $form->field($model, 'serious_accident') 
    ?>

    <?php // echo $form->field($model, 'hobby') 
    ?>

    <?php // echo $form->field($model, 'special_talent') 
    ?>

    <?php // echo $form->field($model, 'easy_subject') 
    ?>

    <?php // echo $form->field($model, 'hard_subject') 
    ?>

    <?php // echo $form->field($model, '4ps_status') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <?php // echo $form->field($model, 'updated_at') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>