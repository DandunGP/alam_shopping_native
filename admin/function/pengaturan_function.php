<?php 
    include '../config/database.php';

    function get_data_pengaturan(){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM settings");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function update_all_setting(){
        global $conn;
        $keys = array(
            'store_name', 'store_phone_number', 'store_email', 'store_tagline', 'store_description',
            'store_address', 'min_shop_to_free_shipping_cost', 'shipping_cost'
        );
        
        foreach ($keys as $key) {
            if (isset($_POST[$key])) {
                $content = $_POST[$key];
                update_setting($key, $content);
            }
        }

        if(!empty($_FILES['picture']['name'])){
            $namaFile = $_FILES['picture']['name'];
            $tmpName = $_FILES['picture']['tmp_name'];

            $ekstensiFile = ['jpeg', 'jpg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar2 = $ekstensiGambar[1];

            if(!in_array($ekstensiGambar2, $ekstensiFile)){
                echo "<script>
                    alert('Ekstensi harus jpeg jpg png');
                </script>";
            }else{
                $namaBaru = 'produk'.time().'.'.$ekstensiGambar2;
                move_uploaded_file($tmpName, "admin_gambar/".$namaBaru);
            }

            mysqli_query($conn, "UPDATE settings SET settings.content='$namaBaru' WHERE settings.key = 'store_logo'");
        }

        $banks = $_POST['banks'];

        if (isset($_POST["banks"])) {
            $banks = $_POST["banks"];
    
            $formatBanks = [];
    
            foreach ($banks as $index => $bank) {
                $bankName = strtolower($bank["bank"]);
                $formatBanks[$bankName] = [
                    "bank" => $bank["bank"],
                    "number" => $bank["number"],
                    "name" => $bank["name"]
                ];
            }
    
            $banks = json_encode($formatBanks);

            mysqli_query($conn, "UPDATE settings SET settings.content='$banks' WHERE settings.key = 'payment_banks'");
        } 

        echo "
        <script>
            alert('Pengaturan berhasil di ubah');
            window.location='pengaturan.php'
        </script>
        ";
    }

    function update_setting($key, $content){
        global $conn;
        mysqli_query($conn, "UPDATE settings SET settings.content='$content' WHERE settings.key = '$key'");
    }
?>