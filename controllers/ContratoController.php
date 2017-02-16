<?php

namespace app\controllers;

use app\models\Cliente;
use Yii;
use app\models\Contrato;
use app\models\ContratoSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use mPDF;
use FPDF;

class ContratoController extends Controller
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
        $searchModel = new ContratoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionContrato($id)
    {
        return $this->render('contrato', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionImportar()
    {
        $model = new Contrato();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'archivo');

            $filename = 'Data.' . $file->extension;
            $upload = $file->saveAs('uploads/' . $filename);

            if ($upload) {
                define('CSV_PATH', 'uploads/');
                $csv_file = CSV_PATH . $filename;
                $filecsv = file($csv_file);
                print_r($filecsv);
                foreach ($filecsv as $data) {
                    $modelnew = new Cliente();
                    $hasil = explode(",", $data);
                    $nim = $hasil[1];
                    $nim2 = $hasil[0];
                    $modelnew->Codigo_Cliente = $nim;
                    $modelnew->Nombre = $nim2;
                    $modelnew->save();
                }
                unlink('uploads/' . $filename);
                return $this->redirect(['cliente/index']);
            }
        } else {
            return $this->render('importar', ['model' => $model]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Contrato::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
