<?php 
//session_start();
if(isset($_SESSION['user_name'])){
echo "<div style={z-index:3;} class='col-md-12'>";
echo "<nav class='navbar navbar-expand-lg navbar-light bg-light'>";
echo     "<a  style='float:right;' href='signin.php'>Signin</a><hr/>";
echo     "<a  style='float:right;' href='index.php'>Home</a><br>";
echo     "<a  style='float:right;' href='logout.php'>Logout</a><br>";
echo     "<a  style='float:right;' href='myaccount.php'>{$_SESSION['user_name']}</a><br>";
echo "</nav>";
echo "</div>";
}
else{
    echo "<div style={z-index:3;} class='col-md-12'>";
    echo "<nav class='navbar navbar-expand-lg navbar-light bg-light'>";
    echo     "<a  style='float:right;' href='signin.php'>Signin</a>";
    echo     "<a  style='float:right;' href='logout.php'>Logout</a>";
    echo "</nav>";
    echo "</div>";   
}
?>