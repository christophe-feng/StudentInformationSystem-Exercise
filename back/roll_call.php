<?php
if (!isset($_SESSION['admin'])) {
    to("index.php");
    exit();
}

$courses = $Course->all();
$course_id = $_GET['course_id'] ?? ($courses[0]['id'] ?? 0);
$students = $User->all(['role'=>'student']);
$date = date("Y-m-d");
?>

<div style="width:95%; margin:auto;">
    <h3 class="cent">班級課堂點名</h3>
    <div class="cent">
        選擇課程：
        <select onchange="location.href='?do=roll_call&course_id='+this.value">
            <?php foreach($courses as $c): ?>
                <option value="<?= $c['id']; ?>" <?= ($course_id == $c['id']) ? 'selected' : ''; ?>><?= $c['name']; ?></option>
            <?php endforeach; ?>
        </select>
        &nbsp;&nbsp; 點名日期：<?= $date; ?>
    </div>
    
    <?php if($course_id > 0): ?>
    <form action="./api/attendance.php?action=save" method="post">
        <input type="hidden" name="course_id" value="<?= $course_id; ?>">
        <input type="hidden" name="date" value="<?= $date; ?>">
        <table style="width:100%; margin-top:10px; border-collapse: collapse;" border="1">
            <tr class="t cent">
                <td>學生學號</td>
                <td>學生姓名</td>
                <td>出缺席狀態</td>
            </tr>
            <?php foreach ($students as $s): ?>
                <?php 
                    // 檢查今日是否已有點名紀錄
                    $att = $Attendance->find(['course_id'=>$course_id, 'student_id'=>$s['id'], 'date'=>$date]);
                    $currentStatus = $att['status'] ?? 'present';
                ?>
                <tr class="cent">
                    <td><?= $s['acc']; ?></td>
                    <td><?= $s['name']; ?></td>
                    <td>
                        <input type="hidden" name="student_id[]" value="<?= $s['id']; ?>">
                        <select name="status[]">
                            <option value="present" <?= ($currentStatus == 'present') ? 'selected' : ''; ?>>出席</option>
                            <option value="absent" <?= ($currentStatus == 'absent') ? 'selected' : ''; ?>>曠課</option>
                            <option value="late" <?= ($currentStatus == 'late') ? 'selected' : ''; ?>>遲到</option>
                            <option value="excused" <?= ($currentStatus == 'excused') ? 'selected' : ''; ?>>請假</option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="cent" style="margin-top: 20px;">
            <input type="submit" value="送出今日點名">
        </div>
    </form>
    <?php else: ?>
        <p class="cent">請先建立課程資料</p>
    <?php endif; ?>
</div>
