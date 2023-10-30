<?php
    include 'layouts/header.php';

    include 'function/home_function.php';

    $data = get_data_store();
    $reviews = get_all_review();
?>
<div class="hero-wrap hero-bread" style="background-image: url('images/about.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Tentang Kami</span></p>
          <h1 class="mb-0 bread">Tentang Kami</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
          <div class="container">
              <div class="row">
                  <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url('images/about2.png');">
                     
                  </div>
                  <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
            <div class="heading-section-bold mb-4 mt-md-5">
                <div class="ml-md-0">
                  <h2 class="mb-4">Selamat Datang <a href="#">Karya Taman Alam</a></h2>
              </div>
            </div>
            <div class="pb-md-5">
                <p><?php echo $data[7]['content']?></p>
                          <p><a href="produk.php" class="btn btn-danger">Belanja sekarang!</a></p>
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
  
  