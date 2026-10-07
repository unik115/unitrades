<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UNITRADES | Create Account</title>
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
        width: min(1180px, 100%);
        display: grid;
        grid-template-columns: 0.9fr 1.1fr;
        border-radius: 28px;
        border: 1px solid var(--line);
        background: rgba(15, 22, 36, 0.88);
        box-shadow: 0 30px 80px rgba(0,0,0,0.45);
        overflow: hidden;
      }

      .panel {
        padding: 40px 34px;
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
        margin: 24px 0 16px;
        font-size: clamp(2.5rem, 4vw, 4.2rem);
        letter-spacing: -0.08em;
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
        margin-bottom: 20px;
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
        font-size: clamp(2rem, 3.1vw, 3rem);
        letter-spacing: -0.06em;
      }

      .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
      }

      .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      .field.full {
        grid-column: 1 / -1;
      }

      .field label {
        color: var(--muted);
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
      }

      .field input,
      .field select {
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

      .checkbox-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 14px 0 20px;
        color: var(--muted);
        font-size: 0.9rem;
      }

      .checkbox-wrap input { accent-color: var(--primary); }

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

      .text-link {
        color: var(--primary-soft);
        font-weight: 700;
      }

      @media (max-width: 820px) {
        .auth-wrap { grid-template-columns: 1fr; }
        .intro { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .form-grid { grid-template-columns: 1fr; }
      }
    </style>
  </head>
  <body>
    <div class="auth-page">
      <div class="auth-wrap">
        <div class="panel intro">
          <div class="brand"><span class="brand-mark" aria-hidden="true"></span>UNITRADES</div>
          <h1>Start trading with confidence</h1>
          <p class="lead">
            Create your account to access premium insights, active market dashboards, and secure digital asset management tools built for modern investors.
          </p>
          <ul class="list">
            <li>Fast onboarding process</li>
            <li>Secure and private account setup</li>
            <li>Live execution and portfolio tools</li>
          </ul>
        </div>

        <div class="panel form-panel">
          <div class="form-header">
            <span class="eyebrow">Create account</span>
            <h2>Open your UNITRADES account</h2>
          </div>

          <form id="registerForm">
            <div class="form-grid">
              <div class="field">
                <label for="firstName">First name</label>
                <input id="firstName" type="text" placeholder="First name" required />
              </div>
              <div class="field">
                <label for="lastName">Last name</label>
                <input id="lastName" type="text" placeholder="Last name" required />
              </div>

              <div class="field full">
                <label for="email">Email address</label>
                <input id="email" type="email" placeholder="name@example.com" required />
              </div>

              <div class="field">
                <label for="gender">Gender</label>
                <select id="gender">
                  <option>Male</option>
                  <option>Female</option>
                  <option>Prefer not to say</option>
                </select>
              </div>

              <div class="field">
                <label for="country">Country</label>
                <select id="country">
                  <option>United States</option>
                  <option>United Kingdom</option>
                  <option>Canada</option>
                  <option>Germany</option>
                  <option>Nigeria</option>
                  <option>United Arab Emirates</option>
                </select>
              </div>

              <div class="field">
                <label for="currency">Currency</label>
                <select id="currency">
                  <option>USD</option>
                  <option>EUR</option>
                  <option>GBP</option>
                  <option>NGN</option>
                  <option>AED</option>
                </select>
              </div>

              <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="Create password" required />
              </div>

              <div class="field">
                <label for="confirmPassword">Confirm password</label>
                <input id="confirmPassword" type="password" placeholder="Repeat password" required />
              </div>
            </div>

            <label class="checkbox-wrap">
              <input id="terms" type="checkbox" required /> I agree to the terms and conditions
            </label>

            <button class="submit-btn" type="submit">Register</button>

            <div id="registerMessage" class="bottom-text" style="color: #ffb8b8; min-height: 24px;"></div>

            <div class="bottom-text">
              Already have an account? <a class="text-link" href="login.php">Login now</a>
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

      function getUsers() {
        try {
          return JSON.parse(localStorage.getItem(USERS_KEY) || '[]');
        } catch (error) {
          return [];
        }
      }

      document.getElementById('registerForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('email').value.trim().toLowerCase();
        const gender = document.getElementById('gender').value;
        const country = document.getElementById('country').value;
        const currency = document.getElementById('currency').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const terms = document.getElementById('terms').checked;
        const message = document.getElementById('registerMessage');

        if (!firstName || !lastName || !email || !password || !confirmPassword) {
          message.textContent = 'Please complete all required fields.';
          return;
        }

        if (password.length < 6) {
          message.textContent = 'Password must be at least 6 characters.';
          return;
        }

        if (password !== confirmPassword) {
          message.textContent = 'Passwords do not match.';
          return;
        }

        if (!terms) {
          message.textContent = 'You must accept the terms and conditions.';
          return;
        }

        const users = getUsers();
        const exists = users.some((user) => user.email.toLowerCase() === email);

        if (exists) {
          message.textContent = 'An account with this email already exists.';
          return;
        }

        users.push({
          firstName,
          lastName,
          email,
          gender,
          country,
          currency,
          password
        });

        localStorage.setItem(USERS_KEY, JSON.stringify(users));
        message.style.color = '#a6f0c6';
        message.textContent = 'Account created successfully. Redirecting to login...';

        setTimeout(() => {
          window.location.href = 'login.php';
        }, 800);
      });
    </script>
  </body>
</html>
