<?php
if(!isset($_GET['id'])){
    to("back.php?do=assignment");
    exit();
}
$assignment = $Assignment->find($_GET['id']);
$course = $Course->find($assignment['course_id']);
?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">作業批改 - <?= $course['name']; ?>：<?= $assignment['title']; ?></p>
    <form method="post" action="./api/submission.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="15%">學號/帳號</td>
                    <td width="15%">姓名</td>
                    <td width="15%">繳交檔案</td>
                    <td width="15%">繳交時間</td>
                    <td width="10%">成績</td>
                    <td width="20%">評語</td>
                    <td width="10%">操作</td>
                </tr>
                <?php
                $rows = $Submission->all(['assignment_id' => $_GET['id']]);
                foreach ($rows as $row) {
                    $user = $User->find($row['student_id']);
                ?>
                    <tr>
                        <td class="cent"><?= $user['acc']; ?></td>
                        <td class="cent"><?= $user['name']; ?></td>
                        <td class="cent">
                            <a href="upload/<?= $row['file_path']; ?>" download>下載</a>
                        </td>
                        <td class="cent"><?= $row['submit_date'] ?? ''; ?></td>
                        <td class="cent"><?= $row['grade'] ?? '未評分'; ?></td>
                        <td class="cent"><?= $row['comment'] ?? ''; ?></td>
                        <td class="cent">
                            <input type="button" onclick="op('#cover','#cvr','./modal/submission.php?id=<?= $row['id']; ?>')" value="評分">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="cent" style="margin-top:20px;">
            <input type="button" onclick="location.href='?do=assignment'" value="返回作業管理">
        </div>
    </form>
</div>