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
   <link rel="stylesheet" href="assets/vendor/animate.css/animate.min.css">
   <link rel="icon" href="assets/img/favicon.png">
   <title>Gensokyo Portal</title>

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
    <section class="about">
        <h2 class="animate__animated animate__fadeIn">Welcome to <span>Gensokyo Portal</span></h2>
        <h4>The main place for everyone to hang out and communicate</h4>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
          <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
          </defs>
          <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
          </g>
          <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
          </g>
          <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
          </g>
        </svg>
        </section>
    <div class="forum_container">
          
                <?php
                    //higher category var
                    $h_cat_id = NULL;
                    $h_cat_name = NULL;

                    //board var
                    $cat_id = NULL;
                    $cat_state_id = NULL;
                    $cat_name = NULL;
                    $cat_description = NULL;

                    //post var
                    $post_id = NULL;
                    $post_state_id = NULL;
                    $post_name = NULL;
                    $post_date = NULL;
                    $post_creator = NULL;
                    $post_creator_id = NULL;

                    //higher category def
                    $query = "SELECT * FROM higher_categories";
                    if($result = $conn->query($query));
                    {
                        while($row = $result->fetch_assoc())
                        {
                            //$row = json_decode(json_encode($object), true);
                            $h_cat_id = $row['h_cat_id'];
                            $h_cat_name = $row['h_cat_name'];
                            echo
                            "<div class='forumMain''>
                            <h2><a href='http://localhost/h_cat_page.php?id=".$h_cat_id."'>".$h_cat_name."</a></h2>
                            </div>";
                            //print_r($h_cat_id);
                        }
                        
                    }
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
                    {
                        echo"<div class='buttons'>
                        <br><a href='register.php?id=add' target='_self' 
                        class='button' style='margin-left: 0px;'>Add a user</a>";
                        if((isset($_SESSION['username']) && $_SESSION['username'] == '_=candidfriend=_'))
                        echo
                        "<a href='create_cat_page.php?id=h_cat' target='_self' 
                        class='button' style='margin-left: 0px;'>Create a category</a></div>";
                    }
                ?>
        
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