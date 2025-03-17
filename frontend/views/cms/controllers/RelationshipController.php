<?php

namespace frontend\views\cms\controllers;

use common\models\Relationship;
use common\models\searches\RelationshipSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RelationshipController extends Controller
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
        $searchModel = new RelationshipSearch();
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
        $model = new Relationship();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Relationship was added successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save Relationship. Please check the form for errors.');
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
                    Yii::$app->session->setFlash('success', 'Relationship was updated successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to update Relationship. Please check the form for errors.');
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
                    Yii::$app->session->setFlash('success', 'Relationship deleted successfully.');
                } else {
                    Yii::$app->session->setFlash('warning', 'Relationship could not be deleted.');
                }
            } catch (\yii\db\IntegrityException $e) {
                Yii::$app->session->setFlash('error', "Can't delete this Relationship. It is being used in other records.");
            }
        } else {
            Yii::$app->session->setFlash('info', "The requested School Year does not exist.");
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Relationship::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
