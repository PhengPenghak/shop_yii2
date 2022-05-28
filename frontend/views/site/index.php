<div id="container">
    <label class="switch">
      <input type="checkbox" onclick="changeMode()">
      <span class="slider"></span>
    </label>
  </div>
<?php

$base_url = Yii::getAlias("@web");

?>


  <!-- slider section -->
  <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
              <div class="row">
                  <div class="img-box">
                    <img src="https://storage-asset.msi.com/global/picture/banner/banner_1644914130b0ed9a75e4b5062effe545d1c43eac8c.jpeg" alt="">
                  </div>

              </div>

          </div>
          <div class="carousel-item">

              <div class="row">


                  <div class="img-box">
                    <img src="https://storage-asset.msi.com/global/picture/banner/banner_16487190419ef4785266ba9977530b3629d41e328d.jpeg" alt="">
                  </div>

              </div>

          </div>
          <div class="carousel-item">

              <div class="row">


                  <div class="img-box">
                    <img src="https://storage-asset.msi.com/global/picture/banner/banner_164852300762efa60e844a15758ee24183cc807694.jpeg" alt="">
                  </div>

              </div>

          </div>
        </div>
        <!-- <div class="carousel_btn_box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div> -->
      </div>
    </section>
    <!-- end slider section -->
<div class="row">
    <?php

use yii\bootstrap4\LinkPager;
use yii\widgets\ListView;

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
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'product_item',
    'itemOptions' => [
        'class' => 'col-lg-3',
    ],
    'pager' => [
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        'class' => LinkPager::class,
    ],
    'layout' => '
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
]);
?>


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
                        <img src="https://godofpcgame.com/fronts/category/icons/dY4l2ZaowlDMtIS48RqRGc99hGTmFI5AE3GApIJE.png" alt="">
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
