<?php
include_once "../api/db.php";
$courses = $Course->all();
?>
<h3 class="cent">上傳新教材 (支援批次上傳)</h3>
<hr>
<form action="./api/material.php?action=add" method="post" enctype="multipart/form-data">
    <table style="width: 80%; margin: auto; border-spacing: 15px;">
        <tr>
            <td style="text-align: right; font-weight: bold; width: 30%;">選擇課程：</td>
            <td>
                <select name="course_id" style="width: 100%; padding: 8px; border-radius: 4px;" required>
                    <?php foreach($courses as $c): ?>
                        <option value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; font-weight: bold; vertical-align: top; padding-top: 10px;">上傳教材：</td>
            <td>
                <input type="file" name="file[]" multiple style="width: 100%; padding: 5px;" required>
                <p style="font-size: 0.8rem; color: #666; margin-top: 5px;">* 您可以按住 Ctrl 鍵選擇多個檔案同時上傳</p>
                <p style="font-size: 0.8rem; color: #c62828;">* 上傳後系統將自動以檔名作為教材標題</p>
            </td>
        </tr>
    </table>
    <div class="cent" style="margin-top: 25px; border-top: 1px solid #eee; padding-top: 20px;">
        <input type="submit" value="立即批次上傳" class="btn-primary" style="padding: 10px 40px;">
        <input type="reset" value="重置" class="btn-outline" style="padding: 10px 20px; margin-left: 10px;">
    </div>
</form>