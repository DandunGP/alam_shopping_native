<?php
    include 'layouts/header.php';

    include 'function/view_review_function.php';
    $review = get_data_review($_GET['id']);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Review Order #<?php echo $review['order_number']; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="review.php">Review</a></li>
                        <li class="breadcrumb-item active">Order #<?php echo $review['order_number']; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
     <div class="row">
      <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-body p-0">
                <table class="table table-hover table-striped">
                    <tr>
                        <td>Judul</td>
                        <td><b><?php echo $review['title']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Order</td>
                        <td><b>#<?php echo $review['order_number']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><b><?php echo $review['review_date']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Review</td>
                        <td><b><?php echo $review['review_text']; ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center">
            <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                <i class="fa fa-trash"></i> Hapus
            </a>
        </div>
      </div>
     </div>
    </section>

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletelModalLabel">Hapus Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="deleteText">Anda yakin ingin menghapus review?</p>
      </div>
      <div class="modal-footer">
        <form action="" method="post">
            <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
        </form>
        <?php
            if(isset($_POST['delete'])){
                delete_review($review['reviews_id'], $_SESSION['customer']['id']);
            }
         ?>
      </div>
    </div>
  </div>
</div>

<?php
    include 'layouts/footer.php';
?>