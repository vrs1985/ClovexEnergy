<?php

session_start();
include_once 'dbconnect.php';
if ( isset($_SESSION['login'])!="" ) {
  header("Location: dashboard.php");
  exit;
 }
 if (isset($_POST['submit-auth'])) { // Отлавливаем нажатие кнопки "Отправить"
if (empty($_POST['login-auth'])) { // Если поле логин пустое
echo '<script>alert("Поле логин не заполненно");</script>'; // То выводим сообщение об ошибке
} elseif (empty($_POST['pass-auth'])) {
echo '<script>alert("Поле пароль не заполненно");</script>'; // То выводим сообщение об ошибке
} else  {    
$login = $_POST['login-auth']; // Записываем логин в переменную 
$pass = $_POST['pass-auth']; // Записываем пароль в переменную  
$password = hash('sha512', $pass);        
$query = mysqli_query($con, "SELECT id, user_name, user_picture, user_status FROM `users` WHERE `user_login` = '$login' AND `user_password` = '$password'"); // Формируем переменную с запросом к базе данных с проверкой пользователя
$result = mysqli_fetch_array($query); // Формируем переменную с исполнением запроса к БД 
$count = mysqli_num_rows($query); 

if (empty($result['id'])) // Если запрос к бд не возвращяет id пользователя
{
    $errTyp = "danger";
$errMSG = "Wrong Credentials, Try again..."; // Значит такой пользователь не существует или не верен пароль
}
else // Если возвращяем id пользователя, выполняем вход под ним
{
$_SESSION['pass'] = $pass; // Заносим в сессию  пароль
$_SESSION['login'] = $login; // Заносим в сессию  логин
$_SESSION['id'] = $result['id'];
$_SESSION['picture'] = $result['user_picture'];
$_SESSION['status'] = $result['user_status'];
$_SESSION['name'] = $result['user_name']; // Заносим в сессию  id
header("Location: dashboard.php");
  exit;
}     
}       
}

include_once 'logout.php';
 
?>

<?php include_once 'header.php'; ?>

<div class="container">

 <div id="login-form">
    <form method="post" autocomplete="off">
    
     <div class=" col-lg-4 col-lg-offset-4 col-sm-12">
        
         <div class="form-group">
             <h2 class="white">Sign In.</h2>
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
             <input type="text" name="login-auth" class="form-control" placeholder="Enter Username" required />
                </div>
            </div>         

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass-auth" class="form-control" placeholder="Enter Password" required />
                </div>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="submit-auth">Sign In</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a class="white" href="register.php">Sign up Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

<?php include_once 'footer.php'; ?>

