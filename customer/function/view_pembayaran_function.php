<?php 
    include '../config/database.php';

    function get_data_pembayaran($idPembayaran, $idUser){
        global $conn;
        $result = mysqli_query($conn, "SELECT p.*, o.* FROM payments p JOIN orders o ON o.id = p.order_id WHERE p.id = $idPembayaran AND o.user_id = $idUser");
        $payments = mysqli_fetch_assoc($result);

        return $payments;
    }

    function get_bank_payment($namaBank){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM settings WHERE settings.key = 'payment_banks'");
        $payments = mysqli_fetch_assoc($result);

        $payments = json_decode($payments['content'], true);
        foreach($payments as $py){
            if(strtolower($py['bank']) == $namaBank){
                $payments = $py;
            }
        }
        return $payments;
    }

    function get_payment_status($status)
    {
        if ($status == 1)
            return 'Menunggu konfirmasi';
        else if ($status == 2)
            return 'Berhasil dikonfirmasi';
        else if ($status == 3)
            return 'Pembayaran tidak ditemukan';
    }
?>