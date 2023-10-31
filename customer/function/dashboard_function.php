<?php 
    include '../config/database.php';

    function data_dashboard(){
        global $conn;
        $total_order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_order FROM orders"));
        $total_order_process = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_order FROM orders WHERE order_status = 2"));
        $total_payment = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_payment FROM payments"));
        $total_review =mysqli_fetch_assoc( mysqli_query($conn, "SELECT COUNT(*) AS total_review FROM reviews"));
        $data = array(
            'total_order' => $total_order,
            'total_process' => $total_order_process,
            'total_payment' => $total_payment,
            'total_review' => $total_review
        );

        return $data;
    }
?>