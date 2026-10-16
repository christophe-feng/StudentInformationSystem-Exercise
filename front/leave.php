<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('請先登入');location.href='?do=login';</script>";
    exit();
}

$student_id = $_SESSION['user']['id'];
$leaves = $Leave->all(['student_id' => $student_id], " ORDER BY apply_date DESC");
?>

<div class="card-inner">
    <div class="table-header">
        <p>我的請假紀錄與申請</p>
        <button class="btn-accent" onclick="op('#cover','#cvr','./modal/leave.php')">+ 新增請假申請</button>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th style="white-space: nowrap;">申請日期</th>
                    <th style="white-space: nowrap;">請假期間</th>
                    <th style="white-space: nowrap;">時數</th>
                    <th width="45%">請假原因</th>
                    <th style="white-space: nowrap;">狀態</th>
                    <th style="white-space: nowrap;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($leaves)): ?>
                    <tr><td colspan="6" class="cent" style="padding: 40px; color: #999;">目前尚無請假紀錄</td></tr>
                <?php else: ?>
                    <?php foreach ($leaves as $l): ?>
                        <tr class="cent">
                            <td class="text-muted" style="white-space: nowrap; font-size: 0.85rem;"><?= date("Y-m-d", strtotime($l['apply_date'])); ?></td>
                            <td style="white-space: nowrap; font-size: 0.85rem;"><?= $l['start_date']; ?><br>~ <?= $l['end_date']; ?></td>
                            <td style="font-weight: bold; color: var(--accent);"><?= $l['duration']; ?> H</td>
                            <td style="font-size: 0.9rem; text-align: left; padding: 15px 35px; line-height: 1.5; background: #fafafa;">
                                <?= $l['reason']; ?>
                            </td>
                            <td style="white-space: nowrap;">
                                <?php
                                $status_map = [
                                    'pending' => '<span class="status-pending">待審核</span>',
                                    'approved' => '<span class="status-approved">已批准</span>',
                                    'rejected' => '<span class="status-rejected">已拒絕</span>'
                                ];
                                echo $status_map[$l['status']];
                                ?>
                            </td>
                            <td style="white-space: nowrap;">
                                <?php if ($l['status'] == 'pending'): ?>
                                    <button class="btn-outline" style="padding: 4px 10px; font-size: 12px;" onclick="del('leave',<?= $l['id']; ?>)">撤回</button>
                                <?php else: ?>
                                    -
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
    .card-inner { padding: 5px; }
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
    .status-pending { color: #856404; background: #fff3cd; padding: 2px 8px; border-radius: 4px; font-size: 0.85rem; }
    .status-approved { color: #155724; background: #d4edda; padding: 2px 8px; border-radius: 4px; font-size: 0.85rem; }
    .status-rejected { color: #721c24; background: #f8d7da; padding: 2px 8px; border-radius: 4px; font-size: 0.85rem; }
    .modern-table { width: 100%; border-collapse: collapse; }
    .modern-table th { background: #f1f4f8; padding: 15px 10px; border-bottom: 2px solid #ddd; }
    .modern-table td { padding: 12px 10px; border-bottom: 1px solid #eee; vertical-align: middle; }
    .text-muted { color: #999; }
</style>