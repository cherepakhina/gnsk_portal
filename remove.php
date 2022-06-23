<?php
require_once 'connection.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "DELETE users, roles FROM users INNER JOIN roles WHERE users.role_id=roles.id AND users.id='$id'";
    if($result = $conn->query($query))
    {
        header("location: http://localhost/home.php");
        exit;
    }
}
?>