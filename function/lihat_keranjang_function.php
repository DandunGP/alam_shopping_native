<?php 
    include 'config/database.php';

    function checkout_save($carts){
        global $conn;

        for($i=0; $i<count($carts); $i++){
            $carts[$i]['qty'] = $_POST['quantity'][$i];
        }

        foreach ($carts as $cr){
            $qtyNew = $cr['qty'];
            $id = $cr['id'];
            mysqli_query($conn, "UPDATE keranjang SET qty = $qtyNew WHERE id=$id");
        }

        echo "
              <script>
                  window.location='checkout.php';
              </script>
              ";
    }

    function get_all_keranjang($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT id, product_id, qty FROM keranjang WHERE user_id = $id GROUP BY product_id");
        $carts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $carts[] = $row;
        }

        return $carts;
    }

    function get_product_by_id($id) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
        $products = mysqli_fetch_assoc($result);
        return $products;
    }

    function get_total_price($id){
        global $conn;
        $total_price = 0;

        $result = mysqli_query($conn, "SELECT id, product_id, qty FROM keranjang WHERE user_id = $id GROUP BY product_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        
        foreach($items as $it){
            global $conn;
            $id_items = $it['product_id'];
            $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id_items");
            $products = mysqli_fetch_assoc($result);
            
            $total_price += $products['price'] * $it['qty'];
        }

        return $total_price;
    }
?>