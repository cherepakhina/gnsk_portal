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
   <title>User page</title>
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
    <main class="center">
        <div class="pfp">
        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $query = "SELECT *, user_roles.title FROM users 
                INNER JOIN user_roles ON users.role_id = user_roles.roles_id 
                INNER JOIN acc_state ON users.user_state_id = acc_state_id
                WHERE users.id = '$id'";
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
                            $username = $row['username'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $email = $row['email'];
                            $password = $row['password'];
                            $image = $row['photo'];
                            $role = $row['title'];
                            $acc_state = $row['acc_state_title'];
                            echo"<img src='".$image."' style='height:75%;'/>";
                        }
                    }
                }
            }
            else 
            {
                header("location: http://localhost/err_page.php?id=2");
                exit;
            }
        ?>
        </div>
        <div class="details">
            <?php
            echo"<h3>Username: ".$username."</h3>
                <br>
                <h3>Name: ".$first_name." ".$last_name."</h3>
                <br>
                <h3>User role: ".$role."</h3><br>
                <br>";
            if($acc_state != 'unbanned') {
                    echo"<h3>This account is banned.</h3>";
            }
            switch($_SESSION['role'])
            {
                case 'user':
                    if($_SESSION['id'] == $id)
                    {
                        //echo"<input type='text' name='password' value='".$password."' readonly><br>";
                        echo"<br><a href='http://localhost/user_edit.php?id=".$id."' 
                        target='_blank' class='button' style='margin-left: 0px;'>Edit</a>";
                    }
                    break;
                case 'admin':
                    if($_SESSION['id'] != $id)
                    {
                        if($acc_state!='banned') 
                        {
                            echo"<br><a href='http://localhost/user_ban.php?id=".$id."' 
                            target='_blank' class='button' style='margin-left: 0px;'>Ban user</a>";
                        }
                        else 
                        {
                            echo"<br><a href='http://localhost/user_unban.php?id=".$id."' 
                            target='_blank' class='button' style='margin-left: 0px;'>Unban user</a>";
                        }
                    }
                    else
                    {
                        echo"<br><a href='http://localhost/user_edit.php?id=".$id."' 
                        target='_blank' class='button' style='margin-left: 0px;'>Edit</a>";
                    }
                    break;
            }    
            ?>
        </div>
    </main>
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
