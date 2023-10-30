<?php
session_start();

include '../config/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = isset($_POST['action']) ? $_POST['action'] : '';
}else{
    $action = isset($_GET['action']) ? $_GET['action'] : '';
}

switch ($action) {
    case 'add_item':
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $user_id = $_SESSION['customer']['id'];

        add_cart($id, $qty, $user_id);
        $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id=$user_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        $total_item = count($items);

        $response = array('code' => 200, 'message' => 'Item dimasukkan dalam keranjang', 'total_item' => $total_item);
        break;
    case 'display_cart':
        $carts = [];

        foreach ($this->cart->contents() as $items) {
            $carts[$items['rowid']]['id'] = $items['id'];
            $carts[$items['rowid']]['name'] = $items['name'];
            $carts[$items['rowid']]['qty'] = $items['qty'];
            $carts[$items['rowid']]['price'] = $items['price'];
            $carts[$items['rowid']]['subtotal'] = $items['subtotal'];
        }

        $response = array('code' => 200, 'carts' => $carts);
        break;
    case 'cart_info':
        $user_id = $_SESSION['customer']['id'];
        
        // $total_price = $this->cart->total();
        $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id=$user_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        $total_item = count($items);

        // $data['total_price'] = $total_price;
        $data['total_item'] = $total_item;

        $response['data'] = $data;
        break;
    case 'remove_item':
        $user_id = $_SESSION['customer']['id'];
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        delete_cart($id, $user_id);

        $total_price = 0;

        $result = mysqli_query($conn, "SELECT id, product_id, SUM(qty) AS total_qty FROM keranjang WHERE user_id = $user_id GROUP BY product_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        
        foreach($items as $it){
            global $conn;
            $id_items = $it['product_id'];
            $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id_items");
            $products = mysqli_fetch_assoc($result);
            
            $total_price += $products['price'] * $it['total_qty'];
        }

        $data['code'] = 204;
        $data['message'] = 'Item dihapus dari keranjang';
        $data['total']= 'Rp ' . number_format($total_price);
        $data['id'] = $id;
        $data['user_id'] = $user_id;

        $response = $data;
        break;
}

$response = json_encode($response);
header('Content-Type: application/json');
echo $response;


function add_cart($id, $qty, $user_id) {
    global $conn;
    mysqli_query($conn, "INSERT INTO keranjang(product_id, qty, user_id) VALUES ($id, $qty, $user_id)");
}

function delete_cart($id, $user_id){
    global $conn;
    mysqli_query($conn, "DELETE FROM keranjang WHERE product_id=$id AND user_id=$user_id");
}

?>