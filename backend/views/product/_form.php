<?php

use dosamigos\ckeditor\CKEditor;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]);?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

     <?=$form->field($model, 'image_url', [
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
    'inputOptions' => ['class' => 'custom-file-input'],
])->textInput(['type' => 'file'])?>


    <?=$form->field($model, 'price')->textInput([

    'maxlength' => true,
    'type' => 'number',

])?>

    <?=$form->field($model, 'description')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'basic',
])?>
    <?=$form->field($model, 'rate')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'rate')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'product_category')->dropDownList(['1' => 'Msi', '2' => 'Dell', '3' => 'Asus'], ['prompt' => 'Type Item', 'placeholder' => 'Type Item'])->label(false)?>

    <?=$form->field($model, 'status')->checkbox()?>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>
    <?php ActiveForm::end();?>


</div>
</div>
