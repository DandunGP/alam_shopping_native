<?php 
    include '../config/database.php';

    function data_dashboard(){
        global $conn;
        $total_product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_product FROM produk"));
        $total_customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_customer FROM users WHERE role = 'Customer'"));
        $total_order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_order FROM orders"));
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE order_status = 4");

        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        
        $total_income = 0;

        foreach ($orders as $or){
            $total_income += $or['total_price'];
        }

        $data = array(
            'total_product' => $total_product,
            'total_customer' => $total_customer,
            'total_order' => $total_order,
            'total_income' => $total_income
        );

        return $data;
    }
?>