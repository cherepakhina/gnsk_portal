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
   <title>Error!</title>
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
    ?>
</header>
<div class='container' style='
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      background-color: #c8dbcc;'>
    <div class='err_msg'>
    <?php
        if(isset($_GET['id']))
        {
            $err_id = $_GET['id'];

            switch($err_id)
            {
                case '1':
                    echo"
                        <h2>Your account was banned.</h2>
                        <br><br>
                        For further information please contact gensokyoportal_staff@gnsk.com.";
                    break;
                case '2':
                    echo"
                        <h2>Error 404</h2>
                        <br><br>
                        Sorry, the page you were looking for was not found.";
                    break;
                case '3':
                    echo"
                        <h2>Access denied.</h2>
                        <br><br>
                        You must have admin privileges to access this page.";
                    break;
                case '4':
                    echo"
                        <h2>Access denied.</h2>
                        <br><br>
                        You must be logged in to view this page.";
                    break;
                case '5':
                    echo"
                        <h2>User not found.</h2>
                        <br><br>
                        Check if the data entered is correct.";
                    break;
                default:
                /* --- */
                //add a cat flipping the bird image !!!
                    echo"
                    <h2>Error 404</h2>
                    <br><br>
                    Sorry, the page you were looking for was not found.";
                /* --- */
            }
        }
        else echo"<h2>Error 404</h2>
                 <br><br>
                 Sorry, the page you were looking for was not found.";
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