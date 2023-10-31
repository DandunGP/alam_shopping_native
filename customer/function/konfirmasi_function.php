<?php 
    include '../config/database.php';

    function confirm_payment(){
        global $conn;
        $order_id = $_POST['order_id'];
        $payment_price = $_POST['transfer'];
        $payment_date = date('Y-m-d H:i:s');
        $name = $_POST['name'];
        $bank = $_POST['bank'];
        $bank_name = $_POST['bank_name'];
        $bank_number = $_POST['bank_number'];

        $namaFile = $_FILES['bukti']['name'];
        $tmpName = $_FILES['bukti']['tmp_name'];

        $ekstensiFile = ['jpeg', 'jpg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar2 = $ekstensiGambar[1];

        if(!in_array($ekstensiGambar2, $ekstensiFile)){
            echo "<script>
                alert('Ekstensi harus jpeg jpg png');
            </script>";
        }else{
            $namaBaru = 'bukti_pembayaran'.time().'.'.$ekstensiGambar2;
            move_uploaded_file($tmpName, "bukti_pembayaran/".$namaBaru);
        }

        $payment_data = '{"transfer_to":"'.$bank.'","source":{"bank":"'.$bank_name.'","name":"'.$name.'","number":"'.$bank_number.'"}}';

        $query = mysqli_query($conn, "insert into payments(order_id, payment_price, payment_date, picture_name, payment_status, payment_data) values 
                                            ($order_id, $payment_price, '$payment_date', '$namaBaru', 1, '$payment_data')");

        if($query){
            echo "
                <script>
                    alert('Konfirmasi berhasil di tambahkan');
                    window.location='pembayaran.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Konfirmasi gagal ditambahkan');
                </script>
                ";
        }
    }
?>