<?php 
    $dbConnect = mysqli_connect('localhost','root','','microcontroler');

    function fetchData($query){
        global $dbConnect;
        $datas = [];
        $tabel = mysqli_query($dbConnect,$query);
        while ($data = mysqli_fetch_assoc($tabel)){
            $datas[] = $data;
        }
        return $datas;
    };

    function insertData($data){
        global $dbConnect;
        $board = $data["board"];
        $processor = $data["processor"];
        $tegangan = $data["tegangan"];
        $gpio = $data["gpio"];
        $komunikasi = $data["komunikasi"];
        $gambar = uplodGambar();
        if(!$gambar){
            return false;
        }
        $query = "INSERT INTO devboard(board,processor,tegangan,gpio,komunikasi,gambar) VALUES('$board','$processor','$tegangan','$gpio','$komunikasi','$gambar')";
        mysqli_query($dbConnect, $query); //Jika terjadi eror ketika insertdata, otomatis berhenti disini, dibawah ga dieksekusi
        return mysqli_affected_rows($dbConnect);
    };

    function uplodGambar(){
        $namaFile = $_FILES["gambar"]["name"];
        $tmp_name = $_FILES["gambar"]["tmp_name"];
        $error = $_FILES["gambar"]["error"];
        $size = $_FILES["gambar"]["size"];
        $extensionImages = ["png","jpg","jpeg"];
        $formatFile = pathinfo($namaFile, PATHINFO_EXTENSION);

        if(!in_array($formatFile,$extensionImages)){
            echo "
                <script>
                    alert('Gambar yang di uplod, extension nya tidak sesuai...')
                </script>
            ";
            return false;
        }
        if($size>3000000){
            echo "
                <script>
                    alert('Gambar yang di uplod, size nya terlalu besar kak...')
                </script>
            ";
            return false;
        }
        move_uploaded_file($tmp_name, "./img/".$namaFile);
        return $namaFile;
    }

    function updateData($data, $id, $gambarLama){
        global $dbConnect;
        $board = $data["board"];
        $processor = $data["processor"];
        $tegangan = $data["tegangan"];
        $gpio = $data["gpio"];
        $komunikasi = $data["komunikasi"];
        if($_FILES["gambar"]["error"] === 4){
            $gambar = $gambarLama;
        }else{
            $gambar = uplodGambar();
        }
        $query = "UPDATE devboard SET 
                board ='$board',
                processor = '$processor',
                tegangan = '$tegangan',
                gpio = '$gpio',
                komunikasi = '$komunikasi',
                gambar = '$gambar'
                WHERE id = $id
        ";
        mysqli_query($dbConnect, $query);
        return mysqli_affected_rows($dbConnect);
    };

    function deleteData($id){
        global $dbConnect;
        $query = "SELECT gambar FROM devboard WHERE id = $id";
        $namaFile = mysqli_fetch_assoc(mysqli_query($dbConnect, $query));
        unlink('./img/' . $namaFile["gambar"]);
        $query = "DELETE FROM devboard WHERE id = $id";
        mysqli_query($dbConnect, $query);
        return mysqli_affected_rows($dbConnect);
    };

    function registrasi($data){
        global $dbConnect;
        $username = strtolower(stripslashes($data['username'])); //menghilangkan special character seperti backslash dan memaksa huruf menjadi kecil
        $password = mysqli_real_escape_string($dbConnect,$data['password']); //memungkinkan password mengandung tanda petik dan diterima oleh database
        $password2 = mysqli_real_escape_string($dbConnect,$data['password2']);
        $tabel = mysqli_query($dbConnect,"SELECT username FROM users WHERE username='$username'");
        if(mysqli_fetch_assoc($tabel)){
            echo "
                    <script>
                        alert('Username sudah dipakai');
                    </script>
                 ";
            return false;
        }
        if($password != $password2){
            echo "
                    <script>
                        alert('Konfirmasi password tidak sesuai!');
                    </script>
                 ";
            return false;
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(username, password) VALUES('$username', '$password')";
        mysqli_query($dbConnect, $query);
        return mysqli_affected_rows($dbConnect);
    }

    function checkLogin($data){
        global $dbConnect;
        $username = $data["username"];
        $password = $data["password"];
        $query = "SELECT * FROM users WHERE username LIKE '%$username%'"; //Tidak case sensitive
        $tabel = mysqli_query($dbConnect, $query);
        if($row=mysqli_fetch_assoc($tabel)){
            if(password_verify($password, $row["password"])){//function ini mengembalikan 1 atau 0
                if(isset($data["checkbox"])){
                    setcookie("id", $row["id"],time()+60);
                    setcookie("username", hash('sha256',$row["username"]),time()+60);
                }
                return true;
            }
        }
        return false;
    }
?>