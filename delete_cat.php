<?php
require_once 'connection.php';

if(isset($_GET['id']))
{
    $cat_id = $_GET['id'];
    $query = "DELETE FROM categories WHERE categories.cat_id=".$cat_id;
    if($result = $conn->query($query))
    {
        header("location: http://localhost/home.php");
        exit;
    }
}
?>