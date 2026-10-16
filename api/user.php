<?php
include_once "db.php";

$action = $_GET['action'] ?? "";

switch ($action) {
    case 'update_profile':
        if (isset($_SESSION['user'])) {
            $user = $User->find($_POST['id']);
            $user['name'] = $_POST['name'];
            $user['pw'] = $_POST['pw'];
            $user['email'] = $_POST['email'];
            $user['phone'] = $_POST['phone'];
            $User->save($user);
            $_SESSION['user'] = $user; // 更新 session 中的資料
        }
        to("../index.php?do=profile");
        break;
}
?>
