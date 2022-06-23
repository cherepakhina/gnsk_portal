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
   <title>Add higher category</title>
</head>
<body>
<header class="header" style='
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      background-color: #c8dbcc;'>
    <?php
    include 'header.php';

    if(isset($_SESSION['acc_state']) && $_SESSION['acc_state'] == 'banned') 
    {
        header("location: http://localhost/err_page.php?id=1");
        exit;
    } 
    ?>
</header>

<div class="container">
    <?php
    if($_GET['id'] == 'h_cat'  && $_SESSION['username'] == '_=candidfriend=_'){
        echo"<h1>New higher category</h1>
        <form method='post' action='create_cat.php?id=".$_GET['id']."'> 
        <input type='text' name='h_cat_name' required minlength='3' maxlength='10' 
        required='' placeholder='Name'><br>
        <br>
        <input type='submit' value='Add a new higher category' name='submit' class='btn'>
	    </form>";
    }
    else
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
        {
            echo"<h1>New board</h1>
            <form method='post' action='create_cat.php?id=".$_GET['id']."'> 
            <input type='text' name='cat_name' required minlength='3' maxlength='10' 
            required='' placeholder='Name (3-10 characters)'><br>
            <br>
            <input type='text' name='cat_description' required minlength='10' maxlength='60' 
            placeholder='Description (10-60 characters)'><br>
            <br>
            <select name='cat_type' required=''>
                <option value='' disabled='' selected='' hidden=''>Board type</option>
                <option value='1'>Public</option>
                <option value='2'>Admin only</option>
            </select><br>
            <input type='submit' value='Add a new board' name='submit' class='btn'>
            </form>";
        }
    else
    {   header("location: http://localhost/err_page.php?id=3");
        exit;
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