<?php

namespace app\controllers;

use Yii;
use app\models\Documento;
use app\models\DocumentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocumentoController implements the CRUD actions for Documento model.
 */
class DocumentoController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Documento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentoSearch();
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
        $model = new Documento();

        if ($model->load(Yii::$app->request->post())) {

            $model->Codigo_Documento = $model->getCodigoDocumento();
            $model->Fecha_Creado = $this->ZonaHoraria();
            $model->Estado = '1';
            $model->Usuario_Creado = Yii::$app->user->identity->email;

            $documento = UploadedFile::getInstance($model, 'archivo');

            $nombre = $model->Nombre;
            $recorridoTrue = strpos($nombre, ' ');
            $recorridoFalse = strlen($nombre);

            if ($recorridoTrue == '') {
                $recorrido = $recorridoFalse;
            } else {
                $recorrido = $recorridoTrue;
            }

            $ReNombre = substr($nombre, 0, $recorrido);
            $documentos = $this->getDocumento($documento->getExtension(), $ReNombre, $model->getCodigoDocumento());

            if ($documento->getExtension() == 'jpg' || $documento->getExtension() == 'png') {
                $documento->saveAs(Yii::getAlias('@groupgygImgPathImagen') . '/' . $documentos);
            } else {
                $documento->saveAs(Yii::getAlias('@groupgygImgPathPdf') . '/' . $documentos);
            }

            $model->archivo = $documentos;
            $model->extension = $documento->getExtension();
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $documento = UploadedFile::getInstance($model, 'archivo2');

            $nombre = $model->Nombre;
            $recorridoTrue = strpos($nombre, ' ');
            $recorridoFalse = strlen($nombre);

            if ($recorridoTrue == '') {
                $recorrido = $recorridoFalse;
            } else {
                $recorrido = $recorridoTrue;
            }
            if (isset($documento)) {
                $model->Fecha_Modificado = $this->ZonaHoraria();
                $model->Usuario_Modificado = Yii::$app->user->identity->email;
                $ReNombre = substr($nombre, 0, $recorrido);
                $documentos = $this->getDocumento($documento->getExtension(), $ReNombre, $model->Codigo_Documento);

                if ($documento->getExtension() == 'jpg' || $documento->getExtension() == 'png') {
                    $documento->saveAs(Yii::getAlias('@groupgygImgPathImagen') . '/' . $documentos);
                } else {
                    $documento->saveAs(Yii::getAlias('@groupgygImgPathPdf') . '/' . $documentos);
                }
                $model->archivo = $documentos;
                $model->extension = $documento->getExtension();
                $model->save();
                return $this->redirect(['index']);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {

        $model = new Documento();
        $fh_delete = $this->ZonaHoraria();
        $estado = '0';
        $usuario = Yii::$app->user->identity->email;
        $model->ActualizarDocumento($id, $fh_delete, $usuario, $estado);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function ZonaHoraria()
    {
        date_default_timezone_set('America/Lima');
        $Fecha_Hora = date('Y-m-d h:i:s', time());
        return $Fecha_Hora;
    }

    public function Fecha()
    {
        date_default_timezone_set('America/Lima');
        $Fecha_Hora = date('Ymdhi', time());
        return $Fecha_Hora;
    }

    public function getDocumento($extension, $nombre, $codigo)
    {
        $Imagen = Yii::getAlias('@groupgygImgPathImagen');
        $Pdf = Yii::getAlias('@groupgygImgPathPdf');

        if (!file_exists($Imagen)) {
            mkdir($Imagen, 0777, true);
        }
        if (!file_exists($Pdf)) {
            mkdir($Pdf, 0777, true);
        }

        switch ($extension) {
            case 'pdf':
                return "$nombre" . '_' . "$codigo-" . $this->Fecha() . '.' . $extension . "";
                break;
            case 'jpg':
                return "$nombre" . '_' . "$codigo-" . $this->Fecha() . '.' . $extension . "";
                break;
            case 'png':
                return "$nombre" . '_' . "$codigo-" . $this->Fecha() . '.' . $extension . "";
                break;
            default:
                echo "Problema en el formato";
        }
    }

    public function actionDescarga($id)
    {
        $model = new Documento();
        $archivo = $model->getDocumento($id);
        $extension = $model->getExtension($id);

        if ($extension == 'jpg' || $extension == 'png') {
            $ruta = 'documentos/imagen';
        } else {
            $ruta = 'documentos/pdf';
        }
        $this->downloadFile($ruta, $archivo);
        exit();
        return $this->redirect('index');

    }

    private function downloadFile($dir, $file)
    {
        if (is_dir($dir)) {

            $path = $dir . '/' . $file;

            if (is_file($path)) {
                $size = filesize($path);
                header("Content-Type: application/force-download");
                header("Content-Disposition: attachment; filename=$file");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $size);
                // Descargar archivo
                readfile($path);
                return true;
            }
        }
        return false;
    }
}
