<?php

use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;
use app\models\Cart;

$current_user = Yii::$app->user->id;
$totalCart = Cart::find()
    ->select(['SUM(quantity) quantity'])
    ->where(['user_id' => $current_user])
    ->one();
$totalCart = $totalCart->quantity;

?>
<header class="header_section">
    <div class="header_top">
        <div class="container-fluid">
            <div class="top_nav_container">
                <div class="contact_nav">
                    <a href="">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>
                            Call : +855 86823955
                        </span>
                    </a>
                    <a href="">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>
                            Email : phengpenghak1@gmail.com
                        </span>
                    </a>
                </div>
                <from class="search_form">
                    <input type="text" class="form-control" placeholder="Search here...">
                    <button class="" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </from>

                <div class="user_option_box">

                    <?php
                    if (Yii::$app->user->isGuest) {
                    ?>
                    <a class="nav-icon position-relative text-decoration-none trigggerModal"
                        value="<?= Url::to(['/site/login']) ?>" href="#">
                        <span id="cart-quantity"
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger">0</span>
                    </a>

                    <?php
                    } else {
                    ?>
                    <a class="nav-icon position-relative text-decoration-none" href="<?= Url::to(['site/page']) ?>">
                        <form class="d-flex">
                            <span class="badge bg-dark text-white ms-2 rounded-pill"></span>
                            <a class="nav-link" href="<?= Url::to(['site/page']) ?>"> <i class="bi-cart-fill me-1"></i>
                                Cart</a>
                        </form> <span id="cart-quantity"
                            class="position-absolute top-2 right-20 translate-middle badge rounded-pill badge badge-danger"
                            style="margin-left: 73px; margin-bottom:-22px;">
                            <?= $totalCart ?>
                        </span>
                    </a>
                    <?php
                    }
                    ?>
                    </a>
                </div>

            </div>

        </div>
    </div>
    <div class="header_bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
                    <span>
                        Minics
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Yii::$app->homeUrl ?>">Home <span
                                    class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['site/about']) ?>"> About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['site/product']) ?>">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['site/why']) ?>">Why Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['site/testimonial']) ?>">Testimonial</a>
                        </li>

                        <!-- <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button> -->

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"><span
                                class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-user"
                                            aria-hidden="true"></i>My Account</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <li><a class="dropdown-item" href="#"></a>
                                            <?= Html::a('Logout', ['site/logout'], ['class' => 'btn', 'data' => [
                                                'method' => 'post',
                                            ]]) ?>
                                        </li>
                                        <li><a class="dropdown-item" href="#!"></a>
                                            <?= Html::a('SignUp', ['site/signup'], ['class' => 'btn', 'data' => [
                                                'method' => 'post',
                                            ]]) ?>
                                        </li>

                                    </ul>
                                </li>
                            </ul>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>