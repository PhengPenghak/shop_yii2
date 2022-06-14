<?php

use backend\models\Orders;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

// $this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>


<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-0">
          <div class="row p-5">
            <div class="col-md-6">
              <img src="https://tkcustomcomputer.com/assets/uploads/brands/3295d1860ddfdc6e625e85371a73e5a8.png">
            </div>

            <div class="col-md-6 text-right">
              <Phnom class="font-weight-bold mb-1">Ecommerce Testing</br>
              #74A , St150 , Sankat Phsar Depo Ti 2</br>Phnom Penh 12000</br>
              pengpenghak1@gmail.com</br>086823955 - 092976462</p>
            </div>
          </div>

          <hr class="my-5">
          <div class="row p-5">
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                    <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                    <th class="border-0 text-uppercase small font-weight-bold">Unit Price</th>
                    <th class="border-0 text-uppercase small font-weight-bold">Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($orders as $key => $order) : ?>
                    <tr>
                      <td><?= $order['product_name'] ?> <br> <?= $order['product_description'] ?> </td>
                      <td><?= $order['quantity'] ?></td>
                      <td><?= $order['unit_price'] ?></td>
                      <td><?= $order['total_price'] ?></td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
          </div>

          <div class="d-flex flex-row-reverse bg-dark text-white p-4">
            <div class="py-3 px-5 text-right">
              <div class="mb-2">Grand Total</div>
              <div class="h2 font-weight-light">$ <?= number_format(array_sum(array_column($orders, 'total_price')), 2) ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>

</div>