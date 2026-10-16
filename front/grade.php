<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('請先登入');location.href='?do=login';</script>";
    exit();
}

$student_id = $_SESSION['user']['id'];
$myGrades = $Grade->all(['student_id' => $student_id]);
?>

<div class="card-inner">
    <div class="table-header">
        <p>我的成績單查詢</p>
        <span class="badge"><?= count($myGrades); ?> 筆成績紀錄</span>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr class="yel cent">
                    <td width="30%">課程名稱</td>
                    <td width="20%">成績類型</td>
                    <td width="20%">分數</td>
                    <td width="30%">評語/備註</td>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($myGrades)): ?>
                    <tr><td colspan="4" class="cent" style="padding: 40px; color: #999;">目前尚無成績紀錄</td></tr>
                <?php else: ?>
                    <?php foreach ($myGrades as $g): ?>
                        <?php $course = $Course->find($g['course_id']); ?>
                        <tr class="cent">
                            <td class="font-weight-bold"><?= $course['name'] ?? '未定義課程'; ?></td>
                            <td>
                                <?php
                                    $types = ['midterm'=>'期中考', 'final'=>'期末考', 'quiz'=>'小考', 'other'=>'其他'];
                                    echo $types[$g['type']] ?? '其他';
                                ?>
                            </td>
                            <td style="<?= $g['score'] < 60 ? 'color:red; font-weight:bold;' : 'color:green;'; ?>">
                                <?= $g['score']; ?>
                            </td>
                            <td>
                                <?php if($g['score'] >= 60): ?>
                                    <span style="color: green; font-size: 13px;">✅ 及格</span>
                                <?php else: ?>
                                    <span style="color: red; font-size: 13px;">❌ 不及格，請加油</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .card-inner { padding: 10px; }
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: var(--border-radius);
        border-left: 4px solid var(--primary);
    }
    .modern-table { width: 100%; border-collapse: collapse; border: 1px solid #eee; }
    .modern-table td { padding: 15px; border-bottom: 1px solid #eee; }
    .font-weight-bold { font-weight: 600; color: var(--primary); }
    .badge { background: var(--primary); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; }
</style>