<?php
if (!isset($_SESSION['admin'])) {
    to("index.php");
    exit();
}

$students = $User->all(['role' => 'student']);
?>

<div class="card-inner">
    <div class="table-header">
        <p>目前全校學生名冊</p>
        <span class="badge">共有 <?= count($students); ?> 位學生</span>
    </div>
    
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th width="15%">學號/帳號</th>
                    <th width="20%">學生姓名</th>
                    <th width="35%">電子郵件</th>
                    <th width="30%">聯絡電話</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($students)): ?>
                    <tr>
                        <td colspan="4" class="cent" style="padding: 40px; color: #999;">目前尚無學生資料</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $s): ?>
                        <tr>
                            <td class="cent font-weight-bold"><?= $s['acc']; ?></td>
                            <td class="cent"><?= $s['name']; ?></td>
                            <td class="cent"><?= $s['email'] ?: '<span class="text-muted">未填寫</span>'; ?></td>
                            <td class="cent"><?= $s['phone'] ?: '<span class="text-muted">未填寫</span>'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .card-inner {
        padding: 10px;
    }
    
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
    
    .table-header p {
        font-weight: bold;
        color: var(--primary-dark);
        margin: 0;
    }
    
    .badge {
        background: var(--primary);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
    }
    
    .modern-table {
        border: 1px solid #eee;
    }
    
    .modern-table th {
        background: #f1f4f8;
        padding: 15px;
        font-size: 0.95rem;
    }
    
    .modern-table td {
        padding: 15px;
        font-size: 0.95rem;
        vertical-align: middle;
    }
    
    .font-weight-bold {
        font-weight: 600;
        color: var(--primary);
    }
    
    .text-muted {
        color: #bbb;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>