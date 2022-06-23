<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="assets\css\layout.css">
   <link rel="stylesheet" href="assets\css\style.css">
   <link rel="stylesheet" href="assets\css\fonts.css">
   <title>Edit</title>
</head>
<body>
<header class="header">
    <?php
    include 'header.php';

    if(isset($_SESSION['acc_state']) && $_SESSION['acc_state'] == 'banned') 
    {
        header("location: http://localhost/err_page.php?id=1");
        exit;
    } 
    ?>
</header>

<div class="container">
    <h2>Edit your post</h2>
    <?php
    /*$cat_id = $_GET['id'];
    $cat_state_id = $_GET['state_id'];*/
    $type = $_GET['type'];

    
   
    switch($type)
    {
        case 'post':
            $post_id = $_GET['id'];
            $query = "SELECT * FROM posts WHERE post_id = ".$post_id." AND post_crt = ".$_SESSION['id'];

            if($result = $conn->query($query))
                {
                    if($result->num_rows == 0)
                    {
                        header("location: http://localhost/err_page.php?id=2");
                        exit;
                    }
                    else
                    {   
                        while($row = $result->fetch_assoc())
                        {
                            $subject = $row['post_subject'];
                            $content = $row['post_content'];
        
                            echo"<form method='post' action='edit.php?id=".$post_id."&type=post'> 
                            <input type='text' name='post_subject' placeholder='".$subject."'>
                            <br>
                            <br>
                            <textarea name='post_content' placeholder='Say something...'>".$content."</textarea><br>
                            <br>";
                                
                            if($_SESSION['role'] == 'admin')
                            {
                                echo"<select name='post_type'>
                                    <option value='' disabled='' selected='' hidden=''>Post type</option>
                                    <option value='1'>Public</option>
                                    <option value='2'>Admin only</option>
                            </select><br>";
                            }
                        }
                    }
                }
            break;
        case 'reply':
            $reply_id = $_GET['id'];
            $query = "SELECT * FROM replies WHERE reply_id = ".$reply_id." AND reply_crt = ".$_SESSION['id'];

            if($result = $conn->query($query))
                {
                    if($result->num_rows == 0)
                    {
                        header("location: http://localhost/err_page.php?id=2");
                        exit;
                    }
                    else
                    {   
                        while($row = $result->fetch_assoc())
                        {
                            $content = $row['reply_content'];
        
                            echo"<form method='post' action='edit.php?id=".$reply_id."&type=reply'> 
                            <textarea name='reply_content' placeholder='Say something...'>".$content."</textarea><br>
                            <br>";
                        }
                    }
                }
            break;
        default:
            header("location: http://localhost/err_page.php?id=2");
            exit;
    }
    

	?>
    <input type='submit' value='Post' name='submit' class='btn'><br>
        </form>
</div>
<footer>
<div class="footer">
    <h3>Contact gensokyoportal_staff@gnsk.com</h3>
    <h4>2022</h4>
</div>
</footer>
 </body>
 <script src="assets\js\modal.js"></script>
</html>