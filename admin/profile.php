<?php
    include 'layouts/header.php';

?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Profil Saya</h6>
              </div>
              <div class="col-lg-6 col-5 text-right">
                  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="pengaturan.php">Pengaturan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
                  <h3 class="mb-0">Identitas</h3>
                </div>
          
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nama:</label>
                                <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" id="name" minlength="4" maxlength="255" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Email:</label>
                                <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" id="email" minlength="10" maxlength="255" required>
                            </div>
                        </div>
                    </div>
                 
                    
  
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="username">Username:</label>
                            <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control" id="username" minlength="4" maxlength="16" required>
                        </div>
                        
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="form-control-label" for="password">Password:</label>
                              <input type="password" name="password" value="" class="form-control" id="password" minlength="4" maxlength="100">
                              <p class="text-muted"><small>Kosongkan password jika tidak ingin mengganti</small></p>
                          </div>
                      </div>
                    </div>
  
                    
  
                </div>
                
              </div>
            </div>
  
            <div class="card">
              <div class="card-body  d-none d-md-block">
                <input type="submit" class="btn btn-primary float-right" value="Simpan" name="submit">
              </div>
            </div>
  
          </div>
          <div class="col-md-4">
            <div class="card card-profile">
                <?php if($user['profile_picture'] != null) {?>
                    <img src="admin_gambar/<?php echo $user['profile_picture'] ?>" alt="<?php echo $user['name']; ?>" class="card-img-top">
                <?php }else{?>
                    <p style="text-align: center; margin-top:10px;"></p>
                <?php }?>
                <div class="row justify-content-center">
                  <div class="col-lg-6 order-lg-2">
                    <div class="card-profile-image">
                      <a href="#" class="changeProfile">
                      <?php if($user['profile_picture'] != null) {?>
                            <img src="admin_gambar/<?php echo $user['profile_picture'] ?>" alt="<?php echo $user['name']; ?>" class="card-img-top">
                        <?php }else{?>
                                <div class="form-group">
                                    <label class="form-control-label" for="pic">Foto:</label>
                                    <input type="file" name="picture" class="form-control" id="pic">
                                    <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                                </div>
                        <?php }?>
                      </a>
                    </div>
                  </div>
                </div>
                
                <div class="card-body pt-0" style="margin-top: 80px">
                  
                  <div class="text-center">
                    <h5 class="h3">
                        <?php echo $user['name'] ?>
                    </h5>
                    <div class="h5 mt-4">
                      <i class="fa fa-at mr-2"></i><?php echo $user['email']; ?>
                    </div>
                  </div>
                </div>
              </div>
  
          </div>
        </div>
        <input type="file" id="fileSelect" name="picture" class="d-none">
      </form>

      <?php 
        if(isset($_POST['submit'])){
            change_profile($user['id'], $user['password']);
        }
      ?>

<script>
$('.changeProfile').click(function(e) {
    $('#fileSelect').click();
})
</script>
<?php
    include 'layouts/footer.php';
?>