<?php
require_once('db.php');
session_start();
include('header.php');
//on controle si le user est déja connecté si c'est le cas on l'envoie directement à index.php sinon on continue l'inscription
if(isset($_SESSION['user'])){
    header("Location:index.php");
}

// controle que les chemps soient pas vides si oui ERROR message
if(isset($_REQUEST['register'])){
    $username = htmlspecialchars($_POST['username']);
    $email = strtolower(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
    $password = htmlspecialchars($_POST['password']);
    

    if(empty($username)){
        $usernameErr = "Please enter a username!";
    }
    if(empty($email)){
        $emailErr = "Please enter an email address!";
    }
    if(empty($password)){
        $passErr1 = "Please enter a password!";   
    }
    // le password ne doit pas etre moins de 6 caracteres  
    if(strlen($password) < 6){
        $passErr2 = "Password must be at least 6 characters!";
    }
        // s'il y a pas de ERROR message(les chemps sont remplis et le password >=6 caracteres) on vérifie si cet email déja a été utilisé (si exist dans notre BDD) si oui, le user doit se connecter ou utiliser un autre email
    if(!$usernameErr && !$emailErr && !$passErr1 && !$passErr2){
        try{
            $select_stmt = $pdo->prepare("SELECT user_name,email FROM user WHERE email = :email");
            $select_stmt->execute([':email' => $email]);
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            //if email exists Err message
            if(isset($row['email']) == $email){
                $passExistErr= "Email adresse already exists, please choose another or login!";
                echo $passExistErr;
            }
            //if email dose not exists
            else
            {   //on hash le password (question de security)
                $hashed_password = password_hash($password,PASSWORD_DEFAULT);
                $regiter_date = new DateTime();
                $regiter_date = $regiter_date->format('Y-m-d H:i:s');
                // on va enregistrer les donnees dans notre BDD
                $insert_stmt = $pdo->prepare("INSERT INTO user (user_name, email, password,register_date) VALUES(:username, :email, :password, :register_date)");

                if($insert_stmt->execute(
                    [
                        ':username'=> $username,
                        ':email'=> $email,
                        ':password'=>  $hashed_password,
                        ':register_date'=> $regiter_date,
                        
                    ]
                )
                ){
                    header("Location:first.php");
                }
                
            }
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        
    }

}





?>
    <section class="register">
        <form action="register.php" method="post">   
            
                <?php if($usernameErr):?>
                    <?php echo $usernameErr; ?>
                    <?php endif;?><br>
                    <div class="mb-3 form-check" style="color:#fff";>
                <input type="text" name="username" placeholder="username">
            </div>
         
                <?php if($emailErr):?>
                    <P><?php echo $emailErr;?></P>
                    <?php endif;?>
                    <div class="mb-3 form-check" style="color:#fff";>
                <input type="email" name="email" placeholder="email">
            </div>
                <?php if($passwordErr):?>
                    <P><?php echo $passwordErr;?></P>
                    <?php endif;?>
                    <?php if($passErr2):?>
                    <P><?php echo $passErr2;?></P>
                    <?php endif;?>
                    <div class="mb-3 form-check" style="color:#fff";>
                <input type="password" name="password" placeholder="password">
                <div>
                <div class="">
                <button type="submit" name="register" class="btn btn-primary btn-sm" style="margin-top: 10px;">Submit</button>
            </div>
                </div>
            </div>
            
        </form>
    </section>
    
</body>
</html>
