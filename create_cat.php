<?php

require_once 'connection.php';
 
$h_cat_id = $_GET['id'];

if(isset($_POST['submit']))
{
    if($h_cat_id == 'h_cat')
    {
        $name = $_POST['h_cat_name'];
        $query = "INSERT INTO higher_categories (h_cat_name) 
                VALUES ('$name')";

        if ($result = $conn->query($query)) {
            header("Location: http://localhost/home.php");
            exit();
        } else {
            echo "Error: " . $sql . "
            " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    else
    {
        $name = $_POST['cat_name'];
        $description = $_POST['cat_description'];
        $cat_type = $_POST['cat_type'];
        
        $query = "INSERT INTO categories (cat_state_id, bl_h_cat_id, cat_name, cat_description) 
                VALUES ('$cat_type', '$h_cat_id', '$name', '$description')";

        if ($result = $conn->query($query)) {
            header("Location: http://localhost/home.php");
            exit();
        } else {
            echo "Error: " . $sql . "
            " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

?>