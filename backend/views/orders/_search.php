<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['id' => 'formInvoiceSearch', 'data-pjax' => true],
        'method' => 'get',
    ]); ?>



    <?php // echo $form->field($model, 'transaction') 
    ?>

    <?php // echo $form->field($model, 'email') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <?php // echo $form->field($model, 'create_by') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="row">
    <div class="col-lg-6">
        <label>Date Range</label>
        <div id="order__date__range" style="cursor: pointer;" class="form-control">
            <i class="fas fa-calendar text-muted"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
        </div>
        <?= $form->field($model, 'from_date')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'to_date')->hiddenInput()->label(false) ?>
    </div>
    <div class="col-lg-6">
        <label>Search</label>
        <?= $form->field($model, 'globalSearch')->textInput([
            'placeholder' => 'Search...', 'aria-label' => 'Search', 'type' => 'search',
            'class' => 'form-control form-control-navbar',
            // 'style' => 'border-top-right-radius: 0;
            //     border-bottom-right-radius: 0;'
        ])->label(false) ?>
    </div>
    <?php

    $script = <<< JS
    var is_filter = $("#searchinvoices-from_date").val() != ''?true:false;
    if(!is_filter){
        var start = moment().startOf('week');
        var end = moment();
    }else{
        var start = moment($("#searchinvoices-from_date").val());
        var end = moment($("#searchinvoices-to_date").val());
    }
    function cb(start, end) {
        $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#searchinvoices-from_date").val(start.format('YYYY-MM-D'));
        $("#searchinvoices-to_date").val(end.format('YYYY-MM-D'));
    }
    $('#order__date__range').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'This Week': [moment().startOf('week'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
    $('#order__date__range').on('apply.daterangepicker', function(ev, picker) {
        $('#formInvoiceSearch').trigger('submit');
    });
    $(document).on("change","#searchinvoices-globalsearch", function(){
        $('#formInvoiceSearch').trigger('submit');
    });
    JS;
    $this->registerJs($script);

    ?>