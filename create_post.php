<?php

session_start();
include_once 'connection.php';
 
if(isset($_POST['submit']))
{  
    $subject = $_POST['post_subject'];
    $content = $_POST['post_content'];
    $post_state_id = $_POST['post_type'];
    $category = $_GET['id'];
    $cat_state = $_GET['state_id'];
    $creator = $_SESSION['id'];
    
    $query = "INSERT INTO posts (post_subject, post_content, post_date, post_state_id, post_cat, post_crt, edited) 
              VALUES ('$subject', '$content', NOW(), $post_state_id, '$category', '$creator', '0')";

    if ($result = $conn->query($query)) {
        header("Location: http://localhost/cat_page.php?id=".$category."&state_id=".$cat_state);
        exit();
    } else {
        echo "Error: " . $sql . "
        " . mysqli_error($conn);
	 }
     mysqli_close($conn);
}

?>