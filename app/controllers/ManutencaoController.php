<?php

namespace app\controllers;

use app\models\Servico;
use Yii;
use app\models\Manutencao;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManutencaoController implements the CRUD actions for Manutencao model.
 */
class ManutencaoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Manutencao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Manutencao::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manutencao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $servicoDataProvider = new ActiveDataProvider([
            'query' => Servico::find(),
        ]);
        return $this->render('view', [
            'servicoDataProvider' => $servicoDataProvider,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Manutencao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Manutencao();

        $servicos= [new Servico];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           foreach(Yii::$app->request->post()['Servico'] as $itemServico)
           {

               $is = new Servico();

               $is->manutencao_id = $model->id;
               $is->inicio = date_create_from_format('d/m/Y', $itemServico['inicio'])->format('Y-m-d');
               $is->custo = $itemServico['custo'];
               $is->inicio = date_create_from_format('d/m/Y', $itemServico['inicio'])->format('Y-m-d');
               $is->termino = date_create_from_format('d/m/Y', $itemServico['termino'])->format('Y-m-d');
               $is->tempo = $itemServico['tempo'];
               $is->peca = $itemServico['peca'];
               $is->save();
           }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'servicos' =>$servicos
            ]);
        }
    }

    /**
     * Updates an existing Manutencao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'servicos' => $model->servicos,
                'model' => $model,
            ]);
        }
    }




    /**
     * Deletes an existing Manutencao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Manutencao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manutencao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manutencao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function loadServicoByAjax()
    {
        $servico = new Servico;
        $this->render('../servico/_form', ['model' => $servico]);
    }
}
