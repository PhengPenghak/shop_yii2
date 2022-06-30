<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$base_url = Yii::getAlias("@web");

$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>" width="300px" height="300px" style="object-fit: cover;">
                <span class="font-weight-bold">Edogaru</span>
                <span class="text-black-50">edogaru@mail.com.my</span>

            </div>
        </div>

        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="row mt-3">
                    <?= $form->field($model, 'image_url', [
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
                    ])->textInput(['type' => 'file']) ?>
                </div>
                <div class="text-center">
                    <?= Html::submitButton('Update', ['class' => 'btn rounded-0 btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

                <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> -->
            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>