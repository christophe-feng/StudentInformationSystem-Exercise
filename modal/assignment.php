<?php
include_once "../api/db.php";
if(isset($_GET['id'])){
    $row = $Assignment->find($_GET['id']);
}else{
    $row = [];
}
?>
<h3 class="cent"><?= isset($_GET['id']) ? '修改作業' : '新增作業' ?></h3>
<hr>
<form action="./api/assignment.php" method="post" enctype="multipart/form-data">
    <table style="width:70%; margin:auto;">
        <tr>
            <td class="yel">課程名稱</td>
            <td>
                <select name="course_id">
                    <?php
                    $courses = $Course->all();
                    foreach ($courses as $course) {
                        $selected = (isset($row['course_id']) && $row['course_id'] == $course['id']) ? 'selected' : '';
                        echo "<option value='{$course['id']}' $selected>{$course['name']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="yel">作業名稱</td>
            <td><input type="text" name="title" value="<?= $row['title'] ?? '' ?>"></td>
        </tr>
        <tr>
            <td class="yel">作業說明</td>
            <td><textarea name="description" style="width:200px; height:100px;"><?= $row['description'] ?? '' ?></textarea></td>
        </tr>
        <tr>
            <td class="yel">截止日期</td>
            <td><input type="datetime-local" name="due_date" value="<?= isset($row['due_date']) ? date('Y-m-d\TH:i', strtotime($row['due_date'])) : '' ?>"></td>
        </tr>
        <tr>
            <td class="yel">參考檔案</td>
            <td>
                <?php if(isset($row['file_path']) && !empty($row['file_path'])): ?>
                目前檔案：<?= $row['file_path'] ?><br>
                <?php endif; ?>
                <input type="file" name="file_path">
            </td>
        </tr>
    </table>
    <div class="cent" style="margin-top:20px;">
        <?php if(isset($_GET['id'])): ?>
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <?php endif; ?>
        <input type="submit" value="送出">
        <input type="reset" value="重置">
    </div>
</form>