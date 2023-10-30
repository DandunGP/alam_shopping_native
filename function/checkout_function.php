<?php 
    include 'config/database.php';

    function get_data_customer($id){
        global $conn;

        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users; 
    }
?>