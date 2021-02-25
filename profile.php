<?php
ob_start();
session_start();
include 'init.php';

if (isset($_SESSION['userid'])) {

    try
    {
        $stmt = $con->prepare('SELECT * FROM users WHERE id =?');
        $stmt->execute(array($_SESSION['userid']));
        $row = $stmt->fetch();
       

    }
    catch(Exception $e)
    {

    }
    ?>
        <div class=" container">
            <div class="f">
                <h1 class="proh"> wellcome Back <?php echo $row['user_name'] ?></h1>
            </div>
            <div class="profcard d-flex justify-content-center">
                    <div class="card">
                            <div class="card-header">
                                <P style="text-align: center ;">My Information</P>
                            </div>
                            <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Name  : <?php echo $row['user_name']?></li>
                                        <li class="list-group-item">Email : <?php echo $row['email']?></li>
                                        <li class="list-group-item"> your Link : <a href="/send.php?id=<?php echo $_SESSION['userid']. '"' ?>>say/send.php?id=<?php echo $_SESSION['userid'] ?></a></li>
                             </ul>
                    </div>
            </div>


        </div>

<?php

}
elseif(isset($_GET['id']) && isset($_SESSION['userid']))
{

    header('Location:send.php?id='.$_GET['id']);
 

}
else
{
    $_SESSION['user_to']=$_GET['id'];
    header('Location:send.php');
}
?>