<?php

$base_url = Yii::getAlias("@web");

?>
<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://dlcdnwebimgs.asus.com/gain/2DBAF7BD-19D9-4F61-BF76-1E389ACC9FAA/fwebp" alt="">
        </div>
        <div class="carousel-item">
            <img src="https://dlcdnwebimgs.asus.com/gain/9218F5BE-616D-48E0-9289-404DA1C46515/fwebp" alt="Chicago">
        </div>
        <div class="carousel-item">
            <img src="https://dlcdnwebimgs.asus.com/gain/2DBAF7BD-19D9-4F61-BF76-1E389ACC9FAA/fwebp" alt="">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>

</div>


<div class="row">
    <?php

    use yii\bootstrap4\Html;
    use yii\helpers\Url;

    ?>
    <!-- product section -->

    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Products
                </h2>
            </div>
            <div class="row">
                <?php
                foreach ($product as $key => $pro) { //loop 
                ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="<?= $base_url . "/upload/" .  $pro->image_url ?>" alt="" class="img-fluid">
                            <a href="" class="add_cart_btn">
                                <span>
                                    Add To Cart
                                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                <?= $pro->name ?>

                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> <?= $pro->price ?>
                                </h5>
                                <div class="star_container">
                                    <?php  //loop star
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i < $pro->rate) {
                                                echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                            } else {
                                                echo '<i class="fa fa-star text-dark" aria-hidden="true"></i>';
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <?php } ?>


            </div>
            <div class="btn_box">
                <a href="<?= Url::to(['site/product']) ?>" class="view_more-link">
                    View More
                </a>
            </div>
        </div>
    </section>

    <!-- about section -->

    <section class="about_section">
        <div class="container-fluid  ">
            <div class="row">
                <div class="col-md-5 ml-auto">
                    <div class="detail-box pr-md-3">
                        <div class="heading_container">
                            <h2>
                                We Provide Best For You
                            </h2>
                        </div>
                        <p>
                            Totam architecto rem beatae veniam, cum officiis adipisci soluta perspiciatis ipsa, expedita
                            maiores quae accusantium. Animi veniam aperiam, necessitatibus mollitia ipsum id optio ipsa
                            odio
                            ab facilis sit labore officia!
                            Repellat expedita, deserunt eum soluta rem culpa. Aut, necessitatibus cumque. Voluptas
                            consequuntur vitae aperiam animi sint earum, ex unde cupiditate, molestias dolore quos quas
                            possimus eveniet facilis magnam? Vero, dicta.
                        </p>
                        <a href="">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="img-box">
                        <img src="https://godofpcgame.com/fronts/category/icons/dY4l2ZaowlDMtIS48RqRGc99hGTmFI5AE3GApIJE.png"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- why us section -->

    <section class="why_us_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Why Choose Us
                </h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/w1.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Fast Delivery
                            </h5>
                            <p>
                                variations of passages of Lorem Ipsum available
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/w2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Free Shiping
                            </h5>
                            <p>
                                variations of passages of Lorem Ipsum available
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/w3.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Best Quality
                            </h5>
                            <p>
                                variations of passages of Lorem Ipsum available
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end why us section -->


    <!-- client section -->

    <section class="client_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    What Says Our Customers
                </h2>
            </div>
        </div>
        <div class="client_container ">
            <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="box">
                                <div class="detail-box">
                                    <p>
                                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                                    </p>
                                    <p>
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page
                                        when looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less normal
                                        distribution of letters, as opposed to using 'Content here, content here',
                                        making it
                                        lookIt is a
                                        long established fact that a reader will be distracted by the readable content
                                        of a
                                        page when
                                        looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less
                                        normal
                                        distribution of letters, as opposed to using 'Content here, content here',
                                        making it
                                        look
                                    </p>
                                </div>
                                <div class="client-id">
                                    <div class="img-box">
                                        <img src="images/client.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <h5>
                                            James Dew
                                        </h5>
                                        <h6>
                                            Photographer
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="box">
                                <div class="detail-box">
                                    <p>
                                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                                    </p>
                                    <p>
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page
                                        when looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less normal
                                        distribution of letters, as opposed to using 'Content here, content here',
                                        making it
                                        lookIt is a
                                        long established fact that a reader will be distracted by the readable content
                                        of a
                                        page when
                                        looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less
                                        normal
                                        distribution of letters, as opposed to using 'Content here, content here',
                                        making it
                                        look
                                    </p>
                                </div>
                                <div class="client-id">
                                    <div class="img-box">
                                        <img src="images/client.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <h5>
                                            James Dew
                                        </h5>
                                        <h6>
                                            Photographer
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="box">
                                <div class="detail-box">
                                    <p>
                                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                                    </p>
                                    <p>
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page
                                        when looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less normal
                                        distribution of letters, as opposed to using 'Content here, content here',
                                        making it
                                        lookIt is a
                                        long established fact that a reader will be distracted by the readable content
                                        of a
                                        page when
                                        looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less
                                        normal
                                        distribution of letters, as opposed to using 'Content here, content here',
                                        making it
                                        look
                                    </p>
                                </div>
                                <div class="client-id">
                                    <div class="img-box">
                                        <img src="images/client.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <h5>
                                            James Dew
                                        </h5>
                                        <h6>
                                            Photographer
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
                        <span>
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
                        <span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end client section -->

    <!-- info section -->
    <section class="info_section ">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="info_contact">
                        <h5>
                            <a href="" class="navbar-brand">
                                <span>
                                    Minics
                                </span>
                            </a>
                        </h5>
                        <p>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            Address
                        </p>
                        <p>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            +01 1234567890
                        </p>
                        <p>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            demo@gmail.com
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_info">
                        <h5>
                            Information
                        </h5>
                        <p>
                            Eligendi sunt, provident, debitis nemo, facilis cupiditate velit libero dolorum aperiam enim
                            nulla iste maxime corrupti ad illo libero minus.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_links">
                        <h5>
                            Useful Link
                        </h5>
                        <ul>
                            <li>
                                <a href="index.html">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="about.html">
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="product.html">
                                    Products
                                </a>
                            </li>
                            <li>
                                <a href="why.html">
                                    Why Us
                                </a>
                            </li>
                            <li>
                                <a href="testimonial.html">
                                    Testimonial
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_form ">
                        <h5>
                            Newsletter
                        </h5>
                        <form action="">
                            <input type="email" placeholder="Enter your email">
                            <button>
                                Subscribe
                            </button>
                        </form>
                        <div class="social_box">
                            <a href="">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>