<?php 
    include "../config/database.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    }else{
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    switch ($action) {
        case 'list':
            $categories = get_all_categories();
            $response = array('data' => $categories);
            break;
        case 'view_data':
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $data = category_data($id);
            $response = array('data' => $data);
            break;
        case 'add_category':
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            add_category($name);
            $categories = get_all_categories();
            $response = array('data' => $categories);
            break;
        case 'delete_category':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            delete_category($id);
            $response = array('code' => 204, 'message' => 'Kategori berhasil dihapus!');
            break;
        case 'edit_category':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            edit_category($id, $name);
            $response = array('code' => 201, 'message' => 'Kategori berhasil diperbarui');
            break;
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    function get_all_categories() {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM kategori");
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return $categories;
    }

    function category_data($id) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM kategori WHERE id=$id");
        $categories = mysqli_fetch_assoc($result);
        return $categories;
    }

    function add_category($name) {
        global $conn;
        mysqli_query($conn, "INSERT INTO kategori(nama) VALUES ('$name')");
    }

    function delete_category($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM kategori WHERE id=$id");
    }

    function edit_category($id, $name) {
        global $conn;
        mysqli_query($conn, "UPDATE kategori set nama='$name' WHERE id=$id");
    }
?>

