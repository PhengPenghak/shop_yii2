<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'tableOptions' => [
            'class' => 'table table-hover',
        ],
        'layout' => '
            {items}
            <div class="row mb-3">
                <div class="col-lg-6">
                   {summary}
                </div>
                    <div class="col-lg-6">
                        {pager}
                    </div>
            </div>
        ',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            //'product_id',
            'firstname',
            'lastname',
            'total_price',
            // 'status',
            //'transaction',
            //'email:email',
            'created_at',
            //'create_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{invoice}',
                'buttons' => [

                    'view' => function ($url) {
                        return Html::a('View', $url, ['class' => 'btn btn-outline-primary']);
                    },

                    'invoice' => function ($url, $model) {
                        return Html::a('Invoice', ['/orders/invoice', 'id' => $model->id], [
                            'class' => 'btn btn-outline-warning',
                        ]);
                    },

                ],
                'header' => 'action',
            ],



        ],
    ]); ?>


</div>