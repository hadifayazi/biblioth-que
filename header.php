<?php

require('db.php');
session_start();

if(isset($_SESSION['user'])){
  $user = $_SESSION['userName'];
  echo "wellcome $user";
}

if(isset($_GET['submit'])){
    if(!empty($_GET['search'])){
        $search = '%'.$_GET['search'].'%';
        $sql = "SELECT * FROM books WHERE title LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search]);
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo 'Title: '.$row['title'].'<br>'.'Price: '.$row['price'].'<br>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">DonkeyLib</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="register.php">Create an acount</a>
        <a class="nav-link" href="login.php" >login</a>
        <a class="nav-link" href="#">Cart</a>
        <a class="nav-link" href="display.php">Admin</a>
    </div>
  </div>

</nav>
</body>
</html>