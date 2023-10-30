<?php
    include 'layouts/header.php';

    include 'function/produk_detail_function.php';

    $product = get_data_product($_GET['id'], $_GET['sku']);
    $related_products = related_products($product['id'], $product['category_id']);
?>
<div class="hero-wrap hero-bread" style="background-image: url('images/bg1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span>
            <span class="mr-2"><a href="produk.php">Produk</a></span>
            <span><?php echo $product['name']; ?></span></p>
          <h1 class="mb-0 bread"><?php echo $product['name']; ?></h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 mb-5 ftco-animate">
                  <a href="#" class="image-popup"><img src="admin/produk_gambar/<?php echo $product['picture_name'];?>" class="img-fluid" alt="<?php echo $product['name']; ?>"></a>
              </div>
              <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                  <h3><?php echo $product['name']; ?></h3>
                  <p class="price">
                      <span>Rp <?php echo number_format($product['price'],0,'.','.'); ?></span>
                    </p>
                  <p><?php echo $product['descript']; ?></p>
                      <div class="row mt-4">
                          <div class="w-100"></div>
                          <div class="input-group col-md-6 d-flex mb-3">
                   <span class="input-group-btn mr-2">
                      <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                      <ion-icon name="remove"></ion-icon>
                      </button>
                      </span>
                   <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                   <span class="input-group-btn ml-2">
                      <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                      <ion-icon name="add"></ion-icon>
                   </button>
                   </span>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                    <p style="color: #000;">Tersedia <?php echo $product['stock']; ?> <?php echo $product['product_unit']; ?></p>
                </div>
            </div>
            <p><a href="#" class="btn btn-black btn-sm py-3 px-5 add-cart cart-btn" data-sku="<?php echo $product['sku']; ?>" data-name="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>" data-id="<?php echo $product['id']; ?>">Add to Cart</a></p>
              </div>
          </div>
      </div>
  </section>

  <section class="ftco-section">
      <div class="container">
              <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Produk Lain</span>
          <h2 class="mb-4">Produk lain yang terkait</h2>
        </div>
      </div>   		
      </div>
      <div class="container">
          <div class="row">
              <?php if ( count($related_products) > 0) : ?>
                <?php foreach ($related_products as $product) : ?>
              <div class="col-md-6 col-lg-3 ftco-animate">
                  <div class="product">
                      <a href="#" class="img-prod"><img class="img-fluid" src="admin/produk_gambar/<?php echo $product['picture_name'];?>" alt="<?php echo $product['name']; ?>">
                      </a>
                      <div class="text py-3 pb-4 px-3 text-center">
                          <h3><a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>"></a></h3>
                          <div class="d-flex">
                              <div class="pricing">
                                  <p class="price">
                                        <span class="price-sale">Rp <?php echo number_format($product['price'],0,'.','.'); ?>
                              </div>
                          </div>
                          <div class="bottom-area d-flex px-3">
                              <div class="m-auto d-flex">
                              <a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>" class="buy-now d-flex justify-content-center align-items-center text-center">
                                  <span><ion-icon name="menu"></ion-icon></span>
                              </a>
                              <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1" data-sku="<?php echo $product['sku']; ?>" data-name="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>" data-id="<?php echo $product['id']; ?>">
                                  <span><ion-icon name="cart"></ion-icon></span>
                              </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                <?php endforeach; ?>
                <?php endif; ?>
             
          </div>
      </div>
  </section>

  <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);
                    $('.cart-btn').attr('data-qty', quantity + 1);
		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		                $('#quantity').val(quantity - 1);
                        $('.cart-btn').attr('data-qty', quantity - 1);
		            }
		    });
		    
		});
	</script>

<?php
    include 'layouts/footer.php';
?>