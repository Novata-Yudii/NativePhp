<?php 
    require "./dbquery.php";
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:./login.php");
        exit();
    }

    if(isset($_POST["submit"])){
        if(registrasi($_POST)>0){
            echo "
                    <script>
                        alert('Berhasil registrasi');
                    </script>
                 ";
        }else{
            echo "
                    <script>
                        alert('Gagal registrasi');
                    </script>
                 ";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrasi</title>
</head>
<body>
    <h2>Registrasi</h2>
    <form action="" method="post">
        <label for="username">Username : </label>
        <input type="text" required name="username" id="username" placeholder="username"><br>

        <label for="password">Password : </label>
        <input type="password" required name="password" id="password" placeholder="password"><br>

        <label for="password2">Konfirmasi Password : </label>
        <input type="password" required name="password2" id="password2" placeholder="password"><br>

        <button type="submit" name="submit">Registrasi</button>
    </form>
    <h3><a href="./index.php">KEMBALI</a></h3>
</body>
</html>