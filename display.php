<?php

require_once('delete.php');
include('header.php');

//page display ou admin panel pour gerer modifications,delete,update et display j'ai utiliser une balise TABLE HTML pour afficher les livre(data)
?>

<body>
  <h1>ADMIN PANEL</h1>
    <table class="table table-dark table-striped">
    <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Published</th>
      <th>Price</th>
      <th><button type="button" class="btn btn-success "><a style="text-decoration: none; color:white" href="addbook.php">Add a book</a></button></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php
        $sql = "SELECT * FROM bookOrder";
        $stmt = $pdo->query($sql);
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){ ?>
            <?php
             $id= $row['id'];
             $title= $row['title'];
             $author= $row['author'];
             $published= $row['published'];
             $price= $row['price'];
             ?>
             <div>
            <th><?php echo $id;?></th>
            <td><?php echo $title; ?></td>
            <td><?php echo $author; ?></td>
            <td><?php echo $published;?></td>
            <td><?php echo $price;?></td>
            <td><button type="button" class="btn btn-info "><a style="text-decoration: none; color:white" href=" copyupdate.php?updateid=<?php echo $id;?>">Edit</a></button></td>
            <td><button type="button" class="btn btn-danger"  ><a href="delete.php?deleteid=<?php echo $id; ?>">Delete</a></button></td>
          </div>
        </tr>
        <?php }?>
  </tbody>
</table>
</body>
</html>