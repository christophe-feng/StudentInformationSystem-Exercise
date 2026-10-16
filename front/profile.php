<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('請先登入');location.href='?do=login';</script>";
    exit();
}

$u = $User->find($_SESSION['user']['id']);
?>

<div class="card-inner">
    <div class="table-header">
        <p>個人資料管理</p>
        <span class="badge">學員身分</span>
    </div>

    <form action="./api/user.php?action=update_profile" method="post" class="modern-form">
        <div class="form-row">
            <div class="form-label">帳號 (不可修改)</div>
            <div class="form-input">
                <input type="text" value="<?= $u['acc']; ?>" disabled class="input-disabled">
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">姓名</div>
            <div class="form-input">
                <input type="text" name="name" value="<?= $u['name']; ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">密碼</div>
            <div class="form-input">
                <input type="password" name="pw" value="<?= $u['pw']; ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">電子郵件</div>
            <div class="form-input">
                <input type="email" name="email" value="<?= $u['email']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">聯絡電話</div>
            <div class="form-input">
                <input type="text" name="phone" value="<?= $u['phone']; ?>">
            </div>
        </div>
        
        <div class="cent" style="margin-top: 30px;">
            <input type="hidden" name="id" value="<?= $u['id']; ?>">
            <input type="submit" value="確認修改資料" class="btn-primary" style="padding: 10px 40px;">
            <input type="reset" value="還原" class="btn-outline" style="padding: 10px 20px; margin-left: 10px;">
        </div>
    </form>
</div>

<style>
    .card-inner { padding: 10px; }
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: var(--border-radius);
        border-left: 4px solid var(--primary);
    }
    .modern-form {
        max-width: 600px;
        margin: auto;
    }
    .form-row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    .form-label {
        flex: 1;
        text-align: right;
        padding-right: 20px;
        font-weight: 600;
        color: var(--primary);
    }
    .form-input {
        flex: 2;
    }
    .form-input input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .input-disabled {
        background-color: #eee;
        color: #777;
        cursor: not-allowed;
    }
    .badge {
        background: var(--accent);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
    }
    @media (max-width: 576px) {
        .form-row { flex-direction: column; align-items: flex-start; }
        .form-label { text-align: left; margin-bottom: 5px; }
    }
</style>