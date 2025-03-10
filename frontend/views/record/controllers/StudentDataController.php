<?php

namespace frontend\views\record\controllers;

use common\models\PersonalInformation;
use common\models\StudentData;
use common\models\searches\StudentDataSearch;
use common\models\StudentGuardian;
use common\models\StudentInformation;
use common\models\StudentPlan;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

class StudentDataController extends Controller
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new StudentDataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $studentDataModel = new StudentData();
        $personalInformationModel = new PersonalInformation();
        $studentInformationModel = new StudentInformation();
        $studentPlanModel = new StudentPlan();
        $studentGuardianModel = new StudentGuardian();
        $guardianPersonalInformationModel = new PersonalInformation();

        if (
            $studentDataModel->load(Yii::$app->request->isPost()) &&
            $personalInformationModel->load($Yii::$app->request->isPost()) &&
            $studentInformationModel->load($Yii::$app->request->isPost()) &&
            $studentPlanModel->load($Yii::$app->request->isPost()) &&
            $studentGuardianModel->load($Yii::$app->request->isPost()) &&
            $guardianPersonalInformationModel->load($Yii::$app->request->isPost(), Html::getInputName($guardianPersonalInformationModel, 'first_name') . '_guardian')
        ) {
            $isValid = $studentDataModel->validate();
            $isValid = $personalInformationModel->validate() && $isValid;
            $isValid = $studentInformationModel->validate() && $isValid;
            $isValid = $studentPlanModel->validate() && $isValid;
            $isValid = $studentGuardianModel->validate() && $isValid;
            $isValid = $guardianPersonalInformationModel->validate() && $isValid;

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($isValid) {
                    $personalInformationModel->save(false);
                    $studentInformationModel->save(false);
                    $studentPlanModel->save(false);
                    $guardianPersonalInformationModel->save(false);

                    $studentGuardianModel->personal_information_id = $guardianPersonalInformationModel->id;
                    $studentGuardianModel->save(false);

                    $studentDataModel->personal_information_id = $personalInformationModel->id;
                    $studentDataModel->student_information_id = $studentInformationModel->id;
                    $studentDataModel->student_plan_id = $studentPlanModel->id;
                    $studentDataModel->guardian_id = $studentGuardianModel->id;

                    $studentDataModel->save(false);

                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $studentDataModel->id]);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error('Transaction failed: ' . $e->getMessage());
            }
        }


        return $this->renderAjax('create', [
            'studentDataModel' => $studentDataModel,
            'personalInformationModel' => $personalInformationModel,
            'studentInformationModel' => $studentInformationModel,
            'studentPlanModel' => $studentPlanModel,
            'studentGuardianModel' => $studentGuardianModel,
            'guardianPersonalInformationModel' => $guardianPersonalInformationModel,
        ]);
    }


    public function actionUpdate($id)
    {
        $studentDataModel = $this->findModel($id);

        $personalInformationModel = PersonalInformation::findOne($studentDataModel->personal_information_id);
        $studentInformationModel = StudentInformation::findOne($studentDataModel->student_information_id);
        $studentPlanModel = StudentPlan::findOne($studentDataModel->student_plan_id);
        $studentGuardianModel = StudentGuardian::findOne($studentDataModel->guardian_id);
        $guardianPersonalInformationModel = PersonalInformation::findOne($studentGuardianModel->personal_information_id);

        $post = Yii::$app->request->post();

        if (
            $studentDataModel->load($post) &&
            $personalInformationModel->load($post) &&
            $studentInformationModel->load($post) &&
            $studentPlanModel->load($post) &&
            $studentGuardianModel->load($post) &&
            $guardianPersonalInformationModel->load($post, Html::getInputName($guardianPersonalInformationModel, 'first_name') . '_guardian')
        ) {
            $isValid = $studentDataModel->validate();
            $isValid = $personalInformationModel->validate() && $isValid;
            $isValid = $studentInformationModel->validate() && $isValid;
            $isValid = $studentPlanModel->validate() && $isValid;
            $isValid = $studentGuardianModel->validate() && $isValid;
            $isValid = $guardianPersonalInformationModel->validate() && $isValid;

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($isValid) {
                    $personalInformationModel->save(false);
                    $studentInformationModel->save(false);
                    $studentPlanModel->save(false);
                    $guardianPersonalInformationModel->save(false);

                    $studentGuardianModel->personal_information_id = $guardianPersonalInformationModel->id;
                    $studentGuardianModel->save(false);

                    $studentDataModel->personal_information_id = $personalInformationModel->id;
                    $studentDataModel->student_information_id = $studentInformationModel->id;
                    $studentDataModel->student_plan_id = $studentPlanModel->id;
                    $studentDataModel->guardian_id = $studentGuardianModel->id;

                    $studentDataModel->save(false);

                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $studentDataModel->id]);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error('Transaction failed: ' . $e->getMessage());
                // Handle the error (e.g., display an error message to the user)
            }
        }

        return $this->renderAjax('update', [
            'studentDataModel' => $studentDataModel,
            'personalInformationModel' => $personalInformationModel,
            'studentInformationModel' => $studentInformationModel,
            'studentPlanModel' => $studentPlanModel,
            'studentGuardianModel' => $studentGuardianModel,
            'guardianPersonalInformationModel' => $guardianPersonalInformationModel,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = StudentData::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
