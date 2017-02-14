<?php

namespace app\controllers;

use app\models\Pasaporte;
use Yii;
use app\models\Venta;
use app\models\VentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\db\Query;

class VentaController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $model = new Venta();

        if ($model->load(Yii::$app->request->post())) {
            $model->Codigo_venta = $model->getCodigo();
            $model->Estado = '1';

            var_dump(
                $model->Codigo_Cliente,
                $model->medio_pago,
                $model->Estado_pago,
                $model->porcentaje_pagado,
                $model->Codigo_pasaporte);
            exit();
            $model->save();
            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionReporte()
    {
        $model = new Venta();

        if ($model->load(Yii::$app->request->post())) {

            return $this->redirect(['cliente/update', 'id' => $model->Codigo_Cliente]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Codigo_venta]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Venta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
