<?php
session_start();

// Vytvořil jsem účet v MySQL pro testovací účely,
// admin
// a23YnX98

if (isset($_POST['login-submit']) && isset($_POST['pwd']) && $_POST['mailuid']){
    require 'dbh.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM uzivatele WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ./index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if (!$pwdCheck){
                    header("Location: ./index.php?error=wrongpwdx");
                    exit();
                } else if($pwdCheck){
                    $_SESSION['userId'] = $row['idUsers']; 

                    header("Location: ./Planovaci-kalendar.php?login=success");
                    exit();

                }
                else{
                    header("Location: ./index.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: ./index.php?error=nouser");
                exit();
            }
        }
    }

} else {
    header("Location: ./index.php");
    exit();
}
