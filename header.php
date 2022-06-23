<?php 
session_start();
include_once 'connection.php';

echo"<div class='container'>
     <a href='home.php'><img src='assets/img/logo.png' alt='logo' height='10%' href='home.php' class='logo'></a>
     <div class='nav'>";

if(!isset($_SESSION['role']))
{
    echo"<p><button class='button' id='myBtn'>Sign in</button> | <a href='register.php?id=signup'>Sign up</a></p>";
    include 'sign_in_button.html';     
    echo"</div>
         </div>";
}
else
{
    echo"<p>
           <a href='user.php?id=".$_SESSION['id']."'>".$_SESSION['f_name']."</a>
         | <a href='signout.php'>Sign out</a></p>
         </div>
         </div>";
}  
?>