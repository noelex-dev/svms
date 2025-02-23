<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PersonalInformation $model */

$this->title = 'Create Personal Information';
$this->params['breadcrumbs'][] = ['label' => 'Personal Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
