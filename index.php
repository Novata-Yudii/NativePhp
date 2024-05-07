<?php
    require './dbquery.php';
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:./login.php");
        exit();
    }

    $detailBoard = fetchData("SELECT * FROM devboard");
    if (isset($_POST["submit"])) {
        $board = $_POST["searchboard"];
        $detailBoard = fetchData("SELECT * FROM devboard WHERE board LIKE '%$board%'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microcontroler</title>
</head>
<body>
    <a href="./login.php">LOGIN ADMIN</a> <br>
    <a href="./registrasi.php">REGISTRASI</a> <br>
    <a href="./admin.php">TAMBAH DEVELOPMENT BOARD</a> <br>
    <a href="./logout.php">LOGOUT</a>

    <h3>Cari development Boardmu disini gais!</h3>
    <form action="" method="post">
        <label for="searchboard">Search : </label>
        <input type="text" required name="searchboard" id="searchboard">
        <button type="submit" name="submit">Cari disini!</button>
    </form>

    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Board</th>
            <th>Processor</th>
            <th>Tegangan</th>
            <th>Komunikasi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1 ?>
        <?php foreach($detailBoard as $detail) {?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $detail["board"] ?></td>
                <td><?php echo $detail["processor"] ?></td>
                <td><?php echo $detail["tegangan"] ?></td>
                <td><?php echo $detail["komunikasi"] ?></td>
                <td><img src="./img/<?php echo $detail["gambar"] ?>" width="50px" alt="<?php $detail["board"] ?>"></td>
                <td>
                    <a href="./edit.php?id=<?php echo $detail["id"]?>">Edit</a>
                    <a href="./delete.php?id=<?php echo $detail["id"]?>">Delete</a>
                </td>
            </tr>
            <?php $i++ ?>
        <?php } ?>
    </table>
</body>
</html>