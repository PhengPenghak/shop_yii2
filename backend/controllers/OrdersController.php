<?php

namespace backend\controllers;

use app\models\OrderAddress;
use app\models\OrderItems;
use app\models\Orders as ModelsOrders;
use backend\models\Invoices;
use backend\models\Orders;
use backend\models\OrdersSearch;
use yii;
use Mpdf\Mpdf; #Php 7.0
use Yii as GlobalYii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $order_items = Yii::$app->db->createCommand("SELECT
        order_items.id AS id,
        order_items.order_id AS order_id,
        order_items.product_id AS product_id,
        order_items.quantity AS quantity,
        order_items.unit_price AS unit_price
    FROM
        `order_items`
        INNER JOIN ORDERs ON ORDERs.id = order_items.order_id 
    WHERE
        ORDERs.id = :id")
            ->bindParam('id', $id)
            ->queryAll();
        $order_items_total_price = Yii::$app->db->createCommand("SELECT
        SUM(total_price) as total_price
    FROM
        `order_items`
    WHERE
        id = :id")
            ->bindParam('id', $id)
            ->queryOne();
        $user = Yii::$app->user->identity->id;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'order_items' => $order_items,
            'order_items_total_price' => $order_items_total_price,
        ]);
    }
    // public function actionGenPdf($id)
    // {
    //     // $order_item = Yii::$app->db->createCommand("SELECT SUM(total) as total_price FROM `order_item` 
    //     // where order_id = :id")
    //     //     ->bindParam("id", $id)
    //     //     ->queryOne();
    //     $orders = Orders::findOne($id);
    //     $user = Yii::$app->user->identity->id;

    //     $pdf_content = $this->renderPartial('invoice', [
    //         'model' => $this->findModel($id),
    //         'orders' => $orders,
    //         // 'order_item' => $order_item

    //     ]);

    //     $model = new Mpdf();
    //     $model->WriteHTML("$pdf_content");
    //     $model->Output('MyPDF.pdf', 'D');
    //     exit;
    // }
    public function actionInvoice($id)
    {

        // $model = new Orders();
        $orders = Yii::$app->db->createCommand("SELECT product.`name` product_name, product.description product_description, order_items.quantity,  order_items.unit_price, order_items.total_price
        FROM order_items
        INNER JOIN product ON product.id = order_items.product_id
        WHERE order_items.order_id = :id
        ")
            ->bindParam('id', $id)
            ->queryAll();
        return $this->render('invoice', [
            'orders' => $orders,

        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ModelsOrders();

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
     * Updates an existing Orders model.
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
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
