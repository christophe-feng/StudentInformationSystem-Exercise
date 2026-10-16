<?php
include_once "db.php";

$action = $_GET['action'] ?? "";

switch ($action) {
    case 'save':
        if (isset($_SESSION['admin'])) {
            $course_id = $_POST['course_id'];
            $date = $_POST['date'];
            
            // 先刪除該課程該日的舊點名紀錄 (避免重複點名造成資料錯誤)
            $Attendance->del(['course_id'=>$course_id, 'date'=>$date]);

            // 批次儲存點名紀錄
            foreach($_POST['student_id'] as $idx => $sid){
                $data = [
                    'course_id' => $course_id,
                    'student_id' => $sid,
                    'date' => $date,
                    'status' => $_POST['status'][$idx]
                ];
                $Attendance->save($data);
            }
        }
        to("../back.php?do=roll_call&course_id={$course_id}");
        break;
}
?>
