<?php
session_start();

require_once 'connection.php';

if(isset($_GET['id'], $_GET['type']))
{
    $type = $_GET['type'];

    switch($type)
    {
       case 'post':
        $post_id = $_GET['id'];
        $subject = $_POST['post_subject'];
        $post_content = $_POST['post_content'];
        $post_type = $_POST['post_type'];
    
        if(isset($subject))
        {
            $query = "UPDATE posts SET post_subject = '$subject' WHERE post_id = '$post_id'";
            if($result = $conn->query($query))
            {
                $query = "UPDATE posts SET edited = '1' WHERE post_id = '$post_id'";
                if($result = $conn->query($query))
                {
                    header("Location: http://localhost/home.php");
                    exit();
                }
            }
        }
    
        if(isset($post_content))
        {
            $query = "UPDATE posts SET post_content = '$subject' WHERE post_id = '$post_id'";
            if($result = $conn->query($query))
            {
                $query = "UPDATE posts SET edited = '1' WHERE post_id = '$post_id'";
                if($result = $conn->query($query))
                {
                    header("Location: http://localhost/home.php");
                    exit();
                }
            }
        }
            break; 
        case 'reply':
            $reply_id = $_GET['id'];
            $reply_content = $_POST['reply_content'];

            $query = "UPDATE replies SET reply_content = '$reply_content' WHERE reply_id = '$reply_id'";
            if($result = $conn->query($query))
            {
                $query = "UPDATE replies SET edited = '1' WHERE reply_id = '$reply_id'";
                if($result = $conn->query($query))
                {
                    header("Location: http://localhost/home.php");
                    exit();
                }
            }
            break;
    }
    


}

?>