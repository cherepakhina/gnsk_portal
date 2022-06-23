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
   <link rel="icon" href="assets/img/favicon.png">
   <title>Sign up</title>
</head>
<body>
    <header class="header">
        <?php
        include 'header.php';
        ?>
    </header>
    <div class="container" style='

      background-color: #c8dbcc;'>
        <?php 

        require_once 'connection.php';

        $page_id = $_GET['id'];

        switch($page_id) 
        {
            case 'signup': 
                echo"
                <h1>Sign up</h1>
                <form method='post' action='signup.php?id=1'> 
                <input type='email' name='email' required='' placeholder='Email'><br>
                <br>
                <input type='text' name='username' required='' placeholder='Username'><br>
                <br>
                <input type='text' name='fname' required='' placeholder='First Name'><br>
                <br>
                <input type='text' name='lname' required='' placeholder='Last Name'><br>
                <br>
                <input type='password' name='password' required='' placeholder='Password'><br>
                <br>
                <input type='password' name='confirm_password' required='' placeholder='Confirm Password'><br>
                <br>
                <input type='submit' value='Sign up' name='submit' class='btn'>
                </form>";
                break;

            case 'add':
                if(isset($_SESSION['acc_state']) && $_SESSION['acc_state'] == 'banned') 
                {
                    header("location: http://localhost/err_page.php?id=1");
                    exit;
                }
                else if(isset($_SESSION['role']) && $_SESSION['role'] != 'admin')
                {
                    header("location: http://localhost/err_page.php?id=3");
                    exit;
                }
                else 
                {
                    echo"
                    <h1>Add a user</h1>
                    <form method='post' action='signup.php?id=2'> 
                    <input type='email' name='email' required='' placeholder='Email'><br>
                    <br>
                    <input type='text' name='username' required='' placeholder='Username'><br>
                    <br>
                    <input type='text' name='fname' required='' placeholder='First Name'><br>
                    <br>
                    <input type='text' name='lname' required='' placeholder='Last Name'><br>
                    <br>
                    <input type='password' name='password' required='' placeholder='Password'><br>
                    <br>
                    <input type='password' name='confirm_password' required='' placeholder='Confirm Password'><br>
                    <br>
                    <select name='role' required=''>
                        <option value='' disabled='' selected='' hidden=''>Select Role</option>
                        <option value='2'>User</option>
                        <option value='1'>Admin</option>
                    </select><br>
                    <input type='submit' value='Add user' name='submit' class='btn'>
                    </form>";
                }
                break;

            default:
                header("Location: http://localhost/err_page.php?id=2");
                exit();
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