<?php
session_start();
session_destroy();

session_start();
$_SESSION['success'] = "À bientôt";
header("Location: index.php?page=login");
exit();