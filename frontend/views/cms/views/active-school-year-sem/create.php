<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ActiveSchoolYearSem $model */

$this->title = 'Create Active School Year Sem';
$this->params['breadcrumbs'][] = ['label' => 'Active School Year Sems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-school-year-sem-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>