<?php
include_once "db.php";

$action = $_GET['action'] ?? "";

switch ($action) {
    case 'save':
        // 老師儲存或更新成績
        if (isset($_SESSION['admin'])) {
            $Grade->save($_POST);
        }
        to("../back.php?do=grade");
        break;

    case 'del':
        // 老師刪除成績紀錄
        if (isset($_SESSION['admin'])) {
            $Grade->del($_POST['id']);
        }
        break;
}
?>
