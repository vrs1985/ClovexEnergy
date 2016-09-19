

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clovex Energy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src='js/jquery.smooth-scroll.min.js'></script>
    <link rel="icon" href="img/icon-clovex256.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
        <div class="content" >
        <div class="row header header-white">

        <?php include_once 'logout.php'; 
            $nowUrl = $_SERVER['REQUEST_URI'] ;
            if (isset($_SESSION['login']) && isset($_SESSION['id'])) // если в сессии загружены логин и id
{
    $msg = $_SESSION['name'];
$img = $_SESSION['picture'];
$btn_login = '<a href="index.php?exit"><button type="button" class=" btn-login btn btn-danger uppercase">Exit</button></a>'; // Выводим нашу ссылку выхода
} 
if (!isset($_SESSION['login']) || !isset($_SESSION['id']) ) // если в сессии не загружены логин и id
                {
                $btn_login = '<a href="login.php"><button type="button" class=" btn-login btn btn-danger uppercase">login</button></a>'; // Выводим нашу ссылку регистрации
            }
        ?>
        <div class="col-lg-1">
            <a href="index.php">
                <img id="logo" src="img/Clovex-2.png" alt="Clovex Logo">
            </a>
            </div>
        <div class="col-lg-9">
            <ul class="nav-menu">
                <li class="uppercase">
                    <a class="" href="#handPlant" >Energy services</a>
                </li>
                <li class="uppercase">
                    <a class="" href="#servicesSection">Retrofit solutions</a>
                </li>
                <li class="uppercase">
                    <a class="" href="">Contact</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-2">
        <ul class="nav-menu nav-login">
            <li class="uppercase">
                <a class="" href="login.php">login</a>
            </li>
        </ul>
        </div>
            
        </div>

