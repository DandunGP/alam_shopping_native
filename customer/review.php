<?php
    include 'layouts/header.php';

    include 'function/review_function.php';

    $allReview = get_all_review($_SESSION['customer']['id']);

    $itemPerPage = 10;
    $offset = ($pageSekarang - 1) * $itemPerPage;
    $reviews = get_limit_review_customer($itemPerPage, $offset,$_SESSION['customer']['id']);
    $pagination = pagination($pageSekarang, $itemPerPage, count($allReview));
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Review Saya</h1>
                </div>
                <div class="col-sm-1"> 
                    <a href="tambah_review.php">Tulis Review Baru</a>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-body<?php echo ( count($reviews) > 0) ? ' p-0' : ''; ?>">
            <?php if ( count($reviews) > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-striped m-0">
                        <tr class="bg-primary">
                            <th scope="col">No.</th>
                            <th scope="col">Order</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Review</th>
                        </tr>
                        <?php foreach ($reviews as $review) : ?>
                            <?php $order = get_order_by_id($review['order_id']);?>
                        <tr>
                            <td><?php echo $review['id']; ?></td>
                            <td><?php 
                                if(isset($order['id'])){
                            ?><a href="view_review.php?id=<?php echo $review['id'];?>"><?php echo '#'. $order['order_number'];?></a>
                            <?php 
                                }else{
                            ?>Data Order Sudah Dihapus
                            <?php
                                }
                            ?>
                                </td>
                            <td><?php echo $review['review_date']; ?></td>
                            <td><?php echo $review['review_text']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else : ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            Belum ada review yang ditulis. Silahkan tulis baru.
                        </div>

                        <a href="tambah_review.php">Tulis Review Baru</a>
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