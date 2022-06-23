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
    <title>Category</title>
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
    <div class="idk">
    <div class="container">
        <div class="forum">
            <?php 
            $h_cat_id = $_GET['id'];
            $query = "SELECT * FROM higher_categories WHERE h_cat_id = ".$h_cat_id.";";
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
                        $h_cat_id = $row['h_cat_id'];
                        $h_cat_name = $row['h_cat_name'];
                        //$cat_description = $row['cat_description'];
                        echo"<h2>Boards in ".$h_cat_name.": </h2>";
                    }
                    $result->free();
                }
            }
            echo"<div class='boards'><div class='columnL'><table>";
            $query = 
                    "SELECT * FROM categories 
                    INNER JOIN higher_categories ON categories.bl_h_cat_id = higher_categories.h_cat_id
                    INNER JOIN cat_state ON categories.cat_state_id = cat_state.state_id
                    WHERE bl_h_cat_id = ".$h_cat_id;

            if($result = $conn->query($query))
            {
                while($row = $result->fetch_assoc())
                {
                    $cat_name = $row['cat_name'];
                    $cat_id = $row['cat_id'];
                    $cat_description = $row['cat_description'];
                    $cat_state_id = $row['state_id'];

                    echo
                        "<tr><th class='boardNames'>
                        <h3><a href='http://localhost/cat_page.php?id=".$cat_id."&state_id=".$cat_state_id."'>"
                        .$cat_name."</a></h3>
                        <h4>".$cat_description."</h4></th></tr>";
                }
            $result->free();
            }
            echo"</table></div>
            <div class='columnR'><table>";
            $query = 
                    "SELECT cat_id FROM categories 
                    WHERE bl_h_cat_id = ".$h_cat_id;

            if($result = $conn->query($query))
            {
                while($ids = $result->fetch_assoc())
                {
                    $cat_id = $ids['cat_id'];
                            
                    $query = 
                            "SELECT * FROM posts 
                            INNER JOIN categories ON posts.post_cat = categories.cat_id
                            INNER JOIN higher_categories ON categories.bl_h_cat_id = higher_categories.h_cat_id
                            INNER JOIN cat_state ON posts.post_state_id = cat_state.state_id
                            INNER JOIN users ON posts.post_crt = users.id 
                            WHERE bl_h_cat_id = ".$h_cat_id." AND post_id = (SELECT MAX(post_id) FROM posts 
                            WHERE post_cat =".$cat_id.")";

                            
                    if($result1 = $conn->query($query))
                    {
                        while($row = $result1->fetch_assoc())
                        {
                            $post_id = $row['post_id'];
                            $post_state_id = $row['state_title'];
                            $post_name = $row['post_subject'];
                            $post_content = $row['post_content'];
                            $post_date = $row['post_date'];
                            $post_creator = $row['username'];
                            $post_creator_id = $row['id'];
                                    
                            echo"<tr><td class='postList'><div class='postLink'><h3>
                                <a href=
                                'http://localhost/post_page.php?id=".$post_id."&state_id=".$post_state_id."
                                '>".$post_name."</a></h3></div>
                                ".$post_date."
                                <a href='http://localhost/user.php?id=".$post_creator_id."'>
                                    ".$post_creator."</a></td>
                                </tr>";
                        }
                    }
                }
            $result->free();
            }
            echo"</table></div></div>";
            ?>
        </div>
        <div class="button">
            <?php
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
            {
                echo
                    "<br><a href='create_cat_page.php?id=".$h_cat_id."' target='_self' 
                    class='button' style='margin-left: 0px;'>Create a new board</a>
                    <a href='http://localhost/home.php' target='_self' class='button'>Back</a>";
            }
            ?>
        </div>
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