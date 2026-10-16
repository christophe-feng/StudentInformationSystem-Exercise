<?php
include_once "../api/db.php";
if(isset($_GET['id'])){
    $row = $Assignment->find($_GET['id']);
}
?>
<h3 class="cent">作業詳情</h3>
<hr>
<table style="width:70%; margin:auto;">
    <tr>
        <td class="yel">作業名稱</td>
        <td><?= $row['title'] ?></td>
    </tr>
    <tr>
        <td class="yel">作業說明</td>
        <td><div style="white-space: pre-wrap;"><?= $row['description'] ?></div></td>
    </tr>
    <tr>
        <td class="yel">截止日期</td>
        <td><?= $row['due_date'] ?></td>
    </tr>
    <tr>
        <td class="yel">參考檔案</td>
        <td>
            <?php if(!empty($row['file_path'])): ?>
            <a href="upload/<?= $row['file_path'] ?>" download>點此下載</a>
            <?php else: ?>
            無
            <?php endif; ?>
        </td>
    </tr>
</table>
<div class="cent" style="margin-top:20px;">
    <input type="button" onclick="cl('#cover')" value="關閉">
</div>