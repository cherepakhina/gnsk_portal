<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="assets/css/layout.css"> 
   <link rel="stylesheet" href="assets/css/fonts.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="icon" href="assets/img/favicon.png">
   <title>Post</title>
   <style>
        .table a {
        display:block;
        text-decoration:none;
       }
   </style>
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
<div class="container" style='
      background-color: #c8dbcc;'>
    <div class="OP">
        <table>
            <?php
                $post_id = $_GET['id'];
                $query = 
                        "SELECT * FROM posts INNER JOIN users ON posts.post_crt = users.id 
                        INNER JOIN user_roles ON users.role_id = user_roles.roles_id 
                        INNER JOIN acc_state ON users.user_state_id = acc_state.acc_state_id
                        WHERE post_id = ".$post_id;
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
                            $post_subject = $row['post_subject'];
                            $post_date = $row['post_date'];
                            
                            $post_creator_id = $row['id'];
                            $post_creator_pfp = $row['photo'];
                            $post_creator_username = $row['username'];
                            $post_creator_name = $row['full_name'];
                            $post_creator_role = $row['title'];
                            $post_creator_state = $row['acc_state_title'];

                            $post_content = $row['post_content'];
                            $post_edited = $row['edited'];

                            echo"<tr>
                                <th></th>
                                <th><h2>".$post_subject."</h2></th>
                                <th><h3>".$post_date."</h3></th>
                                <th style='width: 30;'><h3>".$post_id."</h3></th>
                                </tr>
                                <tr>
                                <th><img src='".$post_creator_pfp."' style='height: 200px;'>
                                <h3><a href='http://localhost/user.php?id=".$post_creator_id."'>"
                                .$post_creator_username."</a></h3>
                                <h3>".$post_creator_name."</h3>
                                <h3>".$post_creator_role."</h3>";
                            if($post_creator_state == 'banned')
                            {
                                echo"<h3>".$post_creator_state."</h3></th>";
                            }    
                            echo"<td><h3>".$post_content."</h3></td></tr>";
                            if($post_edited == '1')
                            {
                                echo"<td>edited</td></tr>";  
                            }
                            echo"<tr>
                                <th></th>
                                <th></th>
                                <th style='width: 30;'></th>";
                                if($_GET['state_id']!='admin_only' || $_SESSION['role'] == 'admin')
                                {
                                    include 'add_reply_post_button.php';
                                }
                                else echo "<th></th>";
                                if(isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || 
                                $_SESSION['id'] == $post_creator_id)) {
                                    echo
                                    "<th><a href='http://localhost/delete_post.php?id=".$post_id."' 
                                    target='_blank' class='button'>Delete</a>";
                                }
                                if(isset($_SESSION['id']) && $_SESSION['id'] == $post_creator_id)
                                {
                                    echo"<a href='http://localhost/edit_page.php?type=post&id=".$post_id."' 
                                        target='_blank' class='button'>Edit</a></th>";
                                }

                        }
                        $result->free();
                    }
                }
                echo"</tr>";
            ?>

        </table>       
    </div>
    <div class="replies">
        <table>
            <?php
                $query = 
                "SELECT * FROM replies INNER JOIN posts ON replies.reply_post = posts.post_id 
                INNER JOIN users ON replies.reply_crt = users.id 
                INNER JOIN user_roles ON users.role_id = user_roles.roles_id 
                INNER JOIN acc_state ON users.user_state_id = acc_state.acc_state_id
                WHERE reply_post = ".$post_id;
                if($result = $conn->query($query))
                {
    
                        while($row = $result->fetch_assoc())
                        {
                            $reply_id = $row['reply_id'];
                            $reply_date = $row['reply_date'];

                            $reply_creator_id = $row['id'];
                            $reply_creator_pfp = $row['photo'];
                            $reply_creator_username = $row['username'];
                            $reply_creator_name = $row['full_name'];
                            $reply_creator_role = $row['title'];
                            $reply_creator_state = $row['acc_state_title'];

                            $reply_content = $row['reply_content'];
                            $reply_edited = $row['edited'];

                            echo"<tr>
                            <th></th>
                                <th>".$reply_date."</th>
                                <th style='width: 30;'>".$reply_id."</th></tr>
                                <tr>
                                <th style='width: 50;'><img src='".$reply_creator_pfp."' style='height: 200px;'>
                                <h3><a href='http://localhost/user.php?id=".$reply_creator_id."'>
                                ".$reply_creator_username."</a></h3>
                                <h3>".$reply_creator_name."</h3>
                                <h3>".$reply_creator_role."</h3></th>";
                            if($reply_creator_state == 'banned')
                            {
                                echo"<h3>".$reply_creator_state."</h3></th>";
                            }    
                            echo"<td>".$reply_content."</td>";
                            if($reply_edited == '1')
                            {
                                echo"<td>edited</td></tr>";  
                            }
                            if((isset($_SESSION['role']) && (isset($_SESSION['id'])))) {
                                if($_SESSION['role'] == 'admin' || $_SESSION['id'] == $reply_creator_id){
                                echo
                                "<tr><th><a href='http://localhost/delete_reply.php?id=".$reply_id."' 
                                target='_blank' class='button'>Delete</a></th></tr>";
                                }
                            }
                            if(isset($_SESSION['id']) && $_SESSION['id'] == $reply_creator_id)
                            {
                                echo"<a href='http://localhost/edit_page.php?type=reply&id=".$reply_id."' 
                                    target='_blank' class='button'>Edit</a></th>";
                            }
                            echo"</tr>";
                    }
                    $result->free();
                }
            ?>
        </table>
    </div>
</div>
<footer>
<div class="footer">
    <h3>Contact: gensokyoportal_staff@gnsk.com</h3>
    <h4>2022</h4>
</div>
</footer>
 </body>
 <script src="assets\js\modal.js"></script>
</html>