<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Strand $model */

$this->title = 'Create Strand';
$this->params['breadcrumbs'][] = ['label' => 'Strands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
