<?php
require_once 'connection.php';

if(isset($_GET['id']))
{
    $reply_id = $_GET['id'];
    $query = "DELETE FROM replies WHERE replies.reply_id=".$reply_id;
    if($result = $conn->query($query))
    {
        header("location: http://localhost/home.php");
        exit;
    }
}
?>