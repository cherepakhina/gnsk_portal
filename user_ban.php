<?php

require_once 'connection.php';

if(isset($_GET['id']))
{
    $user_id = $_GET['id'];
    $query = "UPDATE users SET user_state_id = '1' WHERE users.id=".$user_id;
    if($result = $conn->query($query))
    {
        header("location: http://localhost/home.php");
        exit;
    }
    else echo"sql problem lol";
}
//SET new.full_name = CONCAT(first_name, ' ', last_name)
?>