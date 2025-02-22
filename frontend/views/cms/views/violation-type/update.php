<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ViolationType $model */

$this->title = 'Update Violation Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Violation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="violation-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
