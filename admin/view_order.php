<?php
    include 'layouts/header.php';

    include 'function/view_order_function.php';

    $data = get_data_order_by_id($_GET['id']);
    $items = get_data_items_order($data['id']);
    $payment = get_data_payment_by_order_id($data['id']);
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Order #<?php echo $data['order_number']; ?></h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="order.php">Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#<?php echo $data['order_number']; ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">

      <div class="row">
        <div class="col-md-8">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Data Produk</h3>
              </div>
        
              <div class="card-body p-0">
                <table class="table align-items-center table-flush table-striped">
                    <tr>
                        <td>Nomor</td>
                        <td><b>#<?php echo $data['order_number']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><b><?php echo $data['order_date']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Item</td>
                        <td><b><?php echo $data['total_items']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><b>Rp <?php echo number_format($data['total_price'], 0, '.', '.'); ?></b></td>
                    </tr>
                    <tr>
                        <td>Metode pembayaran</td>
                        <td><b><?php echo ($data['payment_method'] == 1) ? 'Transfer bank' : 'Bayar ditempat'; ?></b></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><b class="statusField"><?php echo get_order_status($data['order_status'], $data['payment_method']); ?></b></td>
                    </tr>
                </table>
              </div>
              <div class="card-footer">
                <form action="" method="POST">
                <input type="hidden" name="order" value="<?php echo $data['id']; ?>">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <?php if ($data['payment_method'] == 1) : ?>
                        <select class="form-control" id="status" name="status">
                          <option value="2"<?php echo ($data['order_status'] == 2) ? ' selected' : ''; ?>>Dalam proses</option>
                          <option value="3"<?php echo ($data['order_status'] == 3) ? ' selected' : ''; ?>>Dalam pengiriman</option>
                          <option value="4"<?php echo ($data['order_status'] == 4) ? ' selected' : ''; ?>>Selesai</option>
                          <option value="5"<?php echo ($data['order_status'] == 5) ? ' selected' : ''; ?>>Batalkan</option>
                        </select>
                        <?php else : ?>
                        <select class="form-control" id="status" name="status">
                          <option value="1"<?php echo ($data['order_status'] == 1) ? ' selected' : ''; ?>>Dalam proses</option>
                          <option value="2"<?php echo ($data['order_status'] == 2) ? ' selected' : ''; ?>>Dalam pengiriman</option>
                          <option value="3"<?php echo ($data['order_status'] == 3) ? ' selected' : ''; ?>>Selesai</option>
                          <option value="4"<?php echo ($data['order_status'] == 4) ? ' selected' : ''; ?>>Batalkan</option>
                        </select>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="text-right">
                        <input type="submit" value="OK" name="payment_submit" class="btn btn-md btn-primary">
                      </div>
                    </div>
                  </div>
                </form>
                <?php 
                    if(isset($_POST['payment_submit'])){
                        update_status_order($data['id'], $_POST['status']);
                    }
                ?>
              </div>
            </div>
            
            <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="mb-0">Barang dalam pesanan</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah beli</th>
                                <th scope="col">Harga satuan</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($items as $item) : ?>
                            <tr>
                                <td>
                                    <img class="img img-fluid rounded" style="width: 60px; height: 60px;" alt="<?php echo $item['name']; ?>" src="produk_gambar/<?php echo $item['picture_name']; ?>">
                                </td>
                                <td>
                                    <h5 class="mb-0"><?php echo $item['name']; ?></h5>
                                </td>
                                <td><?php echo $item['order_qty']; ?></td>
                                <td>Rp <?php echo number_format($item['order_price'], 0, '.', '.'); ?></td>
                            </tr>
                          <?php endforeach; ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            
          </div>

        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="mb-0">Data Penerima</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table align-items-center table-flush table-hover">
                    <?php $customer = json_decode($data['delivery_data'], true);?>
                        <tr>
                            <td>Nama</td>
                            <td><b><?php echo $customer['customer']['name']; ?></b></td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td><b><?php echo $customer['customer']['phone_number']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><b><?php echo $customer['customer']['address']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><b><?php echo $customer['note']; ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>

                <div class="card card-primary" id="#payments">
                    <div class="card-header">
                        <h3 class="mb-0">Pembayaran</h3>
                    </div>
                    <div class="card-body <?php echo ($data['payment_method'] == 1) ? 'p-0' : ''; ?>">
                        <?php if ($payment == NULL) : ?>
                      <div class="alert alert-info m-2">Tidak ada data pembayaran.</div>
                      <?php else : ?>

                        <div>
                            <img class="img img-fluid" src="../customer/bukti_pembayaran/<?php echo $payment['picture_name']; ?>">
                        </div>
                        
                        <table class="table align-items-center table-flush table-hover">
                            <tr>
                                <td>Transfer</td>
                                <td><b>Rp <?php echo number_format($payment['payment_price'], 0, '.', '.'); ?></b></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td><b><?php echo $payment['payment_date']; ?></b></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><b>
                                  <?php if ($payment['payment_status'] == 1) : ?>
                                    <span class="badge badge-info">Menunggu konfirmasi</span>
                                  <?php elseif ($payment['payment_status'] == 2) : ?>
                                    <span class="badge badge-success">Dikonfirmasi</span>
                                  <?php elseif ($payment['payment_status'] == 3) : ?>
                                    <span class="badge badge-danger">Gagal</span>
                                  <?php endif; ?>
                                </b></td>
                            </tr>
                            <tr>
                                <td>Transfer ke</td>
                                <td><div style="white-space: initial;"><b>
                                    <?php
                                        $bank_data = json_decode($payment['payment_data']);
                                        $bank_data  = (Array) $bank_data;
                                        
                                        $transfer_to = get_bank_payment($bank_data['transfer_to']);
                                    ?>
                                    <?php echo $transfer_to['bank']; ?> a.n <?php echo $transfer_to['name']; ?> (<?php echo $transfer_to['number']; ?>)
                                </b></div></td>
                            </tr>
                            <tr>
                                <td>Transfer dari</td>
                                <td><div style="white-space: initial;">
                                <b><?php echo $bank_data['source']->bank; ?> a.n <?php echo $bank_data['source']->name; ?> (<?php echo $bank_data['source']->number; ?>)</b>
                                </div></td>
                            </tr>
                        </table>
                      <?php endif; ?>
                    </div>
                    <?php if ($payment != NULL) : ?>
                    <div class="card-footer">
                        <form action="" method="POST">
                        <div class="row">
                          <input type="hidden" name="id" value="<?php echo $payment['id']; ?>">
                          <input type="hidden" name="order" value="<?php echo $data['id']; ?>">
                            <div class="col-md-9">
                                <select class="form-control" name="action">
                                  <?php if ($data['payment_status'] == 1) : ?>
                                    <option value="1">Konfirmasi Pembayaran</option>
                                    <option value="2">Pembayaran Tidak Ada</option>
                                  <?php else : ?>
                                    <option value="4" readonly>Tidak ada pilihan</option>
                                  <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3 text-right">
                                <input type="submit" class="btn btn-primary" value="OK">
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
        </div>
      </div>

<?php
    include 'layouts/footer.php';
?>