<?php
include_once "db.php";

$action = $_GET['action'] ?? "";

if($action == 'del'){
    if (isset($_SESSION['admin'])) {
        $Assignment->del($_POST['id']);
    }
} else {
    if(isset($_FILES['file_path']['tmp_name'])){
        move_uploaded_file($_FILES['file_path']['tmp_name'], "../upload/" . $_FILES['file_path']['name']);
        $_POST['file_path'] = $_FILES['file_path']['name'];
    }

    if(isset($_POST['del'])){
        // 批次刪除
        foreach($_POST['del'] as $id){
            $Assignment->del($id);
        }
    }else{
        if(isset($_POST['title'])){
            $Assignment->save($_POST);
        }
    }
}

to("../back.php?do=assignment");
?>