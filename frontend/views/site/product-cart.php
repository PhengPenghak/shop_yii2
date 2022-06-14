<?php

use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\rbac\Item;
use yii\widgets\ListView;

Modal::begin([
  'title' => 'Add User',
  'id' => 'modal',
  'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<?php $base_url = Yii::getAlias("@web"); ?>
<?php $base_url = Yii::getAlias("@web"); ?>
<section class="py-5 bg-light">
  <div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4">PRODUCT</h2>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
      <?php
      echo ListView::widget( [
        'dataProvider' => $dataProvider,
        'itemView' => 'product_item',
    ] );
      ?>
    </div>
  </div>
</section>

<?php

$add_to_cart = Url::to(['site/cart']);
$script = <<<JS

const base_url = "$base_url";
$('.add-to-cart').click(function(e) {
  e.preventDefault();
  var id =  $(this).closest(".product-item").data("id");
  console.log(id);
  $.ajax({
    url: "$add_to_cart ",
    method:'POST',
    data:{
      id: id,
      action:"add-to-cart"
    },
    success: function(res){
      var data = JSON.parse(res);
      console.log(data);
      if(data['status'] == 'success'){
        $("#cart-quantity").text(data['totalCart']);
      }else{
        alter(data['message']);
      }
    },

    error: function(err){
      console.log(err);
    }
  });
});
  $(document).on("click",".triggerModal",function(){
    $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
  });
JS;
$this->registerJs($script);
?>
