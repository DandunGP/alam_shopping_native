<?php 

include 'config/database.php';

function login()
{
    global $conn;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "select * from users where username = '" . $username . "'");
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query) > 0) {
        if(password_verify($password, $row['password'])){
            if ($row['role'] == "Admin") {
                $_SESSION['status_login'] = true;
                $_SESSION['admin'] = $row;
                $_SESSION['status'] = $row['status'];
                $_SESSION['id'] = $row['username'];
                
                if(isset($_SESSION['errorNotMatch'])){
                    unset($_SESSION['errorNotMatch']);
                }

                if(isset($_SESSION['errorNotFound'])){
                    unset($_SESSION['errorNotFound']);
                }

                echo "
                    <script>
                        window.location='admin/dashboard.php';
                    </script>
                    ";
            } else {
                $_SESSION['status_login'] = true;
                $_SESSION['nama'] = $row['username'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['id'] = $row['username'];

                if(isset($_SESSION['errorNotMatch'])){
                    unset($_SESSION['errorNotMatch']);
                }

                if(isset($_SESSION['errorNotFound'])){
                    unset($_SESSION['errorNotFound']);
                }
                echo "
                    <script>
                        window.location='customer/home.php';
                    </script>
                    ";
            }
        }else{
            $_SESSION['errorNotMatch'] = true;

            if(isset($_SESSION['errorNotFound'])){
                unset($_SESSION['errorNotFound']);
            }

            echo "
                    <script>
                        window.location='login.php';
                    </script>
                    ";
        }
    } else {
        $_SESSION['errorNotFound'] = true;

        if(isset($_SESSION['errorNotMatch'])){
            unset($_SESSION['errorNotMatch']);
        }

        echo "
                <script>
                    window.location='login.php';
                </script>
                ";
    }
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
?>