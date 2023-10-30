<?php 
    include '../config/database.php';

    function get_data_order_by_id($idOrder, $idCustomer){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE id=$idOrder AND user_id = $idCustomer");
        $orders = mysqli_fetch_assoc($result);
        return $orders;
    }

    function get_data_items_order($idOrder){
        global $conn;
        $result = mysqli_query($conn, "SELECT order_item.order_id, order_item.product_id, order_item.order_qty, order_item.order_price, produk.* FROM order_item JOIN produk ON order_item.product_id = produk.id WHERE order_id=$idOrder");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        return $items;
    }

    function get_data_payment_by_order_id($idOrder){
        global $conn;
        $result = mysqli_query($conn, "SELECT p.*, o.* FROM payments p JOIN orders o ON o.id = p.order_id WHERE order_id=$idOrder");
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

    function get_order_status($status, $payment)
    {
        if ($payment == 1)
        {
            // Bank
            if ($status == 1)
                return 'Menunggu pembayaran';
            else if ($status == 2)
                return 'Dalam proses';
            else if ($status == 3)
                return 'Dalam pengiriman';
            else if ($status == 4)
                return 'Selesai';
            else if ($status == 5)
                return 'Dibatalkan';
        }
        else if ($payment == 2)
        {
            //COD
            if ($status == 1)
                return 'Dalam proses';
            else if ($status == 2)
                return 'Dalam pengiriman';
            else if ($status == 3)
                return 'Selesai';
            else if ($status == 4)
                return 'Dibatalkan';
        }
    }
    
?>