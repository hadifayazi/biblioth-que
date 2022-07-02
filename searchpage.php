<?php
include('headertwo.php');
require_once('db.php');
session_start();




    $search = '%'.$_GET['search'].'%';
    $sql = "SELECT * FROM books WHERE title LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$search]);
    $result = $stmt->fetchAll();
    header('searchtwo.php');
    foreach($result as $row){?>
            <div class="card-body">
                <h4 class="card-title"><?php echo $row['title'];?></h4>
                <h4>Author :<?php echo $row['author']; ?></h4>
                <h4>Published: <?php echo $row['published'];?></h4>
                <h4>Price: <?php echo $row['price']; ?></h4>
            </div>
<?php }?>
    



<body>
<form action="" method="get">
    <input type="text" name="search">
    <button type="submit" name="submit">Search</button>
</form>
</body>
</html>