<?php 

include "../config/database.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = isset($_POST['action']) ? $_POST['action'] : '';
}else{
    $action = isset($_GET['action']) ? $_GET['action'] : '';
}

 switch ($action) {
        case 'delete_product':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            delete_product($id);
            $response = array('code' => 204, 'message' => 'Product berhasil dihapus!');
            break;
        case 'delete_image':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            delete_image($id);
            $response = array('code' => 204, 'message' => 'Gambar berhasil dihapus');
            break;
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    
    function delete_product($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
    }

    function delete_image($id) {
        global $conn;
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $query = "SELECT picture_name FROM produk WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $picture_name = $data['picture_name'];
            $file = 'produk_gambar/' . $picture_name;

            if (file_exists($file) && is_readable($file) && unlink($file)) {
                $query = "UPDATE produk SET picture_name=null WHERE id = $id";
                mysqli_query($conn, $query);
            }
        }
    }
?>