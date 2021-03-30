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
    <link rel="stylesheet" href="static/css/style.css">
</head>
<body>
    <div class="container-fluid" id="signin_outer_div" >
        <div class="row">
            <div id="signin_div_1" class="col-md-4"></div>
            
            <div class="col-md-4"  id="signin_form">
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
            
            <div id="signin_div_2" class="col-md-4">

            </div>

            <div class="container-fluid" id="box_svg">
                
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 408">
                  <defs>
                  <style>.cls_signin_svg{fill:url(#linear_gradient_signin);}</style>
                  <linearGradient id="linear_gradient_signin" x1="0.09" y1="190.65" x2="1920.09" y2="190.65" gradientTransform="translate(1920.09 394.65) rotate(180)" gradientUnits="userSpaceOnUse">
                  <stop offset="0" stop-color="aqua"/>
                  <stop offset="0.54" stop-color="#29abe2"/>
                  <stop offset="1" stop-color="#662d91"/>
                  </linearGradient>
                  </defs>
                  <title>Layer 1</title>
                  <g id="Layer_2" data-name="Layer 2">
                  <g id="Layer_1-2" data-name="Layer 1">
                  <path class="cls_signin_svg" d="M0,0H1920c-144,108.15-267.64,138.76-358,145-160.82,11.1-210.47-55.42-374-35-171.85,21.46-167,101.17-345,140-214.45,46.78-289.62-54-499-17C259.53,247.94,137.45,288.09,0,408Z"/>
                  </g>
                  </g>
                </svg>

             </div>
        
        </div>
    </div>
    
           
       
</body>
</html>