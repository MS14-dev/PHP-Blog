<!-- Import database connection -->
<?php require('./static/database.php') ?>
<!-- control the validation part and other form actions -->
<?php 
    session_start();
     
    $errors = array();
    if(isset($_POST['login'])){
        
        if(($_POST['email'] != '') && ($_POST['password'] != '')){
            $email = sha1($_POST['email']);
            $password = sha1($_POST['password']);

            $query_1 =  "SELECT * FROM users WHERE email='$email'";

            $result_row_1 = mysqli_query($database,$query_1);

            if(mysqli_num_rows($result_row_1) != 0 ){

                $result_row_1_data = mysqli_fetch_assoc($result_row_1);
                
                if($result_row_1_data['password'] == $password){
                    $_SESSION['user_email'] = $_POST['email'];
                    $_SESSION['user_name']  = $result_row_1_data['first_name']." ".$result_row_1_data['last_name'];
                    $_SESSION['first_name'] = $result_row_1_data['first_name'];
                    $_SESSION['last_name'] = $result_row_1_data['last_name'];
                    $_SESSION['image'] = $result_row_1_data['image'];
                    header('location:myaccount.php');
                }
                else{
                    $errors[] = "Pleace Check the password";
                }
            }
            else{
                $errors[] = "Pleace Check the email";
            }

            
        }
        else{
            $errors[] = "All Fields must needed to be filed";
        }
        
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mash Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./static/css/style.css">
    <script src="./static/js/index.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
            <?php require_once('./components/menu.php')?>
            
            <div class="col-md-4">
                <?php 
                   if(count($errors) != 0){
                       foreach($errors as $error){
                            echo "<h6> {$error} <h6>";
                       }
                    }
                ?>
               <form action="index.php" method="post">
                  <input type="email" name="email" placeholder="email"><br/><br/>
                  <input type="password" name="password" placeholder="password"><br/><br/>
                  <input class="btn btn-success" type="submit" value="login" name="login">
               </form>
            </div>
        
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">HI</div>
            <div class="col-md-4">HI</div>
            <div class="col-md-4">HI</div>
        </div>
    </div>
</body>
</html>