<!-- database connection -->
<?php require_once('static/database.php'); ?>

<?php 
   session_start();
   if(isset($_POST['submit'])){
           $errors = array();

           $input_values = array("first name"=>$_POST['f_name'],"last name"=>$_POST['l_name'],
                            "email"=>$_POST['email'],"password"=>$_POST['password'],
                            );
           
           foreach ($input_values  as $label=> $input){
                    if($input==''){
                        $errors[] = "$label is required";
                    }
            }
           
            
           if(count($errors)==0){
                //$target = "static/images/".basename($_FILES['image']['name']);
                
                $image = $_FILES['image'];

                $image_name = $_FILES['image']['name'];
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_size = $_FILES['image']['size'];
                $image_error = $_FILES['image']['error'];
                $image_type = $_FILES['image']['type'];

                $image_exe = explode('.',$image_name);
                $image_exe_actual = strtolower(end($image_exe));
                $allow_exe = array('jpg','jpeg','png');

                if(in_array($image_exe_actual,$allow_exe)){
                     if($image_error===0){
                         $image_name_new = uniqid('',true).".".$image_exe_actual;
                         $image_destination = "static/images/".$image_name_new;
                         move_uploaded_file($image_tmp_name,$image_destination);
                         
                         $f_name = $_POST['f_name'];
                         $l_name = $_POST['l_name'];
                         $email = sha1($_POST['email']);
                         $password = sha1($_POST['password']);
                
                         $query = "INSERT INTO users (first_name,last_name,email,password,image) 
                                   VALUES('$f_name','$l_name','$email','$password','$image_destination')";
                
                         mysqli_query($database,$query);
                         $_SESSION['user_name'] = $_POST['f_name']." ".$_POST['l_name'];
                         $_SESSION['user_email'] = $_POST['email'];
                         $_SESSION['first_name'] = $f_name;
                         $_SESSION['last_name'] = $l_name;
                         $_SESSION['image'] = $image_destination;

                         header('location:myaccount.php');
                    
                }
                else{
                    $errors[] = "Image type Error";
                }

                
        
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./static/css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
               <div id="signin_error_div">
                  <?php 
                   if(isset($errors)){
                       foreach($errors as $error){
                         echo "<h6 class='signin_error'>$error</h6>";
                       }
                   }
                  ?>
                 
               </div>
               <h1>Signin</h1>
               <form action="signin.php" method="post" enctype="multipart/form-data">
                 <a href="index.php">Home</a>
                 <input class="form-control" type="text" placeholder="first name" name="f_name"><br/>
                 <input class="form-control" type="text" placeholder="last name" name="l_name"><br/>
                 <input class="form-control" type="email" placeholder="email" name="email"><br/>
                 Profile Image : <input type="file" placeholder="image" name="image" required><br/>
                 <input class="form-control" type="password" placeholder="password" name="password"><br/>
                 <input class="btn btn-success col-12" type="submit" value="submit" name="submit">
               </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>