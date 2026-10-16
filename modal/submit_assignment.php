<?php
include_once "../api/db.php";
if(isset($_GET['id'])){
    $row = $Assignment->find($_GET['id']);
    $sub = $Submission->find(['assignment_id' => $row['id'], 'student_id' => $_SESSION['user']['id']]);
}
?>
<h3 class="cent">繳交作業：<?= $row['title'] ?></h3>
<hr>
<form action="./api/submission.php" method="post" enctype="multipart/form-data">
    <table style="width:70%; margin:auto;">
        <tr>
            <td class="yel">作業名稱</td>
            <td><?= $row['title'] ?></td>
        </tr>
        <tr>
            <td class="yel">截止日期</td>
            <td><?= $row['due_date'] ?></td>
        </tr>
        <tr>
            <td class="yel">繳交檔案</td>
            <td>
                <?php if($sub): ?>
                目前繳交檔案：<?= $sub['file_path'] ?><br>
                <?php endif; ?>
                <input type="file" name="file_path">
            </td>
        </tr>
    </table>
    <div class="cent" style="margin-top:20px;">
        <input type="hidden" name="assignment_id" value="<?= $row['id'] ?>">
        <input type="submit" value="送出">
        <input type="reset" value="重置">
    </div>
</form>