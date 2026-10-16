<?php
include_once "../api/db.php";
$id = $_GET['id'] ?? null;
$course = $id ? $Course->find($id) : null;
$teachers = $User->all(['role'=>'teacher']);
?>
<h3 class="cent"><?= $id ? '修改課程' : '新增課程'; ?></h3>
<hr>
<form action="./api/course.php?action=save" method="post">
    <?php if($id): ?>
        <input type="hidden" name="id" value="<?= $id; ?>">
    <?php endif; ?>
    <table style="width: 80%; margin: auto;">
        <tr>
            <td style="text-align: right;">課程名稱：</td>
            <td><input type="text" name="name" value="<?= $course ? $course['name'] : ''; ?>" required></td>
        </tr>
        <tr>
            <td style="text-align: right;">授課老師：</td>
            <td>
                <select name="teacher_id" required>
                    <?php foreach($teachers as $t): ?>
                        <option value="<?= $t['id']; ?>" <?= ($course && $course['teacher_id'] == $t['id']) ? 'selected' : ''; ?>>
                            <?= $t['name']; ?> (<?= $t['acc']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">上課時段：</td>
            <td><input type="text" name="time_slot" placeholder="例如: Mon 1-2" value="<?= $course ? $course['time_slot'] : ''; ?>" required></td>
        </tr>
        <tr>
            <td style="text-align: right;">地點：</td>
            <td><input type="text" name="location" value="<?= $course ? $course['location'] : ''; ?>" required></td>
        </tr>
    </table>
    <div class="cent" style="margin-top: 20px;">
        <input type="submit" value="<?= $id ? '確認修改' : '送出新增'; ?>">
        <input type="reset" value="重置">
    </div>
</form>
