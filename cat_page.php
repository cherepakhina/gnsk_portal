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
    <title>Board</title>
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
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      background-color: #c8dbcc;'>
        <div class="forum">
            <table>
                <tr>
                    <th colspan="2"><h3>Post</h3></th>
                    <th><h3>Post date</h3></th>
                    <th><h3>Posted by</h3></th>
                    <th><h3>ID</h3></th>
                </tr>
                <?php 
                $cat_id = $_GET['id'];
                $query = "SELECT * FROM categories WHERE cat_id = ".$cat_id.";";
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
                            $cat_id = $row['cat_id'];
                            $cat_name = $row['cat_name'];
                            $cat_description = $row['cat_description'];
                            echo"<h2>Posts in ".$cat_name.": </h2>";
                        }
                        $result->free();
                    }
                }

                $query = 
                    "SELECT * FROM posts INNER JOIN users ON posts.post_crt = users.id 
                    INNER JOIN cat_state ON posts.post_state_id = cat_state.state_id
                    WHERE post_cat = ".$cat_id.";";
                    if($result = $conn->query($query))
                    {
                        while($row = $result->fetch_assoc())
                        {
                            $post_id = $row['post_id'];
                            $post_state_id = $row['state_title'];
                            $post_subject = $row['post_subject'];
                            $post_content = $row['post_content'];
                            $post_date = $row['post_date'];
                            $post_crt = $row['username'];
                            $crt_id = $row['id'];
                            echo"<tr>
                                <td>
                                <a href='http://localhost/post_page.php?id=".$post_id."&state_id=".$post_state_id."
                                '>".$post_subject."</a></td>
                                <td>
                                <a href='http://localhost/post_page.php?id=".$post_id."&state_id=".$post_state_id."
                                '>".$post_content."</a></td>
                                <td>".$post_date."</td>
                                <td>
                                <a href='http://localhost/user.php?id=".$crt_id."'>".$post_crt."</td>
                                <td>".$post_id."</td>
                                </tr>";
                        }
                    $result->free();
                    }
                ?>
            </table>
        </div>
        <div class="button">
            <?php
            if(($_GET['state_id']!='2') || (isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) 
            {
                echo"<br><a href='create_post_page.php?id=".$cat_id.
                    "&state_id=".$_GET['state_id']."' target='_blank' class='button' style='margin-left: 0px;'>
                    \t\tCreate a post</a>";
            }
            if($_SESSION['role'] == 'admin')
            {
                echo
                    "<tr><th><a href='http://localhost/delete_cat.php?id=".$cat_id."' 
                    target='_blank' class='button'>Remove the board</a></th></tr>";
            }
            ?>
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