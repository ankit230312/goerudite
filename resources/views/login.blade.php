<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #4d7cfe, #b24dfe);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 400px;
            height: 500px;
            perspective: 1000px;
        }

        .form-container {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
        }

        .form-container.flipped {
            transform: rotateY(180deg);
        }

        .form-side {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-form {
            transform: rotateY(180deg);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #b24dfe, #0f1624);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #15537A;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #667eea;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        }

        .form-input::placeholder {
            color: #999;
        }

        .form-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #b24dfe, #0f1624);
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .form-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .form-button:hover::before {
            left: 100%;
        }

        .form-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .form-button:active {
            transform: translateY(0);
        }

        .switch-form {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .switch-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .switch-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 10%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 0.8;
            }
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: color 0.3s ease;
            font-size: 30px;
        }

        .form-input:focus + .input-icon {
            color: #667eea;
        }

        .password-toggle {
            cursor: pointer;
            user-select: none;
        }

        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .form-button.loading {
            pointer-events: none;
        }

        .form-button.loading .loading {
            display: inline-block;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                max-width: 350px;
                height: 480px;
            }
            
            .form-side {
                padding: 30px 20px;
            }
            
            .form-title {
                font-size: 1.8rem;
                margin-bottom: 25px;
            }
            
            .form-input {
                padding: 12px 15px;
                font-size: 15px;
            }
            
            .form-button {
                padding: 12px;
                font-size: 16px;
            }
        }

        @media (max-width: 360px) {
            .container {
                max-width: 320px;
                height: 460px;
            }
            
            .form-side {
                padding: 25px 15px;
            }
            
            .form-title {
                font-size: 1.6rem;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 450px;
                height: 550px;
            }
            
            .form-side {
                padding: 50px 40px;
            }
        }

        /* Success message */
        .success-message {
            background: linear-gradient(135deg, #b24dfe, #0f1624);
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            transform: translateY(-20px);
            opacity: 0;
            animation: slideIn 0.5s ease forwards;
        }

        @keyframes slideIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
       
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="form-container" id="formContainer">
            <!-- Login Form -->
            <div class="form-side login-form">                
                <div class="login-title-wrapper">
                    <h2 class="form-title">Welcome Back</h2>
                </div>
                @if(session('error'))
                    <div class="success-message" style="background: linear-gradient(135deg, #ff4d4d, #b30000);">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="success-message" style="background: linear-gradient(135deg, #ff4d4d, #b30000);">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                
                <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-input" placeholder="Email Address" required>
                        <span class="input-icon">📧</span>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="password" class="form-input" placeholder="Password" required>
                        <span class="input-icon password-toggle" onclick="togglePassword(this)">👁️</span>
                    </div>
                    
                    <button type="submit" class="form-button" id="loginBtn">
                        <div class="loading"></div>
                        Sign In
                    </button>
                </form>
                
                <!-- <div class="switch-form">
                    Don't have an account? 
                    <a href="#" class="switch-link" onclick="flipForm()">Sign Up</a>
                </div> -->
            </div>

            
        </div>
    </div>

    <script>
        function flipForm() {
            const formContainer = document.getElementById('formContainer');
            formContainer.classList.toggle('flipped');
        }

        function togglePassword(icon) {
            const input = icon.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }

        // Handle form submissions
        // document.getElementById('loginForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     const btn = document.getElementById('loginBtn');
        //     btn.classList.add('loading');
            
        //     // Simulate API call
        //     setTimeout(() => {
        //         btn.classList.remove('loading');
        //         showSuccessMessage('Login successful! Welcome back!');
        //     }, 2000);
        // });
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('loginBtn');
            btn.disabled = true;
            btn.querySelector('.btn-text').style.display = 'none';
            btn.querySelector('.loading').style.display = 'inline-block';
        });


        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('signupBtn');
            const passwords = this.querySelectorAll('input[type="password"]');
            
            if (passwords[0].value !== passwords[1].value) {
                alert('Passwords do not match!');
                return;
            }
            
            btn.classList.add('loading');
            
            // Simulate API call
            setTimeout(() => {
                btn.classList.remove('loading');
                showSuccessMessage('Account created successfully! Welcome!');
            }, 2000);
        });

        function showSuccessMessage(message) {
            const activeForm = document.querySelector('.form-side:not([style*="transform"])') || 
                             document.querySelector('.login-form');
            const existingMessage = activeForm.querySelector('.success-message');
            
            if (existingMessage) {
                existingMessage.remove();
            }
            
            const successDiv = document.createElement('div');
            successDiv.className = 'success-message';
            successDiv.textContent = message;
            
            const form = activeForm.querySelector('form');
            activeForm.insertBefore(successDiv, form);
            
            setTimeout(() => {
                successDiv.remove();
            }, 3000);
        }

        // Add input focus animations
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add floating animation to shapes on scroll/interaction
        document.addEventListener('mousemove', function(e) {
            const shapes = document.querySelectorAll('.shape');
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.01;
                const x = e.clientX * speed;
                const y = e.clientY * speed;
                shape.style.transform = `translate(${x}px, ${y}px)`;
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                const focusedElement = document.activeElement;
                if (focusedElement.classList.contains('form-input')) {
                    focusedElement.style.borderColor = '#667eea';
                }
            }
        });
    </script>
</body>
</html>