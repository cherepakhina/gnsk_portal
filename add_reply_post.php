<?php
session_start();
include_once 'connection.php';

if(isset($_POST['submit']))
{
    $post_id = $_GET['id'];
    $reply_message = $_POST['message'];
    $creator = $_SESSION['id'];
    $state = $_GET['state_id'];
    
    $query = "INSERT INTO replies (reply_content, reply_date, reply_post, reply_crt, edited) 
              VALUES ('$reply_message', NOW(), '$post_id', '$creator', '0')";

    if ($result = $conn->query($query)) {
        header("Location: http://localhost/post_page.php?id=".$post_id."&state_id=".$state);
        exit();
    } else {
        echo "Error: " . $sql . "
        " . mysqli_error($conn);
	 }
     mysqli_close($conn);
}

?>