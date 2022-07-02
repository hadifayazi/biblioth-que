<?php
include('header.php');
require_once('db.php');

//page: update (modifier) un livre

//j'ai pris l'id du livre et le nomer "updateid" en utilisant GET, updatedid(dans la page display qui est la page pour display, edit,delete et edit d'un livre, le button edit et delete contien l'id(updateid et deleteid)du livre pour detecter le livre qu'on veut mofifier ou suprrimer)


// avec un SELECT on fetch(retirer) les données et on les a mis dans la partie value du form pourque le form soit prerempli et puis avec un UPDATE on met à jour les nouveau data.
try{
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM bookorder WHERE id = :id";
    $statement= $pdo->prepare($sql);
    $statement->execute([':id'=>$id]);
    $row = $statement ->fetch();
    $title=$row['title'];
    $author=$row['author'];
    $published = $row['published'];
    $price = $row['price'];
   
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


try {
    if (isset($_POST['submit'])) {
        if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['price']) && !empty($_POST['published'])) {
            $title= $_POST['title'];
            $author= $_POST['author'];
            $published= $_POST['published'];
            $price= $_POST['price'];
            $sql = "UPDATE  bookorder SET  title =:title, author = :author , published = :published, price = :price WHERE id = :id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id'=>$id,':title'=>$title, ':author'=>$author, ':published'=>$published, ':price'=>$price]);
            header('location:display.php');
            
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


    
<section class="add-book">

<form action="" method="post" >
    <h3>Add Book:</h3>
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Title:</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="title" value="<?php echo $title; ?>">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Author:</label>
        <input type="text" class="form-control" name="author" id="formGroupExampleInput2" value="<?php echo $author;?>">
    </div>
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Publish year:</label>
        <input type="text" class="form-control" name="published" id="formGroupExampleInput" value="<?php echo $published;?>">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Price:</label>
        <input type="decimal" class="form-control" name="price" id="formGroupExampleInput2" value="<?php echo $price; ?>">
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Save</button>
</form>
</section>
</body>
</html>
