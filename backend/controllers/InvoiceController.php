<?php

namespace backend\controllers;

use app\models\Orders;
use backend\models\Invoices;
use backend\models\InvoicesSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * InvoiceController implements the CRUD actions for Invoices model.
 */
class InvoiceController extends Controller
{
    /**
     * @inheritDoc
     */
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

    /**
     * Lists all Invoices models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $order_items = Yii::$app->db->createCommand("SELECT SUM(total) as total_price FROM `order_items`
        // where order_id = :id")
        //     ->bindParam("id", $id)
        //     ->queryOne();
        $user = Yii::$app->user->identity->id;
        $searchModel = new InvoicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $invoices = Invoices::find()->one();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'invoice' => $invoices,
            // 'order_items' => $order_items,

        ]);
    }

    /**
     * Displays a single Invoices model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => OrderItems::find()->where(['order_id' => $id]),
        // ]);
        $user = Yii::$app->user->identity->id;
        // $order_item = Yii::$app->db->createCommand("SELECT SUM(total) as total_price FROM 'order_item'
        // where order_id = :id")
        //     ->bindParam("id", $id)
        //     ->queryOne();
        $orders = Orders::find()->one();
        $invoices = Invoices::find()->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            // 'dataProvider' => $dataProvider,
            'invoice' => $invoices,

        ]);
    }

    /**
     * Creates a new Invoices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Invoices();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Invoices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Invoices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invoices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Invoices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoices::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
