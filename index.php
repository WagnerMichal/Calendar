<?php
session_start();

if(isset($_SESSION['userId'])) { 
    header('Location: ./Planovaci-kalendar.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>htmllogin</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="login">
    <form action="login.php" method="post">
        <p>Přihlaste se</p>
        <input type="text" name="mailuid" placeholder="Username/E-mail">
        <input type="password" name="pwd" placeholder="Password">
        <button class="tlacitko1" type="submit" name="login-submit">Login</button>
    </form>

</div>

</body>

</html>
