<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UNITRADES | Login</title>
    <style>
      :root {
        --bg: #090d17;
        --bg-2: #111a2c;
        --panel: rgba(15, 22, 36, 0.9);
        --primary: #d4af37;
        --primary-soft: #f5d66d;
        --text: #f5efe4;
        --muted: #b9b2a2;
        --soft: #f6f1e7;
        --line: rgba(214, 182, 94, 0.18);
        --success: #7be7b2;
      }

      * { box-sizing: border-box; }

      body {
        margin: 0;
        min-height: 100vh;
        font-family: "Segoe UI", Arial, sans-serif;
        background: linear-gradient(180deg, #090d17 0%, #111a2c 38%, #0f1724 100%);
        color: var(--text);
      }

      a { color: inherit; text-decoration: none; }

      .auth-page {
        min-height: 100vh;
        display: grid;
        place-items: center;
        padding: 42px 20px;
      }

      .auth-wrap {
        width: min(1120px, 100%);
        display: grid;
        grid-template-columns: 1fr 1.1fr;
        border-radius: 28px;
        border: 1px solid var(--line);
        background: rgba(15, 22, 36, 0.88);
        box-shadow: 0 30px 80px rgba(0,0,0,0.45);
        overflow: hidden;
      }

      .panel {
        padding: 42px 34px;
      }

      .intro {
        background: linear-gradient(180deg, rgba(20, 28, 40, 0.92), rgba(13, 19, 32, 0.96));
        border-right: 1px solid rgba(255,255,255,0.05);
      }

      .brand {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-size: clamp(2rem, 3vw, 3.2rem);
        font-weight: 800;
        letter-spacing: -0.08em;
      }

      .brand-mark {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: radial-gradient(circle at 35% 30%, #f9df8a, #c89b3c 42%, #4b3411 100%);
        box-shadow: 0 0 24px rgba(212, 175, 55, 0.35);
        border: 2px solid rgba(255,255,255,0.18);
        position: relative;
      }

      .brand-mark::before {
        content: "U";
        position: absolute;
        inset: 0;
        display: grid;
        place-items: center;
        font-size: 1.15rem;
        font-weight: 800;
        color: #101720;
      }

      h1 {
        margin: 26px 0 16px;
        font-size: clamp(2.3rem, 4vw, 4rem);
        letter-spacing: -0.06em;
        line-height: 1;
      }

      .lead {
        margin: 0;
        color: var(--muted);
        font-size: 1.08rem;
        line-height: 1.8;
      }

      .list {
        list-style: none;
        margin: 28px 0 0;
        padding: 0;
        display: grid;
        gap: 16px;
      }

      .list li {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--soft);
      }

      .list li::before {
        content: "✓";
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(58, 231, 186, 0.12);
        color: var(--success);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
      }

      .form-panel {
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      .form-header {
        margin-bottom: 18px;
      }

      .eyebrow {
        display: inline-block;
        font-size: 0.76rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--primary-soft);
        margin-bottom: 12px;
      }

      .form-header h2 {
        margin: 0;
        font-size: clamp(2rem, 3.2vw, 3rem);
        letter-spacing: -0.06em;
      }

      .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 18px;
      }

      .field label {
        color: var(--muted);
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
      }

      .field input {
        width: 100%;
        min-height: 54px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
        background: rgba(255,255,255,0.02);
        color: var(--text);
        padding: 0 14px;
        font-size: 0.95rem;
      }

      .field input::placeholder {
        color: rgba(245, 239, 228, 0.45);
      }

      .form-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin: 2px 0 24px;
        color: var(--muted);
        font-size: 0.9rem;
      }

      .checkbox {
        display: inline-flex;
        align-items: center;
        gap: 8px;
      }

      .checkbox input {
        accent-color: var(--primary);
      }

      .text-link {
        color: var(--primary-soft);
        font-weight: 700;
      }

      .submit-btn {
        width: 100%;
        min-height: 58px;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        font-weight: 800;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        background: linear-gradient(135deg, rgba(245, 214, 109, 1), rgba(212, 175, 55, 0.95));
        color: #14120d;
      }

      .bottom-text {
        margin-top: 16px;
        text-align: center;
        color: var(--muted);
        font-size: 0.96rem;
      }

      @media (max-width: 820px) {
        .auth-wrap { grid-template-columns: 1fr; }
        .intro { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.05); }
      }
    </style>
  </head>
  <body>
    <div class="auth-page">
      <div class="auth-wrap">
        <div class="panel intro">
          <div class="brand"><span class="brand-mark" aria-hidden="true"></span>UNITRADES</div>
          <h1>Welcome back</h1>
          <p class="lead">
            Secure your account and manage your trading activity with live market access, portfolio control, and premium account support.
          </p>
          <ul class="list">
            <li>Protected login experience</li>
            <li>Institutional-grade account security</li>
            <li>Trusted trading dashboard access</li>
          </ul>
        </div>

        <div class="panel form-panel">
          <div class="form-header">
            <span class="eyebrow">Account access</span>
            <h2>Login to UNITRADES</h2>
          </div>

          <form id="loginForm">
            <div class="field">
              <label for="email">Email address</label>
              <input id="email" type="email" placeholder="name@example.com" required />
            </div>

            <div class="field">
              <label for="password">Password</label>
              <input id="password" type="password" placeholder="Enter your password" required />
            </div>

            <div class="form-meta">
              <label class="checkbox"><input type="checkbox" /> Remember me</label>
              <a href="#" class="text-link">Forgot password?</a>
            </div>

            <button class="submit-btn" type="submit">Login</button>

            <div id="loginMessage" class="bottom-text" style="color: #ffb8b8; min-height: 24px;"></div>

            <div class="bottom-text">
              Don’t have an account? <a class="text-link" href="register.php">Create one</a>
            </div>
            <div class="bottom-text">
              <a class="text-link" href="index.html">← Back to home</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      const USERS_KEY = 'unitrades_users';
      const CURRENT_USER_KEY = 'unitrades_current_user';

      const loginForm = document.getElementById('loginForm');
      const loginMessage = document.getElementById('loginMessage');

      function getUsers() {
        try {
          return JSON.parse(localStorage.getItem(USERS_KEY) || '[]');
        } catch (error) {
          return [];
        }
      }

      loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const email = document.getElementById('email').value.trim().toLowerCase();
        const password = document.getElementById('password').value.trim();

        if (!email || !password) {
          loginMessage.textContent = 'Please enter your email and password.';
          return;
        }

        const users = getUsers();
        const foundUser = users.find((user) => user.email.toLowerCase() === email && user.password === password);

        if (!foundUser) {
          loginMessage.textContent = 'Invalid email or password. Please create an account first.';
          return;
        }

        localStorage.setItem(CURRENT_USER_KEY, JSON.stringify({
          firstName: foundUser.firstName,
          lastName: foundUser.lastName,
          email: foundUser.email
        }));

        loginMessage.style.color = '#a6f0c6';
        loginMessage.textContent = 'Login successful. Redirecting...';
        setTimeout(() => {
          window.location.href = 'index.html';
        }, 700);
      });
    </script>
  </body>
</html>
