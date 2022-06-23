<?php
require_once 'connection.php';

if(isset($_GET['id']))
{
    $post_id = $_GET['id'];
    $query = "DELETE FROM posts WHERE posts.post_id=".$post_id;
    if($result = $conn->query($query))
    {
        header("location: http://localhost/home.php");
        exit;
    }
}
?>