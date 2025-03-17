<?php

namespace frontend\views\cms\controllers;

use common\models\ActiveSchoolYearSem;
use common\models\searches\ActiveSchoolYearSemSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ActiveSchoolYearSemController extends Controller
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
        $searchModel = new ActiveSchoolYearSemSearch();
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

    public function actionActivate($id)
    {
        $model = ActiveSchoolYearSem::findOne($id);

        if ($model) {
            ActiveSchoolYearSem::updateAll(['is_active' => 0]);

            $model->is_active = 1;

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Successfully activated the ' . $model->schoolYear->name . ' - ' . $model->semester->name);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to activate. Please try again.');
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Record not found.');
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }


    // public function actionCreate()
    // {
    //     $model = new ActiveSchoolYearSem();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post())) {
    //             if ($model->save()) {
    //                 Yii::$app->session->setFlash('success', 'School-Year & Semester was added successfully.');
    //                 return $this->redirect(['view', 'id' => $model->id]);
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Failed to save School-Year & Semester. Please check the form for errors.');
    //             }
    //         } else {
    //             Yii::$app->session->setFlash('warning', 'Invalid data received. Please try again.');
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->renderAjax('create', [
    //         'model' => $model,
    //     ]);
    // }

    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post())) {
    //             if ($model->save()) {
    //                 Yii::$app->session->setFlash('success', 'School-Year & Semester was updated successfully.');
    //                 return $this->redirect(['view', 'id' => $model->id]);
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Failed to update School-Year & Semester. Please check the form for errors.');
    //             }
    //         } else {
    //             Yii::$app->session->setFlash('warning', 'Invalid data received. Please try again.');
    //         }
    //     }

    //     return $this->renderAjax('update', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model !== null) {
            try {
                if ($model->delete()) {
                    Yii::$app->session->setFlash('success', 'School-Year & Semester deleted successfully.');
                } else {
                    Yii::$app->session->setFlash('warning', 'School-Year & Semester could not be deleted.');
                }
            } catch (\yii\db\IntegrityException $e) {
                Yii::$app->session->setFlash('error', "Can't delete this School-Year & Semester. It is being used in other records.");
            }
        } else {
            Yii::$app->session->setFlash('info', "The requested School Year does not exist.");
        }

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = ActiveSchoolYearSem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
