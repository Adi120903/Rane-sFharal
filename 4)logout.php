<?php
session_start();
session_destroy();
header("Location: 2)login.php");
?>