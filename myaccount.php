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
  <link rel="stylesheet" href="static/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
</head>
<body>
   <?php require_once('components/menu.php'); ?>
   <div class="container-fluid">
     <div class="row">
       
       <div class="col-md-4" id="myaccount_svg_div">
          <?php require_once('./components/menu.php'); ?>
          <img src=<?php echo $_SESSION['image']; ?> alt="Hi" width="200px" height="200px" style="border-radius: 90px;margin-top:50%;border: 5px solid gray">
          <div>
            <svg id="boat_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1332.9 401.86"><defs><style>.cls_boat_svg{fill:url(#linear_gradient_boat);}</style><linearGradient id="linear_gradient_boat" y1="200.93" x2="1332.9" y2="200.93" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#f7931e"/><stop offset="1" stop-color="#42210b"/></linearGradient></defs><title>boat_svg</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path id="boat_svg" class="cls_boat_svg" d="M10.9,11.27C-34.23,65,64.52,282,238.4,367.77c146.8,72.42,263.87,10.22,559.5-11a2464,2464,0,0,1,468.5,11q33.24-70.26,66.5-140.5c-36.79,4-94,9.27-164,11-102,2.52-358.44.78-743-112C134.9,40.92,43.75-27.88,10.9,11.27Z"/></g></g></svg>
            <svg id="ocean_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1559 180"><defs><style>.cls_ocean_svg{fill:url(#linear_gradient_ocean);}</style><linearGradient id="linear_gradient_ocean" x1="789.25" y1="-1017.91" x2="777.69" y2="402.62" gradientUnits="userSpaceOnUse"><stop offset="0.61" stop-color="#fff"/><stop offset="0.67" stop-color="#cfe4f2"/><stop offset="0.81" stop-color="#57a2d3"/><stop offset="0.91" stop-color="#0071bc"/></linearGradient></defs><title>ocean_svg</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path id="ocean_svg" class="cls_ocean_svg" d="M173,115c30.52-21.78,51.39-44.65,99-72A487.33,487.33,0,0,1,371,0c-49.12,95.52-51,122.06-43,128,15.23,11.25,64.44-52.67,162-87A380.12,380.12,0,0,1,602,20c-38.08,5.34-65.24,26.83-69,52-1.51,10.13-.22,27.35,11,36,25.7,19.82,78.22-24.86,149-52,39.44-15.12,98.28-30.07,179-25-30.09,4.09-52.16,22.65-56,45-.29,1.67-3.77,23.39,7,30,16.71,10.25,46.63-28.78,97-52,25.89-11.94,61.64-21.75,110-19-23.91,11.72-36.94,27.66-34,39,2.53,9.75,16.27,13.8,17,14,27.55,7.73,48.14-27.48,88-45,18.48-8.12,48.14-15.53,93-6-17.72,6.47-29.77,21.35-30,37-.32,21.77,22.38,34.84,35,39,17.28,5.7,33,.41,54-7a200.6,200.6,0,0,0,43-21c21.91-14.61,65.8-30.95,162-39-26.17,5.83-43.1,21.24-43,36,.08,11.55,10.56,20.3,15,24,18.69,15.59,39.25,13.8,56,17,19.47,3.72,45.55,16.44,73,57H0C84,168.23,138.36,139.72,173,115Z"/></g></g></svg>
          </div>
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
       
       <div class="container">
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
