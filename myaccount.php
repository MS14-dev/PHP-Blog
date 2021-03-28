<?php 
 
  session_start();
  require_once('./static/database.php');
  $article_data = array();
  $article_data_row = array();
  if(isset($_SESSION['user_name'])){
    
      if(isset($_GET['submit'])){
        $email = sha1($_SESSION['user_email']);
        $query = "SELECT title,body FROM articles WHERE email='$email'";
        $article_data_row = mysqli_query($database,$query);
       
        $article_data = mysqli_fetch_all($article_data_row);
        
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
  <link rel="stylesheet" href="./static/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
</head>
<body>
   <?php require_once('components/menu.php'); ?>
   <div class="container">
     <div class="row">
       
       <div class="col-md-4">
          <?php require_once('./components/menu.php'); ?>
          <img src=<?php echo $_SESSION['image']; ?> alt="Hi" width="200px" height="200px" style="border-radius: 90px;margin-top:50%;border: 5px solid gray">
       </div>
       
       <div class="col-md-4">
         <h2 style='text-align:center'><?php echo $_SESSION['user_name']; ?></h2><hr/>
         <p><b>first name</b><?php echo $_SESSION['first_name'] ?></p>
         <p><b>lasst name</b><?php echo $_SESSION['last_name'] ?></p>
         <p><?php echo $_SESSION['user_email']; ?></p>
         <button class='btn btn-warning'><a href="newarticle.php">+new article</a></button>
       </div>
       
       <div class="col-md-4">
         <form action="myaccount.php" metod="GET">
           <input type="submit" class="btn btn-success" name="submit" value="My Articles" />
         </form>
         
         <?php 
         echo "<div id='all_user_articles_div' style='
           height: 85vh;
           overflow-x: hidden;
           overflow-y: auto;
           background: pink;
         '>";
        
         
         if(count($article_data) != 0){
             echo "<div  style='position:fixed;'>";
             echo "<button onclick='hideAllArticles()' class='btn btn-danger'> close </button>";
             echo "</div>";
             foreach($article_data as $article){
                 echo "<br>";
                 echo "<div style='background:#D6DBDF'>";
                 echo "<h3>$article[0]</h3><br/>";
                 echo "<p>$article[1]</p><br/>";
                 echo "</div>";
                 echo "<br>";
                }
            
          }
            //  for($i = 0; $i <count($article_data); $i++){
        
            //      echo "<h3>$article_data[$i][0]</h3><br/>";
            //      echo "<p>$article_data[$i][1]</p><br/>";
            //     }
            
            // }
         echo "</div>"
         ?>
         
       
       </div>
     </div>
   </div>
   
</body>

<script>
    const hideAllArticles=()=>{
    let div = document.getElementById('all_user_articles_div');
    div.style.display = 'none'
    }
  </script>
</html>
