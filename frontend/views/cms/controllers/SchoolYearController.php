<?php

namespace frontend\views\cms\controllers;

use common\models\SchoolYear;
use common\models\searches\SchoolYearSearch;
use DateTime;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SchoolYearController extends Controller
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
        $searchModel = new SchoolYearSearch();
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
        $model = new SchoolYear();

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->date_range)) {
                $dates = explode(' - ', $model->date_range);

                $startDate = DateTime::createFromFormat('Y-m-d', $dates[0]);
                $endDate = DateTime::createFromFormat('Y-m-d', $dates[1]);

                if ($startDate && $endDate) {
                    $model->year_start = $startDate->format('Y-m-d');
                    $model->year_end = $endDate->format('Y-m-d');

                    $startYear = $startDate->format('Y');
                    $endYear = $endDate->format('Y');
                    $model->name = $startYear . '-' . $endYear;
                }
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->date_range)) {
                $dates = explode(' - ', $model->date_range);

                $startDate = DateTime::createFromFormat('Y-m-d', $dates[0]);
                $endDate = DateTime::createFromFormat('Y-m-d', $dates[1]);

                if ($startDate && $endDate) {
                    $model->year_start = $startDate->format('Y-m-d');
                    $model->year_end = $endDate->format('Y-m-d');

                    $startYear = $startDate->format('Y');
                    $endYear = $endDate->format('Y');
                    $model->name = $startYear . ' - ' . $endYear;
                }
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        $startDate = DateTime::createFromFormat('Y-m-d', $model->year_start);
        $endDate = DateTime::createFromFormat('Y-m-d', $model->year_end);

        if ($startDate && $endDate) {
            $model->date_range = $startDate->format('m/d/Y') . ' - ' . $endDate->format('m/d/Y');
        }

        return $this->renderAjax('update', [
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
        if (($model = SchoolYear::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
