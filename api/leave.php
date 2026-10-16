<?php
include_once "db.php";

$action = $_GET['action'] ?? "";

switch ($action) {
    case 'add':
        if (isset($_SESSION['user'])) {
            $data = $_POST;
            $data['student_id'] = $_SESSION['user']['id'];
            $data['status'] = 'pending';
            // duration 會經由 $_POST 傳入
            $Leave->save($data);
        }
        to("../index.php?do=leave");
        break;

    case 'update':
        if (isset($_SESSION['admin'])) {
            $leave = $Leave->find($_POST['id']);
            $leave['status'] = $_POST['status'];
            $Leave->save($leave);
        }
        to("../back.php?do=leave");
        break;

    case 'del':
        if (isset($_SESSION['user'])) {
            $Leave->del($_POST['id']);
        }
        break;
}
?>