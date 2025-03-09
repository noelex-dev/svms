<?php

use yii\helpers\Html;

$this->title = 'Create Student Data';
$this->params['breadcrumbs'][] = ['label' => 'Student Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-data-create">

    <?= $this->render('_form', [
        'studentDataModel' => $studentDataModel,
        'personalInformationModel' => $personalInformationModel,
        'studentInformationModel' => $studentInformationModel,
        'studentPlanModel' => $studentPlanModel,
        'studentGuardianModel' => $studentGuardianModel,
        'guardianPersonalInformationModel' => $guardianPersonalInformationModel,
    ]) ?>

</div>