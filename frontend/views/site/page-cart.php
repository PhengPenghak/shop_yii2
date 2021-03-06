
<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

$base_url = Yii::getAlias("@web");
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-lg-9">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Product</th>
                                <th scope="col" width="120">Unit Price</th>
                                <th scope="col" width="120">Quantity</th>
                                <th scope="col" width="120">Total Price</th>
                                <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carts as $key => $cart) : ?>
                                <tr id="cart-item-<?= $cart['id'] ?>" class="update_qty">
                                    <td>
                                        <figure class="itemside align-items-center">
                                            <div class="aside"><img src="<?= $base_url . '/upload/' . $cart['image_url'] ?>" class="img-sm"></div>
                                            <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true"><?= $cart['name'] ?></a>
                                                <p class="text-muted small"> <br></p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>

                                        <input type="hidden" id="input_unit_price_<?= $key ?>" data-id="<?= $key ?>" value="<?= $cart['unit_price'] ?>">
                                        <div class="price-wrap"><var data-id="<?= $key ?>" class="unit_price_ <?= $key ?>"><br>$<?= $cart['unit_price'] ?></var></div>
                                    </td>
                                    <td>
                                        <input data-cartId="<?= $cart['id'] ?>" id="row_cart_qty_<?= $key ?>" data-id="<?= $key ?>" type="number" class="form-control text-center input_quantity" value="<?= $cart['quantity'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon<?= $key ?>">
                                    <td>
                                        <input class="input_total_price" type="hidden" id="input_total_price_<?= $key ?>" data-id="<?= $key ?>" value="<?= $cart['total_price'] ?>">
                                        <div class="price-wrap"><var data-id="<?= $key ?>" class="total_price_<?= $key ?>"><br>$<?= $cart['total_price'] ?></var></div>
                                    </td>
                                    <td>
                                        <?php echo Html::button(
                                            'Remove',
                                            [
                                                'class' => 'btn btn-danger btn-sm  btn-remove-item warning ',
                                                'data-id' => $cart['id']
                                            ]
                                        ) ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </aside>
        <aside class="col-lg-3">
            <div class="card mb-3">
                <div class="card-body">
                    <form>
                        <div class="form-group"> <label>Have coupon?</label>
                            <div class="input-group"> <input type="text" class="form-control coupon" name="" placeholder="Coupon code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <dl class="dlist-align">
                        <dt>Total price:</dt>
                        <dd id="cart-subtotal-price" class="text-right ml-3">
                            <?= Yii::$app->formatter->asCurrency($total_price) ?>
                        </dd>
                    </dl>
                    <!-- <dl class="dlist-align">
                        <dt>Discount:</dt>
                        <dd class="text-right text-danger ml-3">- $10.00</dd>
                    </dl> -->
                    <hr>
                    <a href="<?= Url::to(['site/checkout']) ?>" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Proceed to checkout</a>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php
$script = <<<JS

$('.input_quantity').on('change keyup', function(e){
    e.preventDefault();
    var qty = $(this).val();
    qty = parseInt(qty);
    if(qty <= 0 || isNaN(qty)){
         qty = 1;
        $(this).val(1);
    }
    var id = $(this).data('id');
    var unit_price =  $("#input_unit_price_"+id).val();
    unit_price = parseFloat(unit_price);
    var total_price = qty * unit_price;
    
    total_price = parseFloat(total_price).toFixed(2);
    $("#input_total_price_"+id).val(total_price);
    $(".total_price_"+id).html("<br>$"+total_price);

    var cartId = $(this).data('cartid');
   
    $.ajax({
        url: "$base_url"+"/index.php?r=site/cart",
        method: 'POST',
        data: {
            qty: qty,
            cartId: cartId,
            action: 'update_qty',
        },
        success: function(res){
            var sum = 0;
            $('.input_total_price').each(function(){
                sum += parseFloat($(this).val());
            });
            sum = parseFloat(sum).toFixed(2);
            $("#cart-subtotal-price").html('$'+sum);
        },
        error: function(err){
            console.log(err);
        }
    });
});

$('.btn-remove-item').on('click', function(e){
    e.preventDefault();
    var id = $(this).closest('.btn-remove-item').data('id');
    $.ajax({
        url: "$base_url"+"/site/cart",
        method: 'POST',
        data: {
            id: id,
            action: 'remove_cart_item',
        },
        success: function(res){
            var data = JSON.parse(res);
            if(data.success){
                $("#cart-item-"+id).remove();
                $('#cart-subtotal-price').html(data.total_price)
                $('#cart-total-price').html(data.total_price)
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