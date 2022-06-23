<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="assets/css/layout.css"> 
   <link rel="stylesheet" href="assets/css/fonts.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="icon" href="assets/img/favicon.png">
   <title>Edit</title>
</head>
<body>
<header class="header">
    <?php
    include 'header.php';

    if(!isset($_SESSION['acc_state']))
    {
        header("location: http://localhost/err_page.php?id=4");
        exit;
    }
    else if($_SESSION['acc_state'] == 'banned')
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
                $query = 
                "SELECT *, user_roles.title FROM users 
                INNER JOIN user_roles ON users.role_id = user_roles.roles_id 
                WHERE users.id = '$id'";
                if($result = $conn->query($query))
                {
                    while($row = $result->fetch_assoc())
                    {
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $image = $row['photo'];
                        $role = $row['title'];

                        echo"<img src='".$image."' style='height:75%;'/>";
                        echo"<form action='user_update.php?id=".$id."' method='post' enctype='multipart/form-data'>
                        <input type='file' name='fileToUpload' id='fileToUpload' class='file-input'>";
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
                echo"
                <br>
                <input type='text' name='fname' value='".$first_name."' id='fname'><br>
                <br>
                <input type='text' name='lname' value='".$last_name."' id='lname'><br>
                <br>";
                if($_SESSION['role'] == 'admin')
                {
                    echo"
                    <select name='role' id='role'>
                        <option value='' disabled='' selected='' hidden=''>".$role."</option>
                        <option value='2'>User</option>
                        <option value='1'>Admin</option>
                    </select><br><br>";
                }
                echo"<input type='password' name='password' placeholder='Password' id='password'><br>
                <br>
                <input type='submit' value='Submit' name='submit' class = 'btn'>
                </form>
                <a href='http://localhost/remove.php?id=".$id."' target='_blank' class='button'>Delete Account</a>";
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
<script src="assets\js\jquery.js"></script>
<script src="assets\js\submit.js"></script>
</html>
