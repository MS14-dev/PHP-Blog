<!-- Import database connection -->
<?php require('./static/database.php') ?>
<!-- control the validation part and other form actions -->
<?php 
    session_start();
    //require_once('static/database.php');
     
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
//function handling on article search
    if(isset($_POST['search'])){

        if(isset($_POST['search_input'])){
            $search_input = $_POST['search_input'];
            $search_article_query = "SELECT title,body FROM articles WHERE body LIKE '%$search_input%'";
            $search_result = mysqli_query($database,$search_article_query);
            
            $search_result_rows = mysqli_fetch_all($search_result);
            if(count($search_result_rows) != 0){
                echo print_r($search_result_rows);
                $_SESSION['search_result_rows'] = $search_result_rows;
                header('location:articleResult.php');
            }
            else{
                echo "<h5 style='color:red'>Sorry No matched result</h5>";
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
    <title>Mash Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/style.css">
    <script src="./static/js/index.js"></script>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">  
            <div id="menu_div" class="col-md-12 container-fluid">
               <?php require_once('./components/menu.php')?>
            </div>
    
            <div class="col-md-4">
                
            </div>
            <!--Search some articles-->
            <div id="search_article_div" class="col-md-4">
               <form action="index.php" method="POST">
                   <input type="text" placeholder="search articles" name="search_input" >
                   <input type="submit" value="search" name="search">
                </form>
            </div>
            <!--Signin function-->
            <div id="login_form_div" class="col-md-4">
               
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
             <div class="container-fluid"  id="index_div">
               <svg 
                  id="Layer_1" 
                  data-name="Layer 1" 
                  xmlns="http://www.w3.org/2000/svg" 
                  xmlns:xlink="http://www.w3.org/1999/xlink" 
                  viewBox="0 0 1920 1080"
               >

               <defs>
               <style>.cls-1{fill:url(#linear-gradient);}</style>

               <linearGradient id="linear-gradient" y1="540" x2="1920" y2="540" gradientUnits="userSpaceOnUse">
               <stop id="Layer_2" offset="0" stop-color="aqua"/><stop offset="0.97" stop-color="#93278f"/>
               </linearGradient></defs><title>main</title>
               <path id="Layer_3" class="cls-1" d="M1920,1080H0c131.77,0,321.38-18.7,515.5-116.5,217.89-109.78,186-190.59,471-369,268.84-168.32,391.09-155.17,514-326,35.09-48.77,68.88-110.66,149-169C1744.24,30.51,1846.71,8,1920,0Z"/>

               </svg>
            </div>
        
        </div>
    </div>

    
</body>
</html>