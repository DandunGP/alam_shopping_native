<?php
    include 'layouts/header.php';

    include 'function/order_function.php';

    $allOrders = get_all_order_customer($_SESSION['customer']['id']);

    $itemPerPage = 10;
    $offset = ($pageSekarang - 1) * $itemPerPage;
    $orders = get_limit_order_customer($itemPerPage, $offset,$_SESSION['customer']['id']);
    $pagination = pagination($pageSekarang, $itemPerPage, count($allOrders));
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-body<?php echo ( count($orders) > 0) ? ' p-0' : ''; ?>">
            <?php if ( count($orders) > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-striped m-0">
                        <tr class="bg-primary">
                            <th scope="col">No.</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jumlah Pesanan</th>
                            <th scope="col">Total Pesanan</th>
                            <th scope="col">Pembayaran</th>
                            <th scope="col">Status</th>
                        </tr>
                        <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><a href="view_order.php?id=<?php echo $order['id'];?>"><?php echo '#' . $order['order_number']; ?></a></td>
                            <td><?php echo $order['order_date']; ?></td>
                            <td><?php echo $order['total_items']; ?> barang</td>
                            <td>Rp <?php echo number_format($order['total_price'],0,'.','.'); ?></td>
                            <td><?php echo ($order['payment_method'] == 1) ? 'Transfer bank' : 'Bayar ditempat'; ?></td>
                            <td><?php echo get_order_status($order['order_status'], $order['payment_method']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else : ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            Belum ada data order.
                        </div>
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