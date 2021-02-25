<?php
ob_start();
session_start();
include "init.php";
if (isset($_SESSION['email'])) {
  if (isset($_SESSION['user_to'])) {
    header('Location:send.php?id=' . $_SESSION['user_to']);
  }

  try
  {
    $stmt = $con->prepare('SELECT massage , date FROM massages WHERE 	to_user =? ORDER BY date desc');
    $stmt->execute(array($_SESSION['userid']));
    $row = $stmt->fetchAll();
    $count = count($row);
   
  }
  catch (Exception $e)
  {
      echo $e;
  } 
if ($count == 0) {
    ?>
    <p class="sendp">You don't have any Massage Share Your <a href="<?php echo 'profile.php' ?>">link</a> to received massage</p>


<?php

}
else {
?>

 <div class=" container">
     
 <?php
       foreach($row as $v) {
           ?>
            <div class="massBox">
              <p class="mainp"><?php echo $v['massage']?></p>
            <p class="sacp"><?php echo $v['date'] ?></p>
            </div>
            <?php
       }
 ?>



</div>

<?php

}


   
}
else
{
    header('Location:login.php');
}







include "Inclodes/templates/footer.php";
ob_end_flush();
?>
