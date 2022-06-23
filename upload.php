<?php
session_start();

require_once 'connection.php';

$target_dir = "public/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_GET['id']))
{
    $id = $_GET['id'];

if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
    	$uploadOk = 1;
	} else {
        echo "File is not an image.";
    	$uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    unlink($target_dir.$_FILES["fileToUpload"]["name"]);
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		$query = "UPDATE users SET photo = '$target_file' WHERE id = '$id'";
        
        if($result = $conn->query($query))
        {
            header("Location: http://localhost/user_edit.php?id=".$id);
            exit();
        }
		else {
			echo "Error: " . $query . "
			" . mysqli_error($conn);
        }

	} else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
?>