<?php
session_start();
unset($_SESSION['customer_user']);
session_destroy();
header("Location:login_admin.php");
exit();
?>
