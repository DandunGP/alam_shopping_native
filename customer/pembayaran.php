<?php
    include 'layouts/header.php';

    include 'function/pembayaran_function.php';

    $allPayments = get_all_payment_customer($_SESSION['customer']['id']);

    $itemPerPage = 10;
    $offset = ($pageSekarang - 1) * $itemPerPage;
    $payments = get_limit_payment_customer($itemPerPage, $offset,$_SESSION['customer']['id']);
    $pagination = pagination($pageSekarang, $itemPerPage, count($allPayments));
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-5">
                    <h1>Pembayaran Saya</h1>
                </div>
                <div class="col-sm-2">
                    <a href="tambah_pembayaran.php">Tambah Pembayaran</a>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-body<?php echo ( count($payments) > 0) ? ' p-0' : ''; ?>">
            <?php if ( count($payments) > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-striped m-0">
                        <tr class="bg-primary">
                            <th scope="col">No.</th>
                            <th scope="col">Order</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                        </tr>
                        <?php foreach ($payments as $payment) : ?>
                        <tr>
                            <td><?php echo $payment['id']; ?></td>
                            <td><a href="view_pembayaran.php?id=<?php echo $payment['id'];?>"><?php echo '#' . $payment['order_number']; ?></a></td>
                            <td><?php echo $payment['payment_date']; ?></td>
                            <td><?php echo get_payment_status($payment['payment_status']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else : ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            Belum ada data pembayaran
                        </div>

                        <a href="tambah_pembayaran.php">Tambah Pembayaran</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($pagination) : ?>
            <div class="card-footer">
                <?php echo $pagination; ?> 
            </div>
            <?php endif; ?>

        </div>
    </section>

</div>

<?php
    include 'layouts/footer.php';
?>