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
        'options' => ['id' => 'formProductSearch', 'data-pjax' => true],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-4">
            <div id="order__date__range" style="cursor: pointer;" class="form-control">
                <i class="fas fa-calendar text-muted"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
            </div>
            <?= $form->field($model, 'from_date')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'to_date')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-lg-4">
            <div class="input-group input-group-sm mb-3">
                <div style="width: 70%;">
                    <?= $form->field($model, 'globalSearch')->textInput(['aria-label' => 'Search', 'type' => 'search', 'class' => 'form-control form-control-navbar', 'placeholder' => 'Search Product ...'])->label(false) ?>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group input-group-sm mb-3">
                <div style="width: 70%;">
                    <p class="float-right">
                        <button type="button" value="<?= Url::to(['product/create']) ?>" class="btn btn-success triggerModal ">Add Product</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php // echo $form->field($model, 'description') 
    ?>

    <?php // echo $form->field($model, 'rate') 
    ?>
    <?php ActiveForm::end(); ?>
</div>
<?php

$script = <<< JS
    var is_filter = $("#productsearch-from_date").val() != ''?true:false;
    if(!is_filter){
        var start = moment().startOf('week');
        var end = moment();
    }else{
        var start = moment($("#productsearch-from_date").val());
        var end = moment($("#productsearch-to_date").val());
    }
    function cb(start, end) {
        $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#productsearch-from_date").val(start.format('YYYY-MM-D'));
        $("#productsearch-to_date").val(end.format('YYYY-MM-D'));
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
        $('#formProductSearch').trigger('submit');
    });
    // $(document).on("change","#productsearch-globalsearch", function(){
    //     $('#formProductSearch').trigger('submit');
    // });
    $(".triggerModal").click(function () {
        $("#modal")
        .modal("show")
        .find("#modalContent")
        .load($(this).attr("value"));   
       
    });
    JS;
$this->registerJs($script);

?>