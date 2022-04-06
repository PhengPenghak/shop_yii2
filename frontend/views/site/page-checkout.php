<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$user = Yii::$app->user->identity;
// print_r($user);
// exit;
?>
<?php $base_url = Yii::getAlias("@web");  ?>
<!-- <script
    src="https://www.paypal.com/sdk/js?client-id=AbRk2q_sjpztKSLPgjJpKZDC8eXmUzk5LM8Lv61_E2wkjtMFuxuUmiJW3mNmQULgQ-of3k4ZmafKQsBB">
</script> -->

<div class="container">
    <?php $form = ActiveForm::begin([]) ?>
    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="card-header">
                    <label for="inputEmail4">Account Information</label>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'firstName')->textInput() ?>
                    <?= $form->field($model, 'lastName')->textInput() ?>
                    <?= $form->field($model, 'email')->textInput() ?>

                </div>

            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <label for="inputEmail4">Address Information</label>
                </div>
                <div class="form-group">
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'address')->textInput() ?>
                    <?= $form->field($model, 'city')->textInput() ?>
                    <?= $form->field($model, 'state')->textInput() ?>
                    <?= $form->field($model, 'country')->textInput() ?>
                    <?= $form->field($model, 'zipcode')->textInput() ?>

                </div>
            </div>
        </div>
        <div class="col mt-3">

            <div class="card">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <?php foreach ($carts as $key => $cart) : ?>

                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <img src="<?= $base_url . '/upload/' . $cart['image_url'] ?>" alt="" style="width:80px;">
                                </td>
                                <td>
                                    <?= $cart['name'] ?>
                                </td>
                                <td>
                                    $<?= $cart['unit_price'] ?>
                                </td>
                            </tr>

                        </tbody>
                    <?php endforeach; ?>

                </table>
                <td>
                    Subtotal :$<?= $total_price ?>
                </td>
                <div class="card-body">

                    <div id=" paypal-button-container">
                    </div>
                    <p class="text-left mt-3">
                        <?= Html::submitButton('Place Order', ['class' => 'btn btn-outline-secondary ']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!-- <script>
paypal.Buttons().render('#paypal-button-container');
</script> -->