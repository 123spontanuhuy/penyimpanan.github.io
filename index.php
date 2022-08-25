<?php
// session_start();

// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }

$conn = mysqli_connect('localhost', 'root', '', 'multipleimage', 3307);
if (!$conn) {
    echo 'Connection failed';
}

if (isset($_POST['submit'])) {
    $imageCount = count($_FILES['image']['name']);
    for ($i = 0; $i < $imageCount; $i++) {
        $imageName = $_FILES['image']['name'][$i];
        $imageTempName =e $_FILES['image']['tmp_name'][$i];
        $targetPath = "./upload/" . $imageName;
        if (move_uploaded_file($imageTempName, $targetPath)) {
            $sql = "INSERT INTO images(image)VALUES('$imageName')";
            $result = mysqli_query($conn, $sql);
        }
    }
    if ($result) {
        header('location:index.php?msg=ins');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1 style="text-align: center;">Laman Upload Gambar</h1>
    <button style="margin-top: 10px;" type="submit" name="submit"><a class="link" href="logout.php"><b>Logout</b></a></button>
    <?php
    if (isset($_GET['msg']) and $_GET['msg'] == 'ins') {
        echo '<h4 align=center>Gambar berhasil diupload!</h4>';
    }
    ?>
    <div class="formdesign">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <b>Please select image<b></b><br><br>
                <input type="file" name="image[]" multiple><br><br>
                <input type="submit" name="submit" value="Upload">
        </form>

        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'multipleimage', 3307);
        $sql = "SELECT * FROM images";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($fetch = mysqli_fetch_assoc($result)) {
        ?>
                <img src="upload/<?php echo $fetch['image']; ?>" width=100 height=100>
        <?php
            }
        }
        ?>

    </div>
</body>

</html>

<style>
    body {
        height: 100vh;
        background-color: #A7C7E7;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .formdesign {
        width: 50%;
        margin: auto;
        padding: 20px 15px;
        background-color: #fafafa;
    }

    button {
        width: 10%;
        height: 40px;
        padding: 5px 0;
        border: none;
        background-color: #752BEA;
        font-size: 18px;
        color: #fafafa;
        border-radius: 20px;
        margin: 20px;
        margin-left: 605px;
    }

    .link:hover {
        color: red;
    }

    .link:link {
        color: white;
    }

    .link:active {
        color: white;
    }

    .link:visited {
        font-size: 20pt;
        background: #1ABC9C;
        color: #fff;
        text-decoration: none;
        padding: 10px;
        font-family: sans-serif;
    }
</style>