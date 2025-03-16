<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ActiveSchoolYearSem $model */

$this->title = 'Update Active School Year Sem: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Active School Year Sems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-school-year-sem-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>