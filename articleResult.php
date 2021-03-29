<?php 

session_start();

if(count($_SESSION['search_result_rows']) != 0){

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
</head>
<body>
    <a href="index.php">Home</a>
    <?php 
    
     foreach($_SESSION['search_result_rows'] as $article){
         echo "<h3>$article[0]</h3>";
         echo "<p>$article[1]</p><br/>";
     }
    $_SESSION['search_result_rows'] = array();
    
    ?>
</body>
</html>