<?php
ob_start();
session_start();
$pagetitle = "login";
$nonav = "1";
if(isset($_SESSION['user'])){
 
    header('Location:index.php');
    exit();
}
include "init.php";
if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['login'])) {
            $email=$_POST['email'];
            $password=$_POST['password'];
            $hashedpass = sha1($password);
            try {
                $stmt = $con->prepare("SELECT id, user_name , password  FROM `users` WHERE email=? AND password = ?  LIMIt 1 ");
                $stmt->execute(array($email,$hashedpass));
                $row = $stmt->fetch();
                $count = $stmt->rowCount();
                
                }
                catch (Exception $e){
                    echo $e;
                    }
                if ($count>0){
                      $_SESSION['email'] = $email;
                      $_SESSION['userid'] = $row['id'];
                     header('Location:index.php');
                      exit();
                }
                else
                {
                  echo "Wrong Eamil Or password";
                  header("refresh:5;url=login.php");
                }
        }
        if (isset($_POST['signup'])) {
          echo "hi";
            $username   =$_POST['name'];
            $password   =$_POST['password'];
            $email      =$_POST['email'];
            $repassword = $_POST['rewrite'];
            $formerror  = array();

            //start username check
            if (isset($_POST['name'])) {
              $filteruser = filter_var($username,FILTER_SANITIZE_STRING);
              if ($filteruser=='') {
                $formerror[]='you have to put your user name';
              }
              if (strlen($filteruser)<4) {
                $formerror[]='The user name shuld be more than 4 charactar';
              }
            }
            
            try {
            $stmt = $con->prepare("select *  From users WHERE email=?");
            $stmt->execute(array($email));
            $row = $stmt->rowCount();
            }
            catch (Exception $e){

            }
            if ($row > 0) {
              $formerror[] = "This eamil is allredy used";
          }
            //end username check
            //start password check
            if (empty($password)) {
              $formerror[]='you must enter a password';
            }
            else
            {
              $hashedpass = sha1($password);
            }
            if (isset($_POST['password']) && isset($_POST['rewrite'])) {

                  if ($password != $repassword) {
                    $formerror[]='the password is not similar';
                  }
                  
                  if (strlen($password)< 6) {
                    $formerror[]='the password long enough';
                  }
              

            }
            //end password check
            //start check email 
            if (isset($_POST['email'])) {
              $filteremail = filter_var($email,FILTER_SANITIZE_EMAIL);
              
              if (filter_var($filteremail , FILTER_VALIDATE_EMAIL) != true) {
                $formerror[]='Not Valid Email';
              }
            }
            //end check email 
            

            if (count($formerror)>0) {
             foreach($formerror as $v){
              ?>
              <div class="container updiv ">
                  <i class="fas fa-exclamation-triangle"></i>
                  <?php foreach ($formerror as $v) {
                      echo "<div>" . $v . "</div>";
                  }
                  ?>
              </div>

          <?php
           header("refresh:5;url=login.php");
             }
            }
            else
            {
              $stmt = $con->prepare("INSERT INTO `users` ( `user_name`, `password`, `email` ,up_date ,prev) VALUES (?,?,?,now(),0)");
              $stmt->execute(array($username, $hashedpass,$email));
              ?>
              <div class="container updiv ">
                  <i class="fas fa-thumbs-up"></i>
                  <?php echo "<div >success</div>"; ?>
              </div>
          <?php
              header("refresh:5;url=login.php");
              
              
            }
            

          
        }
      
}
else {

 
?>
<div class="container  d-flex justify-content-center">
  <div class="row mainBox d-flex justify-content-center">
   
    <form class="login text-center" action="<?php  echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <h2>Login</h2>
      <input type="text" name="email" placeholder="Email">
      <input type="text" name="password" placeholder="Password">
      <input class="submit" type="submit" value="Submit" name="login">
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
    <form class="signUp text-center"  action="<?php  echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <h2>sign up</h2>
      <input type="text" required name="name" placeholder="Name">
      <input type="text" required name="email" placeholder="Email">
      <input type="text"  required name="password" placeholder="Password" autocomplete="FALSE">
      <input type="text" required name="rewrite" placeholder="Rewrite Password" autocomplete="FALSE">
      <input class="submit" type="submit" value="Submit" name="signup">

      <p class="message"> registered? <a href="#">Login</a></p>
    </form>
        
  </div>
</div>
<?php
}

include ($temp."/footer.php");
ob_end_flush();
?>