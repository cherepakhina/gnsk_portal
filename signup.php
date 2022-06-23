<?php

require_once 'connection.php';

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $password = $_POST['password'];
    $role_id = $_POST['role'];

    $pfp_options = 
                array("public/images/pfp_not_set1.png", "public/images/pfp_not_set2.png", 
                "public/images/pfp_not_set3.png", "public/images/pfp_not_set4.png");
    $pfp = $pfp_options[rand(0, count($pfp_options) - 1)];
    
    $page_id = $_GET['id'];
    switch($page_id) 
    {
        case '1': 
        $query = "INSERT INTO users (username, first_name, last_name, full_name, 
        password, email, role_id, user_state_id, photo) 
        VALUES ('$username', '$first_name', '$last_name', CONCAT(first_name, ' ', last_name), 
        '$password', '$email', '2', '0', '$pfp')";

        if ($result = $conn->query($query)) 
        {
            header("Location: http://localhost/auth.php?id=1&user_id=".$username);
            exit();
        }
        break;

        case '2':
        $query = "INSERT INTO users (username, first_name, last_name, full_name, 
        password, email, role_id, user_state_id, photo) 
        VALUES ('$username', '$first_name', '$last_name', CONCAT(first_name, ' ', last_name), 
        '$password', '$email', '$role_id', '0', '$pfp')";
    
        if ($result = $conn->query($query)) 
        {
            header("Location: http://localhost/home.php");
            exit();
        }
        break;

        default:
        header("Location: http://localhost/err_page.php?id=2");
        exit();
    }
}

else 
{   
    header("Location: http://localhost/err_page.php?id=2");
    exit();
}
?>