<?php

require_once('db.php');
// session_start();

//page: ajouter un livre
try {
    if (isset($_POST['submit'])) {
        if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['price']) && !empty($_POST['published'])) {
            $sql = "INSERT INTO bookorder (title,author,published,price) VALUES(:title,:author,:published,:price)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $_POST['title'], 
                ':author' => $_POST['author'],
                ':published' => $_POST['published'],
                ':price' => $_POST['price'],
            ]);
            header("location:display.php");
        } 
        else {
            echo"Please fill out all the required information!";
        }
    }
}
catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<form action="" method="post" >
    <h3>Add Book:</h3>
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Title:</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="title" placeholder="">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Author:</label>
        <input type="text" class="form-control" name="author" id="formGroupExampleInput2" placeholder="">
    </div>
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Publish year:</label>
        <input type="text" class="form-control" name="published" id="formGroupExampleInput" >
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Price:</label>
        <input type="decimal" class="form-control" name="price" id="formGroupExampleInput2" placeholder="">
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Add</button>
</form>
</body>
</html>

