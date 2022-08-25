<?php
session_start();

//Cek cookie
if(isset($_COOKIE['login'])) {
    if($_COOKIE['login'] == 'true') {
       $_SESSION['login'] == true;
    }
}

if(isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

// Mengecek apakah tombol submit sudah tekan atau belum
if(isset($_POST["submit"])) {
    // Mengecek username dan password
    if($_POST["username"] == "admin" && $_POST["password"] == "123"){
    // Set session
    $_SESSION["login"] = true;
    // Cek remember me
    if(isset($_POST['remember'])) {
    // Buat Cookie
    setcookie('login', 'true', time() + 60);
    }
    //Redirect ke halaman index
    header("Location: index.php");
    exit;
    } else{
    // Jika salah, pesan kesalahan ditampilkan
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Login Form</title>
    </head>
        <body>
            <div class="container">
                <h1>Login Form</h1>
                <?php if(isset($error)) : ?>
                    <p style="color: red; font-style: italic;">Username / Password salah!</p>
                <?php endif; ?>
                <ul>
                    <form action="" method="post">
                            <label for="username"><b>Username :</b></label>
                            <input type="text" name="username" id="username">
                            <label for="password"><b>Password :</b></label>
                            <input type="password" name="password" id="password">
                            <label for="remember"><b>Remember Me </b></label>
                            <input type="checkbox" name="remember" id="remember">
                            <button style="margin-top: 10px;" type="submit" name="submit">Login</button>
                    </form>
                </ul>
            </div>
        </body>
</html>

<style>
*{
    margin: 0;
    padding: 0;
    outline: 0;
    font-family: 'Open Sans', sans-serif;
}
body{
    height: 100vh;
    background-color: #242424;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

h1 {
  text-align: center;
  padding-bottom: 20px;
}

a {
  color: #752BEA;
  font-family: 'Open Sans', sans-serif;
}

.container{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    padding: 20px 25px;
    width: 300px;

    background-color: rgba(255, 255, 255, .9);
    box-shadow: 0 0 10px rgba(255,255,255,.3);
}
.container h1{
    text-align: left;
    color: #1d1d1d;
    margin-bottom: 30px;
    border-bottom: 5px solid#1d1d1d;
}
.container label{
    text-align: left;
    color: #1d1d1d;
}
.container form input{
    padding: 8px 10px;
    margin-bottom: 15px;
    border: none;
    background-color: transparent;
    border-bottom: 1px solid #1d1d1d;
    color: #1d1d1d;
    font-size: 20px;
}
.container form button{
    width: 100%;
    height: 40px;
    padding: 5px 0;
    border: none;
    background-color:#752BEA;
    font-size: 18px;
    color: #fafafa;
    border-radius: 20px;
} 
</style>