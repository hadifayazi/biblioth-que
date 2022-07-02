<?php
require('db.php');
session_start();
include('header.php');

?>

// affichage uniquement (pas de foncionality)

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">
    <h1 style="color:aliceblue">Wellcome to DonkeyLib</h1><br><br>
        <div class="btn-btn">
        <button type="button" class="btn btn-warning" style="color: #fff;"><a href="login.php">Login</a></button>
        <button type="button" class="btn btn-warning"><a href="register.php">Register</a></button> 
        </div>
    </div>
</body>
</html>

