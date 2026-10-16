<?php
include_once "db.php";

$action = $_GET['action'] ?? "";

switch ($action) {
    case 'add':
        if (isset($_SESSION['admin'])) {
            $course_id = $_POST['course_id'];
            
            // 處理多檔案上傳 (批次上傳)
            if (isset($_FILES['file']['name'][0])) {
                foreach ($_FILES['file']['name'] as $idx => $name) {
                    if ($_FILES['file']['error'][$idx] == 0) {
                        $tmp_name = $_FILES['file']['tmp_name'][$idx];
                        $filename = $name;
                        
                        // 移動檔案
                        move_uploaded_file($tmp_name, "../upload/" . $filename);
                        
                        // 儲存資料到資料庫，標題預設為檔名
                        $data = [
                            'course_id' => $course_id,
                            'title' => $filename,
                            'file_path' => $filename
                        ];
                        $Material->save($data);
                    }
                }
            }
        }
        to("../back.php?do=material");
        break;

    case 'del':
        if (isset($_SESSION['admin'])) {
            $Material->del($_POST['id']);
        }
        break;
}
?>