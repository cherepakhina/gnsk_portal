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
   <title>Add post</title>
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
    <h2>Write a new post</h2>
    <?php
    $cat_id = $_GET['id'];
    $cat_state_id = $_GET['state_id'];
	echo"<form method='post' action='create_post.php?id=".$cat_id."&state_id=".$cat_state_id."'> 
        <input type='text' name='post_subject' required='' placeholder='Post subject'><br>
        <br>
        <textarea name='post_content' placeholder='Say something...'></textarea><br>
        <br>";
        
    if($_SESSION['role'] == 'admin')
    {
        echo"<select name='post_type' required=''>
            <option value='' disabled='' selected='' hidden=''>Post type</option>
            <option value='1'>Public</option>
            <option value='2'>Admin only</option>
    </select><br>";
    }
	?>
    <input type='submit' value='Add a new post' name='submit' class='btn'><br>
        </form>
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