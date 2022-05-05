<?php

use yii\bootstrap4\LinkPager;
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

<div class="col-md-12 text-right custom-footer" style="font-size: 13px; position:fixed; z-index:10;bottom:3%;left:-76%">
  <a href="<?= Url::to(['site/product']) ?>" class="btn btn-info">ALL</a>
  <a href="<?= Url::to(['site/msi']) ?>" class="btn btn-info">MSI</a>
  <a href="<?= Url::to(['site/asus']) ?>" class="btn btn-info">ASUS</a>
  <a href="<?= Url::to(['site/dell']) ?>" class="btn btn-info">DELL</a>
</div>
<?php $base_url = Yii::getAlias("@web"); ?>

<section class="py-5 bg-light">
  <div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4">PRODUCT</h2>
    <div class="wrapper">
    <!-- filter Items -->
    <!-- <nav>
      <div class="items">
        <span class="item active" data-name="all">All</span>
        <span class="item" data-name="Laptop">Laptop</span>
        <span class="item" data-name="Accessorise">Accessorise</span>
        <span class="item" data-name="Hardware">Hardware</span>
        <span class="item" data-name="camera">Peripharals</span>
        <span class="item" data-name="headphone">Headphone</span>

      </div> -->
    </nav>
  </div>
    <?php
      echo ListView::widget( [
        'dataProvider' => $dataProvider,
        'itemView' => 'product_item',
        'itemOptions'=>[
          'class'=>'col-lg-3'
        ],
        'pager' => [
          'firstPageLabel' => 'First',
          'lastPageLabel' => 'Last',
          'class'=>LinkPager::class
      ],
        'layout'=>'
        <div class=" row table-responsive">
        {items}
        </div>
        <div class="row">
        <div class="col-6">
        {summary}
        </div>
        <div class="col-6">
        {pager}
        </div>
        </div>
        ',
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
  $(click-click).on("click","message",function(){
    Swal.fire({
  title: 'Do you want to save the changes?',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: 'Save',
  denyButtonText: `Don't save`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Saved!', '', 'success')
  } else if (result.isDenied) {
    Swal.fire('Changes are not saved', '', 'info')
  }
})
  })
JS;
$this->registerJs($script);
?>
