<?php
    require "./dbquery.php";
    session_start();
    if(isset($_COOKIE["id"]) && isset($_COOKIE["username"])){
        $id = $_COOKIE["id"];
        $username = $_COOKIE["username"];
        $datas = fetchData("SELECT username FROM users WHERE id=$id")[0];
        if($username === hash("sha256", $datas["username"])){
            $_SESSION["login"] = true;
        }
    }

    if(isset($_SESSION["login"])){
        header("Location:./index.php");
        exit();
    }

    if(isset($_POST["submit"])){
        if(checkLogin($_POST)>0){
            $_SESSION["login"] = true;
            echo "
                    <script>
                        alert('Login berhasil');
                        document.location.href='./index.php';
                    </script>
                 ";
        }
        $eror = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>Halaman Login</h1>
    <form action="" method="post">
        <label for="username">Username : </label>
        <input type="text" required name="username" id="username" placeholder="username"><br>

        <label for="password">Password : </label>
        <input type="password" required name="password" id="password" placeholder="password"><br>

        <input type="checkbox" name="checkbox" id="checkbox">
        <label for="checkbox">Remember me</label><br>

        <?php 
            if(isset($eror)){
                echo "<p style='color:red'>Login gagal, username atau password salah</p>";
            }
        ?>

        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>