<?php

use yii\helpers\Url;
$base_url = Yii::getAlias('@web');
?>

<div class="col mb-5 product-item" data-id=<?=$model->id?>>
          <div class="card h-100">
            <!-- Product image-->
            <a href="<?=Url::toRoute(["/site/product-detail", 'id' => $model->id])?>">
              <img class="card-img-top" src="<?=$base_url . "/upload/" . $model->image_url?>" alt=" ..." />
            </a>
            <!-- Product details-->
            <div class="card-body p-4">
              <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder"><?=$model->name?></h5>
                <h6><?=$model->description?></h6>
                <!-- Product price-->
                $<?=$model->price?>
              </div>
              <div class="d-flex justify-content-center small text-warning mb-2">
                <?php //loop star
for ($i = 1; $i <= 5; $i++) {
    if ($i < $model->rate) {
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