<?php 
    include '../config/database.php';

    function get_all_order_finished($idCustomer){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $idCustomer AND order_status=4");
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }

        return $orders;
    }

    function add_review(){
        global $conn;
        $title = $_POST['title'];
        $order_id = $_POST['order_id'];
        $review = $_POST['review'];
        $user_id = $_SESSION['customer']['id'];
        $review_date = date('Y-m-d H:i:s');

        $query = mysqli_query($conn, "insert into reviews(user_id, order_id, title, review_text, review_date, status) values 
                                            ($user_id, $order_id, '$title', '$review', '$review_date', 1)");

        if($query){
            echo "
                <script>
                    alert('Review berhasil di tambahkan');
                    window.location='review.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Review gagal ditambahkan');
                </script>
                ";
        }
    }
?>