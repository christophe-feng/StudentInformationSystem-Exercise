<?php
include_once "db.php";
unset($_SESSION['admin']);
unset($_SESSION['user']);
to("../index.php?do=login");
?>