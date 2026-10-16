<div class="login-wrapper">
    <div class="login-card">
        <h2 class="cent menu-title">教務系統登入</h2>
        <form method="post" action="./api/login.php">
            <div class="form-group">
                <label for="acc">使用者帳號</label>
                <input name="acc" id="acc" type="text" placeholder="請輸入學號或員編" required autofocus>
            </div>
            <div class="form-group">
                <label for="pw">使用者密碼</label>
                <input name="pw" id="pw" type="password" placeholder="請輸入密碼" required>
            </div>
            <div class="cent login-actions">
                <input type="submit" value="立即登入" class="btn-primary">
                <input type="reset" value="清除重填" class="btn-outline">
            </div>
        </form>
        <div class="cent" style="margin-top: 20px; font-size: 0.9rem; color: #666;">
            <p>忘記密碼請洽教務處資訊組</p>
        </div>
    </div>
</div>

<style>
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 400px;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        padding: 30px;
        background: #fff;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #eee;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary);
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 2px rgba(0,77,153,0.1);
    }

    .login-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .login-actions input {
        flex: 1;
        padding: 12px;
        font-weight: bold;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-outline {
        background-color: transparent;
        color: var(--primary);
        border: 1px solid var(--primary) !important;
    }

    .btn-outline:hover {
        background-color: #f0f7ff;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 20px;
        }
        .login-actions {
            flex-direction: column;
        }
    }
</style>