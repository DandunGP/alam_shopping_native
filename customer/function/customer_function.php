<?php 
    include '../config/database.php';

    function get_customer_data($id){
        global $conn;

        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users;
    }
?>