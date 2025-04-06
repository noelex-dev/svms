<?php

namespace frontend\views\record\controllers;

use common\models\ActiveSchoolYearSem;
use common\models\GradeLevel;
use common\models\PersonalInformation;
use common\models\StudentData;
use common\models\searches\StudentDataSearch;
use common\models\Section;
use common\models\Strand;
use common\models\StudentGuardian;
use common\models\StudentInformation;
use common\models\StudentPlan;
use common\models\TeacherAdvisoryAssignment;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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
        $studentData = new StudentData();
        $studentPersonalInfo = new PersonalInformation();
        $studentInfo = new StudentInformation();
        $studentPlan = new StudentPlan();
        $studentGuardian = new StudentGuardian();
        $guardianPersonalInfo = new PersonalInformation();

        $studentData->school_year_id = ActiveSchoolYearSem::getActiveSchoolYearId();

        $teacherId = Yii::$app->user->id;

        $assignment = TeacherAdvisoryAssignment::find()
            ->where(['user_id' => $teacherId])
            ->andWhere(['school_year_id' => $studentData->school_year_id])
            ->one();

        if ($assignment) {
            $studentData->adviser_id = $assignment->user_id;
            $studentData->grade_level_id = $assignment->grade_level_id;
            $studentData->strand_id = $assignment->strand_id;
            $studentData->section_id = $assignment->section_id;
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (
                    $studentData->load($post) &&
                    $studentPersonalInfo->load($post, 'StudentPersonalInformation') &&
                    $studentInfo->load($post) &&
                    $studentPlan->load($post) &&
                    $studentGuardian->load($post) &&
                    $guardianPersonalInfo->load($post, 'GuardianPersonalInformation')
                ) {
                    $studentPersonalInfo->save(false);
                    $studentInfo->save(false);
                    $studentPlan->save(false);
                    $guardianPersonalInfo->save(false);

                    $studentGuardian->personal_information_id = $guardianPersonalInfo->id;
                    $studentGuardian->save(false);

                    $studentData->personal_information_id = $studentPersonalInfo->id;
                    $studentData->student_information_id = $studentInfo->id;
                    $studentData->student_plan_id = $studentPlan->id;
                    $studentData->guardian_id = $studentGuardian->id;

                    $studentData->save(false);

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Student was Added successfully.');
                    return $this->redirect(['view', 'id' => $studentData->id]);
                }
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();
                if (strpos($e->getMessage(), 'UNIQUE constraint failed: student_data.lrn') !== false) {
                    Yii::$app->session->setFlash('error', 'LRN already exists. Please enter a unique LRN.');
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save Student. Please check the form for errors.');
                }
                Yii::error('Transaction failed: ' . $e->getMessage());
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Failed to save Student. Please check the form for errors.');
                Yii::error('Transaction failed: ' . $e->getMessage());
            }
        }

        return $this->renderAjax('_form', [
            'studentDataModel' => $studentData,
            'studentPersonalInformationModel' => $studentPersonalInfo,
            'studentInformationModel' => $studentInfo,
            'studentPlanModel' => $studentPlan,
            'studentGuardianModel' => $studentGuardian,
            'guardianPersonalInformationModel' => $guardianPersonalInfo,
        ]);
    }

    public function actionUpdate($id)
    {
        $studentDataModel = $this->findModel($id);

        $studentPersonalInformationModel = PersonalInformation::findOne($studentDataModel->personal_information_id);
        $studentInformationModel = StudentInformation::findOne($studentDataModel->student_information_id);
        $studentPlanModel = StudentPlan::findOne($studentDataModel->student_plan_id);
        $studentGuardianModel = StudentGuardian::findOne($studentDataModel->guardian_id);
        $guardianPersonalInformationModel = PersonalInformation::findOne($studentGuardianModel->personal_information_id);

        $post = Yii::$app->request->post();

        if (
            $studentDataModel->load($post) &&
            $studentPersonalInformationModel->load($post, 'StudentPersonalInformation') &&
            $studentInformationModel->load($post) &&
            $studentPlanModel->load($post) &&
            $studentGuardianModel->load($post) &&
            $guardianPersonalInformationModel->load($post, 'GuardianPersonalInformation')
        ) {
            $isValid = $studentDataModel->validate();
            $isValid = $studentPersonalInformationModel->validate() && $isValid;
            $isValid = $studentInformationModel->validate() && $isValid;
            $isValid = $studentPlanModel->validate() && $isValid;
            $isValid = $studentGuardianModel->validate() && $isValid;
            $isValid = $guardianPersonalInformationModel->validate() && $isValid;

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($isValid) {
                    $studentPersonalInformationModel->save(false);
                    $studentInformationModel->save(false);
                    $studentPlanModel->save(false);
                    $guardianPersonalInformationModel->save(false);

                    $studentGuardianModel->personal_information_id = $guardianPersonalInformationModel->id;
                    $studentGuardianModel->save(false);

                    $studentDataModel->personal_information_id = $studentPersonalInformationModel->id;
                    $studentDataModel->student_information_id = $studentInformationModel->id;
                    $studentDataModel->student_plan_id = $studentPlanModel->id;
                    $studentDataModel->guardian_id = $studentGuardianModel->id;

                    $studentDataModel->save(false);

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Student was updated successfully.');
                    return $this->redirect(['view', 'id' => $studentDataModel->id]);
                }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Failed to update Student. Please check the form for errors.');
                $transaction->rollBack();
                Yii::error('Transaction failed: ' . $e->getMessage());
            }
        }

        return $this->renderAjax('update', [
            'studentDataModel' => $studentDataModel,
            'studentPersonalInformationModel' => $studentPersonalInformationModel,
            'studentInformationModel' => $studentInformationModel,
            'studentPlanModel' => $studentPlanModel,
            'studentGuardianModel' => $studentGuardianModel,
            'guardianPersonalInformationModel' => $guardianPersonalInformationModel,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model !== null) {
            try {
                if ($model->delete()) {
                    Yii::$app->session->setFlash('success', 'Student Violation deleted successfully.');
                } else {
                    Yii::$app->session->setFlash('warning', 'Student Violation could not be deleted.');
                }
            } catch (\yii\db\IntegrityException $e) {
                Yii::$app->session->setFlash('error', "Can't delete this Student Violation. It is being used in other records.");
            }
        } else {
            Yii::$app->session->setFlash('info', "The requested School Year does not exist.");
        }

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
