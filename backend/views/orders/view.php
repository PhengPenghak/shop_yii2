<?php

use backend\models\OrderItems;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    </p>
    <?= Html::a('Invoice PDF', ['gen-pdf', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="https://tkcustomcomputer.com/assets/uploads/brands/3295d1860ddfdc6e625e85371a73e5a8.png">
                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Order ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Product ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order_items as $key => $orderItem) : ?>
                                        <tr>
                                            <td><?= $orderItem['id'] ?></td>
                                            <td><?= $orderItem['order_id'] ?></td>
                                            <td><?= $orderItem['product_id'] ?></td>
                                            <td><?= $orderItem['quantity'] ?></td>
                                            <td><?= $orderItem['unit_price'] ?>$</td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>