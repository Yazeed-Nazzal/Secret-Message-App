<?php
ob_start();
session_start();
include 'init.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $user_to = $_POST['user_to'];
    $user_from = $_SESSION['userid'];
    $massage = $_POST['massage'];
    unset($_SESSION["user_to"]);

    try
    {
        $stmt = $con->prepare('INSERT INTO `massages` ( `to_user`, `from_user`, `massage`, `date`) VALUES (?,?,?,now()) ');
        $stmt->execute(array($user_to,$user_from,$massage));

        ?>
            <div class=" container">
                <div class="row">

                    <p>succes</p>
                
                </div>
            
            </div>

        <?php
         header("refresh:5;url=index.php");

    }
    catch(Exception $e) {
        echo $e;

    }



    
}

elseif (isset($_SESSION['userid'])&& isset($_GET['id'])) {

    try 
    {
        $stmt = $con->prepare("SELECT user_name from users where id = ?");
        $stmt->execute(array($_GET['id']));
        $row = $stmt->fetch();
 
    }

    catch(Exception $e){
        echo $e;
    }
    ?>
    <div class=" container">
    <h1 class="sendh">Send massage to</h1>
    <p class="sendp"><?php echo $row[0] ?></p>
    <div class=" row d-flex  justify-content-center">
     
     <div class="avatar">
     <img class=" avatar rounded-circle" src="layout/images/1.png" alt="avatar">
     
     </div>
    
    </div>
        <div class=" row d-flex justify-content-center mainsend">

                <form class="masssend" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <textarea name="massage" id="" cols="40" rows="2" placeholder="your identity will be unkowen "></textarea>
                    <input style="display: none" name="user_to" type="text" value="<?php echo $_GET['id'] ?>">
                    <input  class="send mx-auto"   type="submit" value="send">
                </form>
        </div>

    </div>
 <?php   
}
else
{
    ?>
    <div class=" container">
        <div class="  row d-flex justify-content-center ">
            <p class="error">you have to <a href="login.php">Login</a>to send a massage</p>
        </div>

  
    </div>

    <?php
}




?>