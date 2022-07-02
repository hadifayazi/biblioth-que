<?php
require('db.php');
require_once('display.php');

//delete exactement comme update on prend l'id du livre avec un GET

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql= "DELETE FROM bookorder WHERE id = :id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    if($stmt){
        header('location:display.php');
    }
}