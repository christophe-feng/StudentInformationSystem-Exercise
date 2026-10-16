<?php
include_once "db.php";

$table=$_GET['table'];
$DB=${ucfirst($table)};

$row=$DB->find(1);
$row[$table]=$_POST[$table];
$DB->save($row);
to("../back.php?do=$table");

?>