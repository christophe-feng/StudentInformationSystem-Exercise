<?php
include_once "db.php";

if(isset($_POST['id'])){
    // 批改作業 (老師端)
    $submission = $Submission->find($_POST['id']);
    $submission['grade'] = $_POST['grade'];
    $submission['comment'] = $_POST['comment'];
    $Submission->save($submission);
    to("../back.php?do=submission&id=" . $_POST['assignment_id']);
}else{
    // 繳交作業 (學生端)
    if(isset($_FILES['file_path']['tmp_name'])){
        move_uploaded_file($_FILES['file_path']['tmp_name'], "../upload/" . $_FILES['file_path']['name']);
        
        $data = [
            'assignment_id' => $_POST['assignment_id'],
            'student_id' => $_SESSION['user']['id'],
            'file_path' => $_FILES['file_path']['name']
        ];

        // 檢查是否已繳交過，若已繳交則更新
        $prev = $Submission->find(['assignment_id' => $_POST['assignment_id'], 'student_id' => $_SESSION['user']['id']]);
        if($prev){
            $data['id'] = $prev['id'];
        }
        
        $Submission->save($data);
    }
    to("../index.php?do=assignment");
}
?>