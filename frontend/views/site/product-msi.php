<?php

use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\widgets\ListView;

Modal::begin([
    'title' => 'Add User',
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<?php $base_url = Yii::getAlias("@web");?>

<div class="col-md-12 text-right custom-footer" style="font-size: 13px; position:fixed; z-index:10;bottom:3%;left:-76%">
  <a href="<?=Url::to(['site/product'])?>" class="btn btn-info">ALL</a>
  <a href="<?=Url::to(['site/msi'])?>" class="btn btn-info">MSI</a>
  <a href="<?=Url::to(['site/asus'])?>" class="btn btn-info">ASUS</a>
  <a href="<?=Url::to(['site/dell'])?>" class="btn btn-info">DELL</a>
</div>
<?php $base_url = Yii::getAlias("@web");?>


<section class="py-5 bg-light">
  <div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4">PRODUCT DELL</h2>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <div class="container">
        <!-- Cate-Products -->
        <div id="selection-mode" class="content-body  multi-price">
          <div class="row">
            <div class="col-md-2">
              <div class="content-left sticky-top">

                <div class="pc-brand">
                  <h3 class="brand-title border-0">Brand:</h3>
                  <ul class="list-unstyled brand-lists">
                    <ul class="list-unstyled brand-lists">
                      <!-- Brand -->

                      <li>
                        <a href="<?= url::to(['site/product'])?>">

                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/3295d1860ddfdc6e625e85371a73e5a8.png" alt="Asus" class="brand-logo">
                        </a>
                      </li>
                      <li>
                      <a href="<?= url::to(['site/msi'])?>">

                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/41b4d1d6e98e0aea7f0e258ed692f33a.png" alt="Asus ROG" class="brand-logo">
                        </a>
                      </li>
                      <li>
                      <a href="<?= url::to(['site/dell'])?>">
                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/08fe61411d431e2ce9a0a3dd63b5dc5f.png" alt="Asus TUF Gaming" class="brand-logo">
                        </a>
                      </li>
                      <li>
                      <a href="<?= url::to(['site/asus'])?>">

                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/5bebd205f77d5e1c3d520aa564507125.png" alt="Asus Zephyrus" class="brand-logo">
                        </a>
                      </li>
                      <li>
                      <a href="<?= url::to(['site/dell'])?>">

                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/09f26aedf418a9cf2334be6b40715417.png" alt="MSI Laptop" class="brand-logo">
                        </a>
                      </li>
                      <li>
                      <a href="<?= url::to(['site/dell'])?>">

                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/14a64d6ccbc9ecd21eadc9d201d6278b.png" alt="MSI Prestige / Conten Creators 11th Gen" class="brand-logo">
                        </a>
                      </li>
                      <li>
                      <a href="<?= url::to(['site/dell'])?>">

                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/21025472feea5382db804f0137126ee4.png" alt="THINKBOOK" class="brand-logo">
                        </a>
                      </li>
                      <li>
                      <a href="<?= url::to(['site/dell'])?>">
                          <img src="https://tkcustomcomputer.com/assets/uploads/brands/133e401c501dee75c7234ba6bc5a52c2.png" alt="Lenovo" class="brand-logo">
                        </a>
                      </li>



                    </ul>
                  </ul>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
foreach ($product_msi as $key => $pro) { //loop
    ?>
        <div class="col mb-5 product-item" data-id=<?=$pro->id?>>
          <div class="card h-100">
            <!-- Product image-->
            <a href="<?=Url::toRoute(["/site/product-detail", 'id' => $pro->id])?>">
              <img class="card-img-top" src="<?=$base_url . "/upload/" . $pro->image_url?>" alt=" ..." />
            </a>
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder"><?=$pro->name?></h5>
                <h6><?=$pro->description?></h6>
                <!-- Product price-->
                $<?=$pro->price?>
              </div>
              <div class="d-flex justify-content-center small text-warning mb-2">
                <?php //loop star
    for ($i = 1; $i <= 5; $i++) {
        if ($i < $pro->rate) {
            echo '<i class="fa fa-star" aria-hidden="true" ></i>';
        } else {
            echo '<i class="fa fa-star text-dark" aria-hidden="true"></i>';
        }
    }
    ?>
                              </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                              <div class="text-center">
                                <?php
if (Yii::$app->user->isGuest) {
        $url_route = Url::toRoute(['site/login']);
        $url_title = 'Please login to continue';
        ?>
                                    <button type="button" value="<?=$url_route?>" data-title="<?=$url_title?>" class="btn btn-outline-dark triggerModal" style="font-size: 13px;">Add to
                                      cart</button>
                                  <?php
} else {
        ?>
                                    <a href="" class="btn btn-outline-dark mt-auto add-to-cart">Add to cart</a>
                                  <?php }?>
                                </a>
              </div>

            </div>
          </div>
        </div>

        <?php }?>
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
