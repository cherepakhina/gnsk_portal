                <?php 

                include_once 'connection.php';

                if(isset($_SESSION['role'])
                /* && $_SESSION['role'] == 'admin'*/) 
                //echo"<br><a href='register.php?id=add' target='_blank' class='button' style='margin-left: 0px;'>Add User</a>";
                //echo"<br><a href='create_post_page.php' target='_blank' class='button' style='margin-left: 0px;'>\t\tAdd a reply</a>";
                echo"
                <th><p><button class='button' id='myBtn'>Reply</button></p>
                    <div id='myModal' class='modal'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <span class='close'>&times;</span>
                                <h2>Add a reply</h2>
                            </div>
                            <div class='modal-body'>
                            <form method='post' action='add_reply_post.php?id=".$post_id."&state=".$_GET['state_id']."'>
                                <textarea name='message' required=''></textarea><br>
                                <input type='submit' value='Submit' name='submit' class='btn'>
                            </form>
                            </div>
                        </div>
                    </div></th></tr>";
                ?>
