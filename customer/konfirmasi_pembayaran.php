<?php
    include 'layouts/header.php';
    include 'function/order_function.php';
    include 'function/konfirmasi_function.php';

    if(!isset($_SESSION['customer']['id'])){
        echo "
                    <script>
                        window.location='../login.php';
                    </script>
                    ";
    }else{
        $orders = get_all_order_customer_status_new($_SESSION['customer']['id']);
        $banks = get_all_bank();
        $payments = get_all_payment_customer_status($_SESSION['customer']['id']);
    }
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konfirmasi Pembayaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="pembayaran.php">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Konfirmasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-heading">Data Pembayaran</h5>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-control-label" for="orders">Order:</label>
                            <?php if ( count($orders) > 0) : ?>
                            <select name="order_id" class="form-control" id="orders">
                                <?php foreach ($orders as $order) : ?>
                                    <option value="<?php echo $order['id']; ?>">#<?php echo $order['order_number']; ?> (Rp <?php echo number_format($order['total_price'], 0, '.', '.'); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <?php else : ?>
                                <div class="text-danger font-weight-bold">Belum ada data order.</div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bank_name" class="form-control-label">Nama bank:</label>
                                    <input type="text" name="bank_name" class="form-control" id="bank_name" required>
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                    <label for="bank_number" class="form-control-label">No. Rekening:</label>
                                    <input type="text" name="bank_number" class="form-control" id="bank_number" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Jumlah Transfer:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="transfer" class="form-control" id="price" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="an" class="form-control-label">Atas nama:</label>
                                    <input type="text" name="name" class="form-control" id="an" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="to">Transfer ke</label>
                            <?php if ( count($banks) > 0) : ?>
                            <select name="bank" class="form-control" id="orders">
                                <?php foreach ($banks as $bank => $data) : ?>
                                    <?php var_dump($bank);?>
                                    <option value="<?php echo $bank; ?>"><?php echo $data['bank']; ?> a.n <?php echo $data['name']; ?> (<?php echo $data['number']; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <?php else : ?>
                                <div class="text-danger font-weight-bold">Belum ada data bank.</div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="pic" class="form-control-label">Bukti pembayaran:</label>
                            <input type="file" name="bukti" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="submit" value="Konfirmasi" name="submit" class="btn btn-primary">
                    </div>
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            confirm_payment();
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card card-header">
                        <h5 class="card-heading">Pembayaran saya</h5>
                    </div>
                    <div class="card-body p-0">
                      <?php if ( count($payments) > 0) : ?>
                        <table class="table table-condensed table-striped">
                          <?php foreach ($payments as $payment) : ?>
                            <tr>
                                <td>#</td>
                                <td>
                                    <a href="view_pembayaran.php?id=<?php $payment['id']?>"><?php echo 'Order #'. $payment['order_number']?></a>
                                </td>
                                <td>
                                  <?php if ($payment['payment_status'] == 1) : ?>
                                    <span class="badge badge-warning text-white">Menunggu konfirmasi</span>
                                  <?php elseif ($payment['payment_status'] == 2) : ?>
                                    <span class="badge badge-success text-white">Dikonfirmasi</span>
                                  <?php elseif ($payment['payment_status'] == 3) : ?>
                                    <span class="badge badge-danger text-white">Gagal mengonfirmasi</span>
                                  <?php endif; ?>
                                </td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      <?php else : ?>
                        <div class="m-3 alert alert-info">Belum ada data pembayaran.</div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
    include 'layouts/footer.php';
?>