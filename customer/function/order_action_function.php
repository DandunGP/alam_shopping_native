<?php 
    include '../../config/database.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    }else{
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    switch ($action) {
        case 'cancel_order':
            $id = $_POST['id'];
            $data = get_data_order($id);
            if ( ($data['payment_method'] == 1 && $data['order_status'] == 1))
            {
                cancel_order($id);
                $response = array('code' => 200, 'success' => TRUE, 'message' => 'Order dibatalkan');
            }
            else
            {
                $response = array('code' => 200, 'error' => TRUE, 'message' => 'Order tidak dapat dibatalkan');
            }
        break;
        case 'delete_order':
            $id = $_POST['id'];
            $data = get_data_order($id);

            if ( ($data['payment_method'] == 1 && ($data['order_status'] == 5 || $data['order_status'] == 4)))
            {
                delete_order($id);
                $response = array('code' => 200, 'success' => TRUE, 'message' => 'Order dihapus');
            }
            else
            {
                $response = array('code' => 200, 'error' => TRUE, 'message' => 'Order tidak dapat dihapus');
            }
        break;
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    function get_data_order($id) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE id=$id");
        $order = mysqli_fetch_assoc($result);

        return $order;
    }

    function cancel_order($id) {
        global $conn;
        mysqli_query($conn, "UPDATE orders set order_status=5 WHERE id=$id");
    }

    function delete_order($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM orders WHERE id=$id");
    }
?>