<?php
session_start();
require_once 'connection.php';

$page_id = $_GET['id'];

switch($page_id) 
{
    case '1':
        $username = $_GET['user_id']; 

        $query = "SELECT * FROM users INNER JOIN user_roles ON users.role_id = user_roles.roles_id
        INNER JOIN acc_state ON users.user_state_id = acc_state.acc_state_id
        WHERE username = '$username'";
        break;    

    case '2':
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users INNER JOIN user_roles ON users.role_id = user_roles.roles_id
            INNER JOIN acc_state ON users.user_state_id = acc_state.acc_state_id
            WHERE email = '$email' AND password = '$password'";
            
            /*echo 'Invalid password';
            $_SESSION['role'] = NULL;*/
        break;
    
    default: 
        header("Location: http://localhost/err_page.php?id=2");
        exit();
}

if($result = $conn->query($query))
{
    if($result->num_rows == 0)
    {
        header("location: http://localhost/err_page.php?id=2");
        exit;
    }
    while($row = $result->fetch_assoc())
    {
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['f_name'] = $row['first_name'];
        $_SESSION['l_name'] = $row['last_name'];
        $_SESSION['full_name'] = $row['full_name'];
        $_SESSION['acc_state'] = $row['acc_state_title'];
        $_SESSION['pic'] = $row['photo'];
        $_SESSION['role'] = $row['title'];
        
        header("Location: http://localhost/home.php");
        exit();
    }
}
?>
