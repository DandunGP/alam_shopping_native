<?php 
    include 'config/database.php';

    function get_data_product($id, $sku){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id AND sku='$sku'");
        $products = mysqli_fetch_assoc($result);
        return $products;
    }

    function related_products($current, $category)
    {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk WHERE id != $current AND category_id = $category LIMIT 4");
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }
?>