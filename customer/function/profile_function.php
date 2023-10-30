<?php 
    include '../config/database.php';

    function update_profile($id){
        global $conn;

        $name = $_POST['name'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        
        if(!empty($_FILES['file']['name'])){
            $namaFile = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];

            $ekstensiFile = ['jpeg', 'jpg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar2 = $ekstensiGambar[1];

            if(!in_array($ekstensiGambar2, $ekstensiFile)){
                echo "<script>
                    alert('Ekstensi harus jpeg jpg png');
                </script>";
            }else{
                $namaBaru = 'customer_'.$name.time().'.'.$ekstensiGambar2;
                move_uploaded_file($tmpName, "customer_gambar/".$namaBaru);
            }

            $query = mysqli_query($conn, "UPDATE users set users.name='$name', users.no_hp='$no_hp', users.alamat='$alamat', users.profile_picture='$namaBaru' WHERE id=$id");

        }else{
            $query = mysqli_query($conn, "UPDATE users set users.name='$name', users.no_hp='$no_hp', users.alamat='$alamat' WHERE id=$id");
        }

        if($query){
            echo "
                <script>
                    alert('Data berhasil di ubah');
                    window.location='profile.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah');
                </script>
                ";
        }
    }
    
    function update_username($id){
        global $conn;

        $username = $_POST['username'];

        if(isset($_POST['password'])){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = mysqli_query($conn, "UPDATE users set users.username='$username', users.password='$password' WHERE id=$id");
        }else{
            $query = mysqli_query($conn, "UPDATE users set users.username='$username' WHERE id=$id");
        }

        if($query){
            echo "
                <script>
                    alert('Data berhasil di ubah');
                    window.location='profile.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah');
                </script>
                ";
        }
    }
    
    function update_email($id){
        global $conn;

        $email = $_POST['email'];

        $query = mysqli_query($conn, "UPDATE users set users.email='$email' WHERE id=$id");

        if($query){
            echo "
                <script>
                    alert('Data berhasil di ubah');
                    window.location='profile.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah');
                </script>
                ";
        }
    }
?>