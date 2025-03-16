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
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents']) && !empty($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $schoolYear = $parents[0] ?? null;
            $grade = $parents[1] ?? null;
            $strand = $parents[2] ?? null;
            $section = $parents[3] ?? null;

            Yii::info("Filter Parameters: schoolYear=$schoolYear, grade=$grade, strand=$strand, section=$section", 'app');

            $query = StudentData::find()->with('personalInformation');

            if ($grade !== null) {
                $query->andWhere(['grade_level_id' => $grade]);
            }

            if ($strand !== null) {
                $query->andWhere(['strand_id' => $strand]);
            }

            if ($section !== null) {
                $query->andWhere(['section_id' => $section]);
            }

            if ($schoolYear !== null) {
                $query->andWhere(['school_year_id' => $schoolYear]);
            }

            Yii::info("SQL Query: " . $query->createCommand()->rawSql, 'app');

            $students = $query->all();

            Yii::info("Student Count: " . count($students), 'app');
            Yii::info("Students data: " . print_r($students, true), 'app');

            $output = [];
            foreach ($students as $student) {
                $name = $student->personalInformation ? $student->personalInformation->getFullName() : 'Personal information not available';
                $output[] = ['id' => $student->id, 'name' => $name];
            }

            Yii::info("Output: " . print_r($output, true), 'app');

            return ['output' => $output, 'selected' => ''];
        }

        return ['output' => [], 'selected' => ''];
    }
}
