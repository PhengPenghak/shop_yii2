<?php

use yii\helpers\Url;
use yii\widgets\ListView;

?>
<?php $base_url = Yii::getAlias("@web"); ?>
<section class="py-5 2">
  <div class="container px-4 px-lg-5 my-5 product-item">
    <div class="row gx-4 gx-lg-5 align-items-center ">
      <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= $base_url . "/upload/" . $model->image_url ?>"></div>
      <div class="col-md-6   ">
        <h1 class="display-5 fw-bolder"><?= $model->name ?></h1>
        <div class="fs-5 mb-5">
          <span class="text-decoration-line-through"></span>
          <span>$<?= $model->price ?></span>
        </div>
        <p class="lead"><?= $model->description ?></p>
        <div class="d-flex">
          <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
          <a href="" class="btn btn-outline-dark mt-auto add-to-cart">Add to cart</a>
        </div>

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

JS;
$this->registerJs($script);
?>