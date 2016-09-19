<?php 


if (isset($_GET['exit'])) { 
unset($_SESSION['pass']); 
unset($_SESSION['login']); 
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['status']); 
 header("Location: index.php");
  exit;
} 
  ?>