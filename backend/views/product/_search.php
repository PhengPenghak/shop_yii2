<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);?>

<div class="row">
        <div class="col-4">
            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="fas fa-calendar"></i>&nbsp;
                <span></span> <i class="fas fa-caret-down"></i>
            </div>
            <?=$form->field($model, 'start_date')->hiddenInput()->label(false)?>
            <?=$form->field($model, 'end_date')->hiddenInput()->label(false)?>
        </div>
        <div class="col-4">
            <div class="input-group input-group-sm mb-3">
                <div style="width: 70%;">
                    <?=$form->field($model, 'globalSearch')->textInput(['aria-label' => 'Search', 'type' => 'search', 'class' => 'form-control form-control-navbar', 'placeholder' => 'Search Product ...'])->label(false)?>
                </div>
                <div class="input-group-addon " style="width: 30%;">
                    <span><?=Html::submitButton('<i class="fas fa-search"></i> Search', ['class' => 'btn btn-md btn-primary '])?></span>
                </div>
            </div>
        </div>
        <div class="col-4">
            <p class="float-right">
            <button type="button" value="<?=Url::to(['product/create'])?>" class="btn btn-success triggerModal ">Add Product</button>

            </p>
        </div>
    </div>




    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'rate') ?>



    <?php ActiveForm::end();?>

</div>

