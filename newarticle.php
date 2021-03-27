<?php 
  session_start();
  require_once('./static/database.php');
  
  if(isset($_SESSION['user_name'])){
      
  //validation and submition
      if(isset($_POST['submit'])){

        $email = sha1($_SESSION['user_email']);
        
        $query = "INSERT INTO articles(title,body,email) VALUES('{$_POST['title']}','{$_POST['body']}','{$email}')";
        
        mysqli_query($database,$query);
        echo "Successfully Posted";
        header('location:myaccount.php');
      }
  }
  else{
      header('location:index.php');
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
</head>
<body>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <h3>New article</h3><hr/><br/>
          <form action="newarticle.php" method="POST">
             <input name="title" type="text" placeholder="Title" class="form-control"><br/><br/>
             <textarea name="body"  cols="100" rows="20" placeholder="body"></textarea><br/>
             <input type="submit" value="post" class="btn btn-success" name="submit">
          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
    
</body>
</html>