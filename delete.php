<?php
    require "./dbquery.php";
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:./login.php");
        exit();
    }

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        if(deleteData($id)>0){
            echo "
                <script>
                    alert('Data berhasil di hapus');
                    document.location.href = './index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal di hapus');
                    document.location.href = './index.php';
                </script>
            ";
        }
    }else{
        header("Location:./index.php");
        exit();
    }
?>