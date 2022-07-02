<?php

require_once('db.php');
session_start();
include('header.php');

// if(isset($_SESSION['userEmail'])){
//     header('location:index.php');
//     exit();
// }

//page:login 

//on controle si les champs email et password est bien rempli sinon meggases ERROR
if(isset($_REQUEST['login'])){
    
    $email = strtolower(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
    $password = htmlspecialchars($_POST['password']);

    if(empty($email)){
        $nameErr='Please enter your email';
    }

    if(empty($password)){
        $passwordErr = 'Please enter your password';
    }
    else
    {
        try {
            //on controle si le mail est bien dans notre database(si le user est déja inscri)
            $select_statment = $pdo->prepare("SELECT * FROM user WHERE email = :email");
            $select_statment->execute([
            ':email' => $email
            // ':password' => $password
        ]);
            // pull out the row from database
            $row = $select_statment->fetch(PDO::FETCH_ASSOC);
            //if there was a row return(user already exist)
            if ($select_statment->rowCount() > 0) {
                    // on controle si le password corespond bien à celui de notre bd
                if (password_verify($password, $row['password'])) {
                    // populating session with data
                    $_SESSION['userName']= $row["user_name"];
                    $_SESSION['userEmail']= $row ["email"];
                    $_SESSION['userId']= $row["id"];
                    header('location:index.php');
                    
                } else {
                    $errorMessage = 'Wrong mail or password';
                }
            } else {
                $errorMessage = 'Wrong mail or password!';
                echo $errorMessage;
            }
        }
        catch (PDOException $e) {
            echo "ERROR!!!: " . $e->getMessage();
        }
    }
}
?>
</body>
</html>
<form action="" method="post">
  <div class="mb-6">
    <label for="exampleInputEmail1" class="form-label" style="color:#fff";>Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="width:300px;">
    <div id="emailHelp" class="form-text" style="color:#fff";><?php if(isset($nameErr)):?>
            <p><?php echo $nameErr ?></p>
            <?php endif?></div>
  </div>
  <div class="mb-6">
    <label for="exampleInputPassword1" class="form-label" style="color:#fff";>Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" style="width: 300px;">
    <div id="emailHelp" class="form-text" style="color:#fff";><?php if(isset($passwordErr)):?>
                    <p><?php echo $passwordErr; ?></p>
                    <?php endif ?></div>
  </div>
  <button type="submit" name ="login" class="btn btn-primary">Submit</button>
</form>



