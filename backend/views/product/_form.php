<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/from-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'price')->textInput([
        
        'maxlength' => true,
        'type' => 'number'
        
        ])?>
    <?= $form->field($model, 'imageFile',[
        'template' => '
             <div class="input-group mb-3">
                <div class="custom-file">
                    {input}
                    {label}
                    {error}
                </div>
             </div>    
        ',
        'labelOptions' => ['class' => 'custom-file-label'],
        'inputOptions' => ['class' => 'custom-file-option']
    ])->textInput(['type' => 'file']) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->checkbox() ?>

    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
