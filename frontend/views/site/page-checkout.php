<?php

use yii\helpers\Url;
?>
<?php $base_url = Yii::getAlias("@web");  ?>
<!-- <script
    src="https://www.paypal.com/sdk/js?client-id=AbRk2q_sjpztKSLPgjJpKZDC8eXmUzk5LM8Lv61_E2wkjtMFuxuUmiJW3mNmQULgQ-of3k4ZmafKQsBB">
</script> -->

<div class="container">
    <form>
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="card-header">
                        <label for="inputEmail4">Account Information</label>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Last Name</label>
                                <input type="text" class="form-control" id="inputPassword4" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Example@gmail.com">
                        </div>
                    </div>

                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <label for="inputEmail4">Address Information</label>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">City</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">State</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Country</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Zipcode</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Summary</h4>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>
                                    Product :
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Total Price :
                                </td>
                            </tr>
                        </table>

                        <div id=" paypal-button-container">
                        </div>
                        <p class="text-left mt-3">
                            <button class="btn btn-outline-secondary">Checkout </button>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<!-- <script>
paypal.Buttons().render('#paypal-button-container');
</script> -->