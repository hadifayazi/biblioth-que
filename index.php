<?php
include('headertwo.php');
require_once('db.php');
session_start();
 ?>
    <?php
//cette page est uniqement pour afficher des livres (pas de foncionalité )

    if(!isset($_SESSION['userName'])){
        header("Location:first.php");
    }
    
     ?>
     <body>
        <section class="gen-container">
        <div class="container">
            <div class="row text-center py-5">
                <?php
                $sql = "SELECT * FROM bookOrder";
                $stmt = $pdo->query($sql);
                while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){?>
                    <?php $id= $row['id'];
                    $title= $row['title'];
                    $author= $row['author'];
                    $published= $row['published'];
                    $price= $row['price'];?>
                <div class="col-md3 col-sm-6 my-3">
                    <form action="" method="post">
                        <div class="card shadow">
                            <div>
                                <img src="" alt="" class="img-fluid card-img-top">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $title;?></h4>
                                <h4>Author :<?php echo $author; ?></h4>
                                <h4>Published: <?php echo $published;?></h4>
                                <input type="text" class="form-control" value="1" style="width:100px;margin-left:210px">
                                <h4>Price: <?php echo $price; ?></h4>
                                <button type="submit" name="add" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php }?>
            }
            </div>
        </div> 
    </section>   
    </body>
</html>