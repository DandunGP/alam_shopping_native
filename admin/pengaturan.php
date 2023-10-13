<?php
    include 'layouts/header.php';
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Pengaturan Situs</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <form action="" method="post" enctype="multipart/form-data">

      <div class="row">
        <div class="col-md-8">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Identitas Toko</h3>
              </div>
        
              <div class="card-body">

                <div class="form-group">
                  <label class="form-control-label" for="name">Nama toko:</label>
                  <input type="text" name="store_name" value="Gerai Handphone Samsung" class="form-control" id="name">
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-control-label" for="phone_number">No. HP:</label>
                      <input type="text" name="store_phone_number" value="081382055381" class="form-control" id="phone_number">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-control-label" for="email">Email:</label>
                      <input type="text" name="store_email" value="muhamadroin81@gmail.com" class="form-control" id="email">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="address">Alamat:</label>
                  <textarea name="store_address" class="form-control" id="address"><?php echo "'"?></textarea>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="tagline">Tagline:</label>
                  <input type="text" name="store_tagline" value="Produk Terjamin dan bergaransi" class="form-control" id="tagline">
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="description">Deskripsi:</label>
                  <textarea name="store_description" class="form-control" id="description">Kami menyediakan Produk terbaru dari samsung</textarea>
                </div>
              
              </div>
              
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Pengaturan Pembayaran</h3>
                <button type="button" class="btn btn-outline-primary btn-add float-right btn-sm" style="margin-top: -30px;"><i class="fas fa-plus-square"></i></button>
              </div>
              <div class="card-body">
              <?php if ( is_array($banks) && count($banks) > 0) : ?>
                <?php $n = 0; ?>
                <div class="increment">
              <?php foreach ($banks as $bank) : ?>
                
                <div class="row alert alert-info">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Nama bank:</label>
                      <input type="text" class="form-control" name="banks[<?php echo $n; ?>][bank]" value="<?php echo $bankp['bank']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <label for="">No. Rekening:</label>
                    <input type="text" class="form-control" name="banks[<?php echo $n; ?>][number]" value="<?php echo $bank['number']; ?>">
                  </div>
                  <div class="col-6">
                    <label for="">Nama pemilik:</label>
                    <input type="text" class="form-control" name="banks[<?php echo $n; ?>][name]" value="samsung jakarta">
                  </div>
                </div>
              
              <?php $n++; ?>
              <?php endforeach; ?>
              </div>
              <?php else : ?>
              <div class="alert alert-info alert-zero">Belum ada data bank yang ditambahkan. Tambahkan yang pertama!</div>
              <div class="increment">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Nama bank:</label>
                      <input type="text" class="form-control" name="banks[0][bank]">
                    </div>
                  </div>
                  <div class="col-6">
                    <label for="">No. Rekening:</label>
                    <input type="text" class="form-control" name="banks[0][number]">
                  </div>
                  <div class="col-6">
                    <label for="">Nama pemilik:</label>
                    <input type="text" class="form-control" name="banks[0][name]">
                  </div>
                </div>
              </div>

              <?php endif; ?>
              </div>
              <div class="card-footer">
                
              </div>
            </div>
            
          </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Logo</h3>
                </div>
                <div class="card-body">
                   <div class="form-group">
                     <label class="form-control-label" for="pic">Foto:</label>
                     <input type="file" name="picture" class="form-control" id="pic">
                     <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                   </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Belanja</h3>
                </div>
                <div class="card-body">
                <div class="form-group">
                     <label class="form-control-label" for="ongkir">Ongkos kirim:</label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="text" name="shipping_cost" value="<?php echo set_value('shipping_cost', get_settings('shipping_cost')); ?>" class="form-control" id="ongkir">
                     </div>
                   </div>

                   <div class="form-group">
                     <label class="form-control-label" for="free_ongkir">Minimal belanja untuk gratis ongkir:</label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="text" name="min_shop_to_free_shipping_cost" value="<?php echo set_value('min_shop_to_free_shipping_cost', get_settings('min_shop_to_free_shipping_cost')); ?>" class="form-control" id="free_ongkir">
                     </div> 
                   </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </div>

        </div>
      </div>

    </form>

    <script>
      jQuery(document).ready(function () {
            let no = 0;
            jQuery(".btn-add").click(function () {
                no = no + 1;
                let markup = `<div class="row alert alert-success m-1">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Nama bank:</label>
                      <input type="text" class="form-control" name="banks[${no}][bank]">
                    </div>
                  </div>
                  <div class="col-6">
                    <label for="">No. Rekening:</label>
                    <input type="text" class="form-control" name="banks[${no}][number]">
                  </div>
                  <div class="col-6">
                    <label for="">Nama pemilik:</label>
                    <input type="text" class="form-control" name="banks[${no}][name]">
                  </div>
                </div>`
                jQuery(".increment").append(markup);

                let zero = $('.alert-zero');
                if (zero.length > 0) {
                  zero.hide('fade');
                }
            });
            jQuery("body").on("click", ".btn-remove", function () {
                jQuery(this).parents(".input-group").remove();

                let zero = $('.alert-zero');
                if (zero.length > 0) {
                  zero.show('fade')
                }
            })
        })
    </script>

<?php
    include 'layouts/footer.php';
?>