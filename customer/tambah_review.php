<?php
    include 'layouts/header.php';

    include 'function/add_review_function.php';

    $orders = get_all_order_finished($_SESSION['customer']['id']);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tulis Review</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="review.php">Review</a></li>
                        <li class="breadcrumb-item active">Tulis Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <form action="" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label for="title" class="form-control-label">Judul Review</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>

                <div class="form-group">
                    <label for="orders" class="form-control-label">Order:</label>
                    <select name="order_id" class="form-control" id="orders">
                        <?php if ( count($orders) > 0) : ?>
                        <?php foreach ($orders as $order) : ?>
                        <option value="<?php echo $order['id']; ?>">#<?php echo $order['order_number']; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="review" class="form-control-label">Review</label>
                    <textarea name="review" class="form-control" id="review" required></textarea>
                </div>

            </div>
            <div class="card-footer">
                <input type="submit" name="submit" value="Tulis Review" class="btn btn-primary">
            </div>
            </form>
            <?php 
                if(isset($_POST['submit'])){
                    add_review();
                }
            ?>
        </div>
    </section>

</div>

<?php
    include 'layouts/footer.php';
?>