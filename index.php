<?php
    include 'layouts/header.php';

    include 'function/home_function.php';

    $data = get_data_store();
    $products = get_all_product();
    $newProduct = get_produk_terbaru();
    $reviews = get_all_review();
?>
<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('images/slide1.jpg');">
        <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-12 ftco-animate text-center">
            <h1 class="mb-2"><?php echo $data[1]['content']?></h1>
            <h2 class="subheading mb-4"><?php echo $data[4]['content']?></h2>
            <p><a href="#products" class="btn btn-danger">Beli Sekarang</a></p>
          </div>

        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url('images/slide2.jpg');">
        <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-sm-12 ftco-animate text-center">
            <h1 class="mb-2"><?php echo $data[1]['content']?></h1>
            <h2 class="subheading mb-4"><?php echo $data[4]['content']?> </h2>
            <p><a href="#products" class="btn btn-danger">Belanja Sekarang</a></p>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

  <section class="ftco-section" id="products">
      <div class="container">
          <div class="row no-gutters ftco-services">
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-shipped"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Gratis Ongkir</h3>
          <span>Belanja minimal Rp 500.000.000</span>
        </div>
      </div>      
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-award"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Kualitas No 1</h3>
          <span>Kualitas Terjamin</span>
        </div>
      </div>    
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-award"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Produk Terbaru</h3>
          <span>Selalu terdapat tanaman keluaran terbaru </span>

          <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="eaa79761-ff7b-4293-8df7-9d66f7b4bfda";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
          
        </div>
      </div>      
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-customer-service"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Bantuan</h3>
          <span>Bantuan Selalu Online</span>
        </div>
      </div>      
    </div>
  </div>
      </div>
  </section>

  <section class="ftco-section">
  <div class="container">
          <div class="row justify-content-center mb-3 pb-3">
    <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading">Produk Terbaru</span>
      <h2 class="mb-4"><a href="#">Aneka Tanaman Alam</a></h2>
      <p><a href="#">Berkualitas Dan Bergaransi</a></p>
    </div>
  </div>   		
  </div>
  <div class="container">
      <div class="row">
          <?php if ( count($products) > 0) : ?>
            <?php foreach ($products as $product) : ?>
          <div class="col-md-6 col-lg-3 ftco-animate">
              <div class="product">
                  <a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>" class="img-prod">
                    <div class="justify-content">
                      <div class="image-fix">
                        <img class="img-fluid" src="admin/produk_gambar/<?php echo $product['picture_name']?>" alt="<?php echo $product['name']; ?>">
                      </div>
                    </div>
                  </a>
                  <div class="text py-3 pb-4 px-3 text-center">
                      <h3><a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>"><?php echo $product['name']; ?></a></h3>
                      <div class="d-flex">
                          <div class="pricing">
                              <p class="price">
                                    <span class="mr-2"><span class="price-sale">Rp <?php echo number_format($product['price'],0,'.','.'); ?></span>
                                </p>
                          </div>
                      </div>
                      <div class="bottom-area d-flex px-3">
                          <div class="m-auto d-flex">
                              <a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>" class="buy-now d-flex justify-content-center align-items-center text-center">
                                  <span><ion-icon name="menu"></ion-icon></span>
                              </a>
                              <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1" data-id="<?php echo $product['id']; ?>">
                                  <span><ion-icon name="cart"></ion-icon></span>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
            <?php endforeach; ?>
          <?php else : ?>
          <?php endif; ?>

      </div>
  </div>
</section>
  
  <section class="ftco-section img" style="background-image: url('images/bg6.jpg');">
  <div class="container">
          <div class="row justify-content-end">
    <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
        <span class="subheading">Produk Paling Baru</span>
      <h2 class="mb-4">Produk keluaran terbaru dengan kualitas lebih</h2>
      <p><?php echo $newProduct['descript']; ?></p>
      <h3><a href="#"><?php echo $newProduct['name']; ?></a></h3>
      <span class="price">Rp <?php echo number_format($newProduct['price'],0,'.','.'); ?> <a href="#">sekarang hanya Rp <?php echo number_format($newProduct['price'],0,'.','.'); ?></a></span>
      <div id="timer" class="d-flex mt-5">
        <div class="time pl-3">
          <a href="#" class="btn btn-primary add-cart" data-sku="<?php echo $newProduct['sku']; ?>" data-name="<?php echo $newProduct['name']; ?>" data-price="<?php echo $newProduct['price']; ?>" data-id="<?php echo $newProduct['id']; ?>"><ion-icon name="cart"></ion-icon></a>
        </div>
        <div class="time pl-3">
          <a class="btn btn-info" href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>" class="buy-now d-flex justify-content-center align-items-center text-center">
            <span><ion-icon name="menu" class="text-white"></ion-icon></span>
          </a>
        </div>
      </div>
    </div>
  </div>   		
  </div>
</section>

<section class="ftco-section testimony-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section ftco-animate text-center">
            <span class="subheading">Testimony</span>
          <h2 class="mb-4">Apa yang pelanggan kami katakan?</h2>
        </div>
      </div>
      <div class="row ftco-animate">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel">
            <?php if ( count($reviews) > 0) : ?>
            <?php foreach ($reviews as $review) : ?>
            <div class="item">
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(<?php echo 'customer/customer_gambar/'. $review['profile_picture']; ?>)">
                </div>
                <div class="text text-center">
                  <p class="mb-5 pl-4 line"><?php echo $review['review_text']; ?></p>
                  <p class="name"><?php echo $review['name']; ?></p>
                  <span class="position"><?php echo get_formatted_date($review['review_date']); ?></span>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </section>

  <?php 
    include 'layouts/footer.php';
  ?>