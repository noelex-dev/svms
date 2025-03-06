<?php

use yii\helpers\Html;


$this->title = 'Add Violation';
$this->params['breadcrumbs'][] = ['label' => 'Violations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>