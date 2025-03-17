<?php

namespace frontend\views\record\controllers;

use common\models\StudentViolation;
use common\models\searches\StudentViolationSearch;
use common\models\StudentData;
use common\models\Violation;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use kartik\depdrop\DepDrop;
use yii\web\Response;
use lavrentiev\widgets\toastr\Notification;

class StudentViolationController extends Controller
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
        $searchModel = new StudentViolationSearch();
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
        $model = new StudentViolation();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Student Violation was added successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save Student Violation. Please check the form for errors.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Student Violation was updated successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to update Student Violation. Please check the form for errors.');
                }
            }
        }

        return $this->renderAjax('update', [
            'model' => $model,
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
        if (($model = StudentViolation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetViolationsByType()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $output = [];

        if (isset($_POST['depdrop_parents']) && !empty($_POST['depdrop_parents'])) {
            $typeId = $_POST['depdrop_parents'][0];
            $violations = Violation::find()->where(['violation_type_id' => $typeId])->asArray()->all();

            foreach ($violations as $violation) {
                $output[] = ['id' => $violation['id'], 'name' => $violation['name']];
            }

            return ['output' => $output, 'selected' => ''];
        }

        return ['output' => '', 'selected' => ''];
    }


    public function actionGetStudentList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];

        if (isset($_POST['depdrop_parents'])) {
            Yii::error($_POST['depdrop_parents'], 'debug');

            $parents = $_POST['depdrop_parents'];
            if ($parents !== null) {
                $schoolYear = $parents[0] ?? null;
                $grade = !empty($parents[1]) ? $parents[1] : null;
                $strand = !empty($parents[2]) ? $parents[2] : null;
                $section = !empty($parents[3]) ? $parents[3] : null;

                if ($schoolYear === null) {
                    return ['output' => [], 'selected' => ''];
                }

                $query = StudentData::find()->where(['school_year_id' => $schoolYear]);

                if ($grade !== null) {
                    $query->andWhere(['grade_level_id' => $grade]);
                }
                if ($strand !== null) {
                    $query->andWhere(['strand_id' => $strand]);
                }
                if ($section !== null) {
                    $query->andWhere(['section_id' => $section]);
                }

                Yii::error($query->createCommand()->getRawSql(), 'debug');

                $students = $query->all();

                foreach ($students as $student) {
                    Yii::error($student->id . ' - ' . ($student->personalInformation ? $student->personalInformation->fullName : 'No Personal Info'), 'debug');

                    if ($student->personalInformation) {
                        $out[] = [
                            'id' => $student->id,
                            'name' => $student->personalInformation->fullName
                        ];
                    }
                }

                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
}
