<?php

use yii\helpers\Html;


$this->title = 'Update Student Data: ' . $studentDataModel->personalInformation->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Student Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $studentDataModel->id, 'url' => ['view', 'id' => $studentDataModel->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-data-update">

    <?= $this->render('_form', [
        'studentDataModel' => $studentDataModel,
        'studentPersonalInformationModel' => $studentPersonalInformationModel,
        'studentInformationModel' => $studentInformationModel,
        'studentPlanModel' => $studentPlanModel,
        'studentGuardianModel' => $studentGuardianModel,
        'guardianPersonalInformationModel' => $guardianPersonalInformationModel,
    ]) ?>

</div>