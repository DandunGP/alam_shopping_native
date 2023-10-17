<?php
    include 'layouts/header.php';

    include 'function/produk_function.php';

    $product = get_product_by_id($_GET['id']);
    $categories = get_all_categories();
?>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Edit Produk</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="admin.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
                  <li class="breadcrumb-item"><a href="view_produk.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
      <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

      <div class="row">
        <div class="col-md-8">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Data Produk</h3>
              </div>
        
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="pakcage">Kategori:</label>
                      <select name="category_id" class="form-control" id="package">
                        <option>Pilih kategori</option>
                        <?php if ( count($categories) > 0) : ?>
                          <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>" <?php if($product['category_id'] == $category['id']){echo 'selected';}?>>› <?php echo $category['nama']; ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                  </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="name">Nama produk:</label>
                  <input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control" id="name">
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-control-label" for="price">Harga:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="price" value="<?php echo $product['price']; ?>" class="form-control" id="price">
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                  <div class="form-group">
                  <label class="form-control-label" for="price_d">Diskon:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" name="price_discount" value="<?php echo $product['current_discount'] ?>" class="form-control" id="price_d">
                  </div>
                </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-control-label" for="stock">Stok:</label>
                      <input type="text" name="stock" value="<?php echo $product['stock']?>" class="form-control" id="stock">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-control-label" for="unit">Satuan:</label>
                      <input type="text" name="unit" value="<?php echo $product['product_unit']; ?>" class="form-control" id="unit">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="desc">Deskripsi:</label>
                  <textarea name="descript" class="form-control" id="descript"><?php echo $product['descript']; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="av" class="form-control-label">
                    <input type="checkbox" id="av" name="is_available" value="1"> Apakah produk ini tersedia?
                  </label>
                </div>
              
              </div>
              
            </div>
            
          </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="mb-0">Foto</h3>
                        </div>
                        <?php if ($product['picture_name']) : ?>
                        <div class="col-8">
                            <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-1 active" id="pills-current-tab" data-toggle="pill" href="#pills-current" role="tab" aria-controls="pills-home" aria-selected="true">Current</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-1" id="pills-edit-tab" data-toggle="pill" href="#pills-edit" role="tab" aria-controls="pills-profile" aria-selected="false">Ganti</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-1" id="pills-delete-tab" data-toggle="pill" href="#pills-delete" role="tab" aria-controls="pills-contact" aria-selected="false">Hapus</a>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($product['picture_name'] != NULL) : ?>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-current" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="text-center">
                                <img alt="<?php echo $product['name']; ?>" src="<?php echo 'produk_gambar/' . $product['picture_name']; ?>" class="img img-fluid rounded">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="form-group">
                                <label class="form-control-label" for="pic">Foto:</label>
                                <input type="file" name="picture" class="form-control" id="pic">
                                <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                                <small class="newUploadText">Unggah file baru untuk mengganti foto saat ini.</small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-delete" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <p class="deleteText">Klik link dibawah untuk menghapus foto. Tindakan ini tidak dapat dibatalkan.</p>
                            <div class="text-right">
                                <a href="#" class="deletePictureBtn btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="form-group">
                        <label class="form-control-label" for="pic">Foto:</label>
                        <input type="file" name="picture" class="form-control" id="pic">
                        <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-right">
                    <input type="submit" value="Simpan" name="submit" class="btn btn-primary">
                </div>
            </div>
        </div>
      </div>

    </form>
    <?php 
        if(isset($_POST['submit'])){
            edit_product($_GET['id']);
        }
    ?>
    
    <script>
        $('.deletePictureBtn').click(function(e) {
            e.preventDefault();

            $(this).html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

            $.ajax({
                method: 'POST',
                url: 'function/produk_delete.php',
                data: {
                    id: <?php echo $product['id']; ?>,
                    action: 'delete_image'
                },
                context: this,
                success: function(res) {
                    if (res.code == 204) {
                        $('.deleteText').text('Gambar berhasil dihapus. Produk ini akan menggunakan gambar default jika tidak ada gambar baru yang diunggah');
                        $(this).html('<i class="fa fa-check"></i> Terhapus!');

                        setTimeout(function() {
                            $('.newUploadText').text('Pilih gambar baru untuk mengganti gambar yang dihapus');
                            $('#pills-delete, #pills-delete-tab, #pills-current, #pills-current-tab').hide('fade');
                            $('#pills-edit').tab('show');
                            $('#pills-edit-tab').addClass('active').text('Upload baru');
                        }, 3000);
                    }
                    else {
                        console.log('Terdapat kesalahan');
                    }
                }
            })
        });
    </script>

<?php
    include 'layouts/footer.php';
?>