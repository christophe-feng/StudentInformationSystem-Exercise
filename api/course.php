<?php
include_once "db.php";

$action = $_GET['action'] ?? "";

switch ($action) {
    case 'save':
        if (isset($_SESSION['admin'])) {
            $data = $_POST;
            // 如果是新增，可以預設 teacher_id 為目前登入者 (假設目前登入者即為授課老師)
            if (!isset($data['id'])) {
                $data['teacher_id'] = $_SESSION['user']['id'] ?? 1;
            }
            $Course->save($data);
        }
        to("../back.php?do=course");
        break;

    case 'del':
        if (isset($_SESSION['admin'])) {
            $Course->del($_POST['id']);
        }
        break;
}
?>
