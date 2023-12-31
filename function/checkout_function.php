<?php 
    include 'config/database.php';

    function get_data_customer($id){
        global $conn;

        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users; 
    }

    function get_all_keranjang($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT id, product_id, qty FROM keranjang WHERE user_id = $id GROUP BY product_id");
        $carts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $carts[] = $row;
        }

        $carts = json_encode($carts);
        return $carts;
    }

    function get_total_price($user_id){
        global $conn;
        $total_price = 0;

        $result = mysqli_query($conn, "SELECT id, product_id, qty FROM keranjang WHERE user_id = $user_id GROUP BY product_id");
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

    function createOrderNumber($quantity, $user_id) {
        $alpha = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3));
        $num = mt_rand(100, 999);
        $count_qty = $quantity;
    
        $number = $alpha . date('j') . date('n') . date('y') . $count_qty . $user_id . $num;
    
        return $number;
    }

    function get_total_items($user_id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id=$user_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        $total_item = count($items);

        return $total_item;
    }

    function get_data_product($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
        $products = mysqli_fetch_assoc($result);
        return $products;
    }

    function checkout_order($user_id){
        global $conn;

        $order_number = createOrderNumber(get_total_items($user_id), $user_id);
        $order_date = date('Y-m-d H:i:s');
        $total_price = $_POST['total_price'];
        $total_items = get_total_items($user_id);
        $payment_method = $_POST['payment'];
        $delivery_data = array(
            'customer' => array(
                'name' => $_POST['name'],
                'phone_number' => $_POST['phone_number'],
                'address' => $_POST['address']
            ),
            'note' => $_POST['note']
        );

        $delivery_data = json_encode($delivery_data);

        $query = mysqli_query($conn, "INSERT INTO orders(user_id, order_number, order_status, order_date, total_price, total_items, payment_method, delivery_data) VALUES ($user_id, '$order_number', 1, '$order_date', '$total_price', $total_items, $payment_method, '$delivery_data')");

        // order item input
        if($query){
            $order_id = mysqli_insert_id($conn);
            $items = json_decode($_POST['keranjang']);

            foreach ($items as $it){
                $product = get_data_product($it->product_id);
                $product_id = $it->product_id;
                $qty = $it->qty;
                $order_price = $it->qty * $product['price'];
                mysqli_query($conn, "INSERT INTO order_item(order_id, product_id, order_qty, order_price) VALUES ($order_id, $product_id, $qty, '$order_price')");
                delete_from_carts($it->id);
            }
        }

        echo "
              <script>
                  alert('Berhasil melakukan checkout.');
                  window.location='keranjang.php';
              </script>
              ";
    }
    
    function delete_from_carts($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM keranjang WHERE id=$id");
    }
?>