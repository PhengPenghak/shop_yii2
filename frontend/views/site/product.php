<section class="product_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Products
        </h2>
      </div>
     <div class="row">
        <?php foreach($product as $key =>$pro){
          ?>
        <div class="col-sm-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <img src="<?= $pro->image_url?>" alt="">
              <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
              </a>
            </div>
            <div class="detail-box">
              <h5>
                <?= $pro->name?>
              </h5>
              <div class="product_info">
                <h5>
                  <span>$</span>
                  <?= $pro->price?> 
                </h5>
                <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>  
         <div class="btn_box">
        <a href="" class="view_more-link">
          View More
        </a>
      </div>
    </div>
  </section>