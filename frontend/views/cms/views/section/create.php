<?php

use yii\helpers\Html;


$this->title = 'Add Section';
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>