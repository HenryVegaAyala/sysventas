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
            $fechaIni = substr($model->fecha_inicio, 6, 4) . '/' . substr($model->fecha_inicio, 3, 2) . '/' . substr($model->fecha_inicio, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->fecha_final, 6, 4) . '/' . substr($model->fecha_final, 3, 2) . '/' . substr($model->fecha_final, 0, 2); //'2016-06-09' ;
            $estado = $model->estado;

            if (Yii::$app->user->identity->Codigo_Rol == 4) {
                return $this->render('cliente', ['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin]);
            } elseif (Yii::$app->user->identity->Codigo_Rol == 17) {
                return $this->render('telemarketing', ['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin, 'estado' => $estado]);
            } else {
                return $this->render('reporte', ['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirmador()
    {
        $model = new Reporte;

        if ($model->load(Yii::$app->request->post())) {

            $model->id = mt_rand();
            $fechaIni = substr($model->fecha_inicio, 6, 4) . '/' . substr($model->fecha_inicio, 3, 2) . '/' . substr($model->fecha_inicio, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->fecha_final, 6, 4) . '/' . substr($model->fecha_final, 3, 2) . '/' . substr($model->fecha_final, 0, 2); //'2016-06-09' ;

            return $this->render('reporconfirmador', ['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin]);

        } else {
            return $this->render('confirmador', [
                'model' => $model,
            ]);
        }
    }

    public function actionSupervisor()
    {
        $model = new Reporte;

        if ($model->load(Yii::$app->request->post())) {

            $model->id = mt_rand();
            $fechaIni = substr($model->fecha_inicio, 6, 4) . '/' . substr($model->fecha_inicio, 3, 2) . '/' . substr($model->fecha_inicio, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->fecha_final, 6, 4) . '/' . substr($model->fecha_final, 3, 2) . '/' . substr($model->fecha_final, 0, 2); //'2016-06-09' ;
            $estado = $model->estado;

            return $this->render('reportesupervisor', ['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin, 'estado' => $estado]);

        } else {
            return $this->render('supervisor', [
                'model' => $model,
            ]);
        }
    }


}
