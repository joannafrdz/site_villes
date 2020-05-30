<?php
unset($_COOKIE['visite']);
setcookie('visite', ''); 
header('location:index.php');
?>