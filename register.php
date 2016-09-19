<?php

include_once 'dbconnect.php';

if ( isset($_SESSION['login-auth'])!="" ) {
  header("Location: index.php");
  exit;
 }

if (isset($_POST['btn-signup'])) {

    $login = $_POST['login']; 
    $name = $_POST['name'];
    $pass = $_POST['pass']; 
    $email = $_POST['email'];
    $avatar = $_FILES['userAvatar']['name'];
    $password = hash('sha512', $pass);
    $url_avatar = !$avatar ? 'img/user_avatar/default-avatar.png' : 'img/user_avatar/'.$avatar;
    echo $avatar." = ". $url_avatar;
            // Каталог, в который мы будем принимать файл:
    $uploaddir = './img/user_avatar/';
    $uploadfile = $uploaddir.basename($avatar);
        // Копируем файл из каталога для временного хранения файлов:
    copy($_FILES['userAvatar']['tmp_name'], $uploadfile);

  $sql = "SELECT * from users WHERE user_email = '$email' ";
  $res = mysqli_query($con, $sql);
  $row = mysqli_num_rows($res);
  if ($row == 0) {
    $query = "INSERT INTO `users` (user_login, user_name, user_password, user_email, user_picture) VALUES ('$login', '$name', '$password', '$email', '$url_avatar')"; 
    $result = mysqli_query($con, $query) or die(mysqli_error()); // Отправляем переменную с запросом в базу данных 
    $errTyp = "success";
    $errMSG = "You have successfully registered";
    $errMSG .= "<a href='index.php'><button class='btn btn-default center uppercase'>Homepage</button></a>";
  }else{
    $errTyp = "warning";
    $errMSG = "Sorry Email already in use ...";
} 
}

include_once 'logout.php';
?>

<?php include_once 'header.php'; ?>

<div class="container">

 <div id="login-form">
    <form method="post" autocomplete="off" enctype="multipart/form-data">
    
     <div class=" col-lg-4 col-lg-offset-4 col-sm-12">
        
         <div class="form-group">
             <h2 class="white">Sign Up.</h2>
            </div>
        <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
         <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" placeholder="Enter your name" required />
                </div>
            </div>  
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="login" class="form-control" placeholder="Enter login" required />
                </div>
            </div>         

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" required />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required />
                </div>
            </div>
            
            <div class="form-group">
            <div class="input-group">
                    <input type="file" name="userAvatar"  id="userAvatar" />
                </div>
           </div>

            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a class="white" href="login.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

<?php include_once 'footer.php'; ?>