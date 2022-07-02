<?php

require_once('db.php');


//page: ajouter ou supprimer un author

//ajouter un author
if(isset($_POST['ajouter'])){
    if(!empty($_POST['name'])){

        $name = $_POST['name'];
        $sql = "INSERT INTO author (name) VALUES(:name)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        echo "$name has been added to the list.";
    }
    else{
        echo "Please enter the author's name!";
    }
}


//supprimer un author
if(isset($_POST['delete'])){
    if(!empty($_POST['name'])){

        $name = $_POST['name'];
        $sql = "DELETE FROM author WHERE name = :name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        echo $name.' '."has been deleted from the list.";
    }
    else{
        echo "Please enter the author's name!!!!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
  
   <section class="author-add-remove">
        <h1>Add/delete an Author:</h1>
        <form action="" method="post">   
            <div class="">
                Name: <input type="text" name="name" required>
            </div>
            <div class="btn-del-add">
                <input type="submit" name="delete" class="btn-del" value="Delete">
                <input type="submit" name="ajouter" class="btn-add" value="Add">
            </div>
        </form>
    </section>
</body>
</html>






