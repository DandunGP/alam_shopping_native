<?php 

include 'config/database.php';

function register()
{
    global $conn;

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['name'];
    $no_hp = $_POST['phone_number'];
    $email = $_POST['email'];
    $alamat = $_POST['address'];

    $query = mysqli_query($conn, "insert into users(username, password, name, no_hp, email, alamat, role) values ('$username', '$password', '$nama', '$no_hp', '$email', '$alamat', 'Customer')");
    
    if($query){
        echo "
        <script>
            alert('Berhasil melakukan pendaftaran');
            window.location='login.php'
        </script>
        ";
    }else{
        echo "
            <script>
                alert('Gagal melakukan pendaftaran');
            </script>
            ";
    }
}
?>