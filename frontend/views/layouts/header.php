<?php

use app\models\Cart;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$current_user = Yii::$app->user->id;
$totalCart = Cart::find()
    ->select(['SUM(quantity) quantity'])
    ->where(['user_id' => $current_user])
    ->one();
$totalCart = (int) $totalCart->quantity;

?>
<header class="header_section">
    <div class="header_top">
        <div class="container-fluid">
            <div class="top_nav_container">
                <div class="contact_nav">
                    <a href="">

                        <span>
                            Eamil:
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
          <!-- $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'options' => ['class' => 'trigggerModal']]; -->
          <?=Html::a('Logout', ['site/login'], ['class' => 'btn trigggerModal', 'data' => ['method' => 'post']])?>
          <span class="text-dark p-3 fw-bold">|</span>
          <?=Html::a('Signup', ['site/signup'], ['class' => 'btn trigggerModal', 'data' => ['method' => 'post']])?>

          <!-- $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']]; -->
        <?php
} else {

    ?>
        <?php $menuItems[] = ['label' => ''];?>
                        <a class="nav-icon position-relative text-decoration-none" href="<?=Url::to(['site/page'])?>">
                            <form class="d-flex">
                                <span class="badge bg-dark text-white ms-2 rounded-pill"></span>
                                <a class="nav-link" href="<?=Url::to(['site/page'])?>"> <i class="bi-cart-fill me-1"></i>
                                    Cart</a>
                            </form> <span id="cart-quantity" class="position-absolute top-2 right-20 translate-middle badge rounded-pill badge badge-danger" style="margin-left: 73px; margin-bottom:-22px;">
                                <?=$totalCart?>
                            </span>
                        </a>

                </div>
                    </a>
                </div>

            </div>

        </div>
    </div>
    <div class="header_bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="<?=Yii::$app->homeUrl?>">
                    <span>
                        Minics
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?=Yii::$app->homeUrl?>">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?=Url::to(['site/about'])?>"> About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=Url::to(['site/product'])?>">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=Url::to(['site/why'])?>">Why Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=Url::to(['site/testimonial'])?>">Testimonial</a>
                        </li>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-user" aria-hidden="true"></i><?=Yii::$app->user->identity->username?><span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                </span></a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?=Html::a('Logout', ['site/logout'], ['class' => 'btn trigggerModal', 'data' => ['method' => 'post']])?>
                                        <li><a class="dropdown-item" href="#"></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                    </ul>
                </div>
     <?php
}
?>
            </nav>
        </div>
    </div>
</header>
