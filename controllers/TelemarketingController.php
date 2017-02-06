<?php

namespace app\controllers;

use Yii;
use app\models\Telemarketing;
use app\models\TelemarketingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class TelemarketingController extends Controller
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
        $searchModel = new TelemarketingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTelemarketing()
    {
        $model = new Telemarketing();

        if ($model->load(Yii::$app->request->post())) {

            $fechaIni = substr($model->Fecha_Creado, 6, 4) . '/' . substr($model->Fecha_Creado, 3, 2) . '/' . substr($model->Fecha_Creado, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->Fecha_Modificado, 6, 4) . '/' . substr($model->Fecha_Modificado, 3, 2) . '/' . substr($model->Fecha_Modificado, 0, 2); //'2016-06-09' ;

            return $this->render('reporte', ['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }


    protected function findModel($id)
    {
        if (($model = Telemarketing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
