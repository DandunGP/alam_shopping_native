<?php
    include 'layouts/header.php';

    include 'function/profile_function.php';
?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
               

                <h3 class="profile-username text-center"><?php echo $user['name']; ?></h3>
                <p class="text-muted text-center"><?php echo $user['username']; ?> | <?php echo $user['email']; ?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link profil active" href="#profile" data-toggle="tab">Profil</a></li>
                  <li class="nav-item"><a class="nav-link akun " href="#akun" data-toggle="tab">Akun</a></li>
                  <li class="nav-item"><a class="nav-link email" href="#email" data-toggle="tab">Email</a></li>
                  <li class="nav-item"><a class="nav-link logout btn btn-danger btn-sm text-white font-weight-bold ml-2" href="logout.php">Log Out</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profile">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $user['name']; ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputHP" class="col-sm-2 col-form-label">No. HP:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputHP" name="no_hp" value="<?php echo $user['no_hp']; ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputAddr" class="col-sm-2 col-form-label">Alamat:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputAddr" name="alamat" value="<?php echo $user['alamat']; ?>" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputFoto" class="col-sm-2 col-form-label">Foto profil:</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="inputFoto" name="file">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="update_profile" class="btn btn-danger">Ganti Nama</button>
                        </div>
                      </div>
                    </form>
                    <?php 
                        if(isset($_POST['update_profile'])){
                            update_profile($user['id']);
                        }
                    ?>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="akun">
                    <form action="" method="post">
                    <div class="form-group row">
                        <label for="inputUserName" class="col-sm-2 col-form-label">Username:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputUserName" name="username" value="<?php echo $user['username']; ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Masukkan password baru untuk mengganti. Kosongkan jika tidak ingin mengganti">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="update_username" class="btn btn-danger">Perbarui</button>
                        </div>
                      </div>
                    </form>
                    <?php 
                        if(isset($_POST['update_username'])){
                            update_username($user['id']);
                        }
                    ?>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="email">
                    <form action="" method="post">
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="update_email" class="btn btn-danger">Perbarui</button>
                        </div>
                      </div>
                    </form>
                    <?php 
                        if(isset($_POST['update_email'])){
                            update_email($user['id']);
                        }
                    ?>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <?php
    include 'layouts/footer.php';
?>