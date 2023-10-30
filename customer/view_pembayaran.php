<?php
    include 'layouts/header.php';

    include 'function/view_pembayaran_function.php';

    $data = get_data_pembayaran($_GET['id'], $_SESSION['customer']['id']);
    $payment = json_decode($data['payment_data']);
?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pembayaran Order #<?php echo $data['order_number']; ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="pembayaran.php">Pembayaran</a></li>
                            <li class="breadcrumb-item active">Order #<?php echo $data['order_number']; ?></li>
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
                            <h5 class="card-heading">Data Order</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr>
                                    <td>Order</td>
                                    <td>#<b><?php echo $data['order_number']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td><b><?php echo $data['payment_date']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jumlah transfer</td>
                                    <td><b>Rp <?php echo number_format($data['payment_price'],0,'.','.'); ?></b></td>
                                </tr>
                                <tr>
                                    <td>Transfer dari</td>
                                    <td><b><?php echo $payment->source->bank; ?> a.n <?php echo $payment->source->name; ?> (<?php echo $payment->source->number; ?>)</td>
                                </tr>
                                <tr>
                                    <td>Transfer ke</td>
                                    <td><b>
                                        <?php
                                            $transfer_to = get_bank_payment($payment->transfer_to);
                                        ?>
                                        <?php echo $transfer_to['bank']; ?> a.n <?php echo $transfer_to['name']; ?> (<?php echo $transfer_to['number']; ?>)
                                    </b></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><b><?php echo get_payment_status($data['payment_status']); ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h5 class="card-heading">Bukti Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img alt="Pembayaran order #<?php echo $data['order_number']; ?>" class="img img-fluid" src="bukti_pembayaran/<?php echo $data['picture_name']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

<?php
    include 'layouts/footer.php';
?>