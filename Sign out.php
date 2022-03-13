<?php session_start();

if (isset($_SESSION['username1'])){
    unset($_SESSION['username1']);
}
header("Location: index.php");
?>;