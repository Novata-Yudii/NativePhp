<?php 
    require "./dbquery.php";
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:./login.php");
        exit();
    }

    if (!isset($_GET["id"])) {
        header("Location:./index.php");
        exit;
    }
    $id = $_GET["id"];
    $detailBoard = fetchData("SELECT * FROM devboard WHERE id = $id");
    $board = $detailBoard[0]["board"];
    $processor = $detailBoard[0]["processor"];
    $tegangan = $detailBoard[0]["tegangan"];
    $gpio = $detailBoard[0]["gpio"];
    $komunikasi = $detailBoard[0]["komunikasi"];
    $gambar = $detailBoard[0]["gambar"];

    if(isset($_POST["submit"])){
        if(updateData($_POST, $id, $gambar)>0){
            echo "
                <script>
                    alert('Data berhasil di update gais');
                    document.location.href = './index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal di update');
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
    <title>Edit data</title>
</head>
<body>
    <h2>EDIT DATA KAMU..</h2>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="board">Boardname : </label>
        <input type="text" required name="board" id="board" placeholder="board" value="<?php echo $board?>"><br>
        
        <label for="processor">Processor : </label>
        <input type="text" required name="processor" id="processor" placeholder="processor" value="<?php echo $processor?>"><br>
        
        <label for="tegangan">Tegangan : </label>
        <input type="text" required name="tegangan" id="tegangan" placeholder="tegangan" value="<?php echo $tegangan?>"><br>
        
        <label for="gpio">Gpio : </label>
        <input type="text" required name="gpio" id="gpio" placeholder="gpio" value="<?php echo $gpio?>"><br>
        
        <label for="komunikasi">Komunikasi : </label>
        <input type="text" required name="komunikasi" id="komunikasi" placeholder="komunikasi" value="<?php echo $komunikasi?>"><br>
        
        <label for="gambar">Gambar board : </label><br>
        <img src="./img/<?php echo $gambar?>" width="50px" alt="<?php echo $board?>"><br>
        <input type="file" name="gambar" id="gambar"><br>

        <button type="submit" name="submit">Kirim!</button>
    </form>

</body>
</html>