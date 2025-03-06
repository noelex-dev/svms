<?php

use yii\helpers\Html;

$this->title = 'Add Strand';
$this->params['breadcrumbs'][] = ['label' => 'Strands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>