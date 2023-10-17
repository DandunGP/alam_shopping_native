<?php 
    include "../../config/database.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    }else{
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    switch ($action) {
        case 'list':
            $pelanggan = get_all_pelanggan();
            $response = array('data' => $pelanggan);
            break;
        case 'delete_category':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            delete_category($id);
            $response = array('code' => 204, 'message' => 'Pelanggan berhasil dihapus!');
            break;
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    function get_all_pelanggan() {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM users");
        $pelanggan = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pelanggan[] = $row;
        }
        return $pelanggan;
    }

    function delete_category($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    }

?>

