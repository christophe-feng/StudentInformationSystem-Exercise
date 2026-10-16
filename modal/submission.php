<?php
include_once "../api/db.php";
if(isset($_GET['id'])){
    $row = $Submission->find($_GET['id']);
    $user = $User->find($row['student_id']);
    $assignment = $Assignment->find($row['assignment_id']);
}
?>
<h3 class="cent">批改作業</h3>
<hr>
<form action="./api/submission.php" method="post">
    <table style="width:70%; margin:auto;">
        <tr>
            <td class="yel">學生姓名</td>
            <td><?= $user['name'] ?> (<?= $user['acc'] ?>)</td>
        </tr>
        <tr>
            <td class="yel">作業名稱</td>
            <td><?= $assignment['title'] ?></td>
        </tr>
        <tr>
            <td class="yel">繳交檔案</td>
            <td><a href="upload/<?= $row['file_path'] ?>" download>下載檔案</a></td>
        </tr>
        <tr>
            <td class="yel">成績</td>
            <td><input type="number" name="grade" value="<?= $row['grade'] ?? '' ?>"></td>
        </tr>
        <tr>
            <td class="yel">評語</td>
            <td><textarea name="comment" style="width:200px; height:100px;"><?= $row['comment'] ?? '' ?></textarea></td>
        </tr>
    </table>
    <div class="cent" style="margin-top:20px;">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="hidden" name="assignment_id" value="<?= $row['assignment_id'] ?>">
        <input type="submit" value="送出">
        <input type="reset" value="重置">
    </div>
</form>