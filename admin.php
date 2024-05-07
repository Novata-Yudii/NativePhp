<?php 
    require "./dbquery.php";
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:./login.php");
        exit();
    }
    
    if(isset($_POST["submit"])){ 
        // Variabel yg menampung uplod gambar $_FILES (Bentuk multi array asosiatif);
        if(insertData($_POST)>0){
            // echo "<h3>Data berhasil ditambahkan</h3>";
            // sleep(2);
            // header("Location:./index.php");
            // exit;
            echo "
                <script>
                    alert('Data berhasil ditambahkan');
                    document.location.href = './index.php';
                </script>
            ";
        }else{
            // echo "<h3>Data gagal ditambahkan</h3>";
            // sleep(2);
            // header("Location:./index.php");
            // exit;
            echo "
                <script>
                    alert('Data gagal ditambahkan');
                    document.location.href = './index.php';
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
    <title>Document</title>
</head>
<body>
    <h2>Form Input Development Board</h2>
    <form action="./admin.php" method="post" enctype="multipart/form-data">
        <label for="board">Boardname : </label>
        <input type="text" required name="board" id="board" placeholder="boardname"><br>
        
        <label for="processor">Processor : </label>
        <input type="text" required name="processor" id="processor" placeholder="processor"><br>
        
        <label for="tegangan">Tegangan : </label>
        <input type="text" required name="tegangan" id="tegangan" placeholder="tegangan"><br>
        
        <label for="gpio">Gpio : </label>
        <input type="text" required name="gpio" id="gpio" placeholder="gpio"><br>
        
        <label for="komunikasi">Komunikasi : </label>
        <input type="text" required name="komunikasi" id="komunikasi" placeholder="komunikasi"><br>
        
        <label for="gambar">Uplod gambar : </label>
        <input type="file" required name="gambar" id="gambar"><br>

        <button type="submit" name="submit">Kirim!</button>
    </form>
</body>
</html>