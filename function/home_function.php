<?php 
    include 'config/database.php';

    function get_data_store(){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM settings");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function get_all_product() {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk");
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

    function get_produk_terbaru(){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 1");
        $products = mysqli_fetch_assoc($result);
        return $products;
    }

    function get_all_review(){
        global $conn;
        $result = mysqli_query($conn, "SELECT r.*, o.order_number, u.* FROM reviews AS r INNER JOIN orders AS o ON o.id = r.order_id LEFT JOIN users AS u ON u.id = r.user_id");
        $reviews = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }
        return $reviews;
    }

    function get_formatted_date($tanggal)
    {
        $d = strtotime($tanggal);

        $year = date('Y', $d);
        $month = date('n', $d);
        $day = date('d', $d);
        $day_name = date('D', $d);
            
        $day_names = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jum\'at',
            'Sat' => 'Sabtu'
        );
        $month_names = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'November',
            '11' => 'Oktober',
            '12' => 'Desember'
        );
        $day_name = $day_names[$day_name];
        $month_name = $month_names[$month];

        $date = "$day_name, $day $month_name $year";

        return $date;
    }
?>