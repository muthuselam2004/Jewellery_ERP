<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Jewellery ERP | Secure Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Cormorant+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f9f6f0 0%, #fff9ef 50%, #fef7e8 100%);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle diamond pattern background */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23d4af37" stroke-width="0.5" stroke-opacity="0.08"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>');
            background-size: 45px 45px;
            pointer-events: none;
        }

        body::after {
            content: '💎';
            position: absolute;
            font-size: 280px;
            color: rgba(212, 175, 55, 0.04);
            bottom: -80px;
            right: -80px;
            font-family: serif;
            pointer-events: none;
            transform: rotate(15deg);
        }

        /* Main Card Container */
        .login-container {
            width: 100%;
            max-width: 460px;
            margin: 2rem;
            position: relative;
            z-index: 2;
        }

        /* Elegant White/Gold Card */
        .login-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(0px);
            border-radius: 48px;
            padding: 2.8rem 2.2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(212, 175, 55, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .login-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 55px -15px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(212, 175, 55, 0.4);
        }

        /* Header with jewellery icon */
        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .icon-badge {
            width: 80px;
            height: 80px;
            background: linear-gradient(145deg, #fff8ed, #fff3e0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            border: 1.5px solid rgba(212, 175, 55, 0.5);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
        }

        .icon-badge i {
            font-size: 2.8rem;
            color: #c9a03d;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .brand h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #2c2418;
            margin-bottom: 0.4rem;
        }

        .brand p {
            color: #8a7f6e;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* Message Alerts - Light Theme */
        .message {
            padding: 0.9rem 1.2rem;
            border-radius: 60px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .message i {
            font-size: 1rem;
        }

        .message.error {
            background: #fee9e6;
            border-left: 3px solid #e74c3c;
            color: #c0392b;
        }

        .message.success {
            background: #e8f5e9;
            border-left: 3px solid #27ae60;
            color: #1e7b48;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #c9a03d;
            font-size: 1.1rem;
            opacity: 0.8;
            transition: opacity 0.2s;
            pointer-events: none;
        }

        .form-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: #ffffff;
            border: 1.5px solid #e8e0d0;
            border-radius: 60px;
            font-size: 0.95rem;
            color: #2c2418;
            font-weight: 500;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.3px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #d4af37;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }

        .form-group input::placeholder {
            color: #b8ad96;
            font-weight: 400;
            font-size: 0.9rem;
        }

        /* Options row (checkbox + forgot) */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.2rem 0 2rem;
            font-size: 0.85rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #6b6252;
            transition: color 0.2s;
        }

        .checkbox-label input {
            width: 18px;
            height: 18px;
            accent-color: #d4af37;
            cursor: pointer;
            margin: 0;
        }

        .checkbox-label:hover {
            color: #c9a03d;
        }

        .forgot-link {
            color: #c9a03d;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            border-bottom: 1px dotted transparent;
        }

        .forgot-link:hover {
            color: #a07d2e;
            border-bottom-color: #c9a03d;
        }

        /* Login Button - Gold Elegant */
        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(95deg, #d4af37, #e8c451, #c9a03d);
            border: none;
            border-radius: 60px;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            color: #1e1b13;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .login-btn i {
            font-size: 1.1rem;
            transition: transform 0.2s;
        }

        .login-btn:hover {
            background: linear-gradient(95deg, #e0bc45, #efd06a, #d4af37);
            transform: scale(1.01);
            box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);
            color: #0c0a05;
        }

        .login-btn:hover i {
            transform: translateX(4px);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.7rem;
            color: #b0a68f;
            letter-spacing: 0.5px;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
            padding-top: 1.5rem;
        }

        /* Security note */
        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 1rem;
            font-size: 0.7rem;
            color: #b0a68f;
        }

        .security-note i {
            font-size: 0.7rem;
            color: #d4af37;
        }

        /* Responsive touches */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .brand h1 {
                font-size: 1.9rem;
            }

            .icon-badge {
                width: 65px;
                height: 65px;
            }

            .icon-badge i {
                font-size: 2.3rem;
            }
        }

        /* loading spinner for button */
        .btn-loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Branding with jewelry essence -->
            <div class="brand">
                <div class="icon-badge">
                    <i class="fas fa-gem"></i>
                </div>
                <h1>Jewellery ERP</h1>
                <p>Luxury Inventory & Management Suite</p>
            </div>

            <!-- Session Messages (flashing errors/success) -->
            @if(session('error'))
                <div class="message error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="message success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('auth.verify') }}" id="loginForm">
                @csrf

                <!-- Username Field with icon -->
                <div class="form-group">
                    <i class="fas fa-user-alt input-icon"></i>
                    <input type="text" name="username" id="username" placeholder="Username / Employee ID"
                        value="{{ old('username') }}" required autocomplete="off">
                </div>

                <!-- Password Field with icon & toggle -->
                <div class="form-group" style="position: relative;">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="fas fa-eye-slash" id="togglePassword"
                        style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #c9a03d; font-size: 0.95rem; transition: color 0.2s;"></i>
                </div>

                <!-- Extra options: remember me and forgot password -->
                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" value="1">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Login Button with dynamic state -->
                <button type="submit" class="login-btn" id="loginBtn">
                    <span>Login</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- <div class="security-note">
                    <i class="fas fa-shield-alt"></i>
                    <span>256-bit SSL Secured | Gold Standard Authentication</span>
                </div> -->
            </form>

            <div class="footer">
                © {{ date('Y') }} Jewellery ERP — Crafting Excellence
            </div>
        </div>
    </div>

    <!-- JavaScript for eye toggle & simple loading protection -->
    <script>
        (function () {
            // Toggle password visibility
            const togglePwd = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePwd && passwordInput) {
                togglePwd.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }

            // Add loading effect on submit to avoid double click & give feedback
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');

            if (loginForm && loginBtn) {
                loginForm.addEventListener('submit', function (e) {
                    // Basic frontend validation so empty fields won't be sent raw
                    const username = document.getElementById('username');
                    const password = document.getElementById('password');

                    if (!username.value.trim() || !password.value.trim()) {
                        e.preventDefault();
                        // optional dynamic error message without refresh
                        let errorDiv = document.querySelector('.message.error');
                        if (!errorDiv) {
                            const container = document.querySelector('.login-card .brand');
                            const newError = document.createElement('div');
                            newError.className = 'message error';
                            newError.innerHTML = '<i class="fas fa-info-circle"></i><span>Please fill in both username and password.</span>';
                            container.insertAdjacentElement('afterend', newError);
                            setTimeout(() => newError.style.opacity = '0', 3000);
                            setTimeout(() => newError.remove(), 3500);
                        } else {
                            errorDiv.querySelector('span').innerText = 'Please fill in both username and password.';
                            errorDiv.style.display = 'flex';
                            setTimeout(() => errorDiv.style.opacity = '0', 3000);
                            setTimeout(() => errorDiv.style.display = 'none', 3500);
                        }
                        return false;
                    }

                    // Show loading state on button
                    const originalContent = loginBtn.innerHTML;
                    loginBtn.innerHTML = '<span>AUTHENTICATING</span><i class="fas fa-spinner"></i>';
                    loginBtn.classList.add('btn-loading');
                    loginBtn.disabled = true;

                    // Failsafe: re-enable after 10 seconds if something goes wrong
                    setTimeout(() => {
                        if (loginBtn.disabled) {
                            loginBtn.innerHTML = originalContent;
                            loginBtn.classList.remove('btn-loading');
                            loginBtn.disabled = false;
                        }
                    }, 10000);

                    return true;
                });
            }

            // Add entrance animation
            const card = document.querySelector('.login-card');
            if (card) {
                card.style.animation = 'fadeSlideUp 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards';
            }

            // Inject keyframes for subtle entrance
            const styleSheet = document.createElement("style");
            styleSheet.textContent = `
            @keyframes fadeSlideUp {
                0% { opacity: 0; transform: translateY(30px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .login-card {
                animation: fadeSlideUp 0.55s ease-out;
            }
        `;
            document.head.appendChild(styleSheet);
        })();
    </script>
</body>

</html>