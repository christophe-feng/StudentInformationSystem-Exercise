<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('請先登入');location.href='?do=login';</script>";
    exit();
}

$student_id = $_SESSION['user']['id'];
$atts = $Attendance->all(['student_id' => $student_id], " ORDER BY date DESC");
?>

<div class="card-inner">
    <div class="table-header">
        <p>個人出缺席紀錄</p>
        <span class="badge">今日日期：<?= date("Y-m-d"); ?></span>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr class="yel cent">
                    <td width="30%">上課日期</td>
                    <td width="40%">課程名稱</td>
                    <td width="30%">狀態</td>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($atts)): ?>
                    <tr><td colspan="3" class="cent" style="padding: 40px; color: #999;">目前尚無出缺席紀錄</td></tr>
                <?php else: ?>
                    <?php foreach ($atts as $a): ?>
                        <?php $course = $Course->find($a['course_id']); ?>
                        <tr class="cent">
                            <td class="text-muted"><?= $a['date']; ?></td>
                            <td class="font-weight-bold"><?= $course['name'] ?? '未定義課程'; ?></td>
                            <td>
                                <?php
                                    $status_map = [
                                        'present' => '<span class="status-approved" style="background: #e8f5e9; color: #2e7d32; padding: 4px 12px; border-radius: 4px;">出席</span>',
                                        'absent' => '<span class="status-rejected" style="background: #ffebee; color: #c62828; padding: 4px 12px; border-radius: 4px;">曠課</span>',
                                        'late' => '<span class="status-pending" style="background: #fff3e0; color: #ef6c00; padding: 4px 12px; border-radius: 4px;">遲到</span>',
                                        'excused' => '<span style="background: #e3f2fd; color: #1565c0; padding: 4px 12px; border-radius: 4px;">請假</span>'
                                    ];
                                    echo $status_map[$a['status']];
                                ?>
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
    .text-muted { color: #777; font-size: 0.9rem; }
</style>