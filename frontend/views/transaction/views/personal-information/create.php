<?php

use yii\helpers\Html;


$this->title = 'Create Personal Information';
$this->params['breadcrumbs'][] = ['label' => 'Personal Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-information-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>