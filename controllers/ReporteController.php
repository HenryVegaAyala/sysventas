<?php

namespace app\controllers;

use Yii;
use app\models\Reporte;
use app\models\ReporteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ReporteController extends Controller
{

    public function actionCreate()
    {
        $model = new Reporte;

        if ($model->load(Yii::$app->request->post())) {

            $model->id = mt_rand();
//            $fechaIni =  $model->fecha_inicio;
//            $fechaFin =  $model->fecha_final;

            $fechaIni = substr($model->fecha_inicio, 6, 4) . '/' . substr($model->fecha_inicio, 3, 2) . '/' . substr($model->fecha_inicio, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->fecha_final, 6, 4) . '/' . substr($model->fecha_final, 3, 2) . '/' . substr($model->fecha_final, 0, 2); //'2016-06-09' ;

            return $this->render('reporte', ['fechaIni' => $fechaIni,'fechaFin' => $fechaFin]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

}
