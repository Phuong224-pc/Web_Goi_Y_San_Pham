<?php
// PHP logic
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php'; 

$login_error = '';
$register_error = '';

// --- LOGIC ĐĂNG NHẬP (Giữ nguyên) ---
if (isset($_POST['login_submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php"); 
            exit();
        } else {
            $login_error = "Sai mật khẩu!";
        }
    } else {
        $login_error = "Username không tồn tại!";
    }
}

// --- LOGIC ĐĂNG KÝ (Giữ nguyên) ---
if (isset($_POST['register_submit'])) {
    $username = $_POST['reg_username'];
    $password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
    $role = 'user';

    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    if ($check_stmt->get_result()->num_rows > 0) {
        $register_error = "Username hoặc Email đã tồn tại!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username,  $password, $role);
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?message=registered");
            exit();
        } else {
            $register_error = "Lỗi đăng ký!";
        }
    }
}

$message = '';
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'registered') {
        $message = "Đăng ký thành công! Vui lòng đăng nhập.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập & Đăng Ký</title>
    <link rel="icon" type="image/jpeg" href="./images/logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
            overflow: hidden; 
        }

        .container {
            position: relative;
            width: 750px; 
            height: 500px; 
            background: #fff;
            box-shadow: 0 5px 45px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            display: flex;
            overflow: hidden; 
        }
        
        /* --- Panel Màu Xanh (Giữ nguyên) --- */
        .blue-panel {
            position: absolute;
            top: 0;
            left: 50%; /* Mặc định ở bên phải */
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, #1fa3e5, #007bff);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.6s ease-in-out;
            border-radius: 0 20px 20px 0; 
            z-index: 1000;
        }
        
        .container.active .blue-panel {
            left: 0; /* Trượt sang trái */
            border-radius: 20px 0 0 20px; 
        }

        /* --- Hiệu ứng trượt form (ĐÃ SỬA LỖI LEFT CHÍNH XÁC) --- */
        .form-box {
            position: absolute;
            top: 0;
            width: 50%; 
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background: #fff;
            transition: 0.6s ease-in-out;
            z-index: 1;
        }
        
        /* Form Login - Ban đầu ở bên Trái */
        .login-form {
            left: 0; 
        }

        /* Form Register - Ban đầu ẩn hoàn toàn ở bên phải ngoài container (100%) */
        .register-form {
            left: 100%; 
        }

        /* Khi active (Đăng ký được kích hoạt): */
        .container.active .login-form {
            left: -50%; /* Login trượt sang trái 50% */
        }
        .container.active .register-form {
            left: 50%; /* Register trượt vào vị trí bên phải (50%) */
        }
        
        /* --- Phần còn lại của CSS (Giữ nguyên) --- */
        h2 {
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            width: 100%;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group input {
            padding-left: 40px; 
        }

        .input-group .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 18px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-main {
            background: #007bff;
            color: #fff;
            width: 100%;
            margin-top: 10px;
        }
        
        .btn-main:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #fff;
            color: #007bff;
            border: 2px solid #fff;
            margin-top: 10px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
        
        .success-message {
            color: green;
            margin-top: 10px;
            font-size: 14px;
        }
        
        .social-icons a {
            display: inline-block;
            margin: 0 5px;
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            color: #fff;
            background: #ccc;
            transition: 0.3s;
            font-size: 18px;
        }
        
        .google { background: #dd4b39; }
        .facebook { background: #3b5998; }
        .github { background: #333; }
        .linkedin { background: #007bb5; }
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container" id="container">
        <div class="blue-panel">
            <div class="content login-content">
                <h2>Welcome Back!</h2>
                <p>Already have an Account?</p>
                <button class="btn btn-secondary" id="login-switch">Login</button>
            </div>
            <div class="content register-content" style="display: none;">
                <h2>Hello, Welcome</h2>
                <p>Don't have an account?</p>
                <button class="btn btn-secondary" id="register-switch">Register</button>
            </div>
        </div>

        <div class="form-box login-form">
            <h2>Login</h2>
            <form method="POST">
                <div class="input-group">
                    <i class="icon fas fa-user"></i>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="icon fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                
                <?php if ($login_error): ?><p class="error-message"><?php echo $login_error; ?></p><?php endif; ?>
                <?php if ($message): ?><p class="success-message"><?php echo $message; ?></p><?php endif; ?>
                <button type="submit" name="login_submit" class="btn btn-main">Login</button>
                
            </form>
        </div>

        <div class="form-box register-form">
            <h2>Registration</h2>
            <form method="POST">
                <div class="input-group">
                    <i class="icon fas fa-user"></i>
                    <input type="text" name="reg_username" class="form-control" placeholder="Username" required>
                </div>
                
                <div class="input-group">
                    <i class="icon fas fa-lock"></i>
                    <input type="password" name="reg_password" class="form-control" placeholder="Password" required>
                </div>
                <?php if ($register_error): ?><p class="error-message"><?php echo $register_error; ?></p><?php endif; ?>
                <button type="submit" name="register_submit" class="btn btn-main">Register</button>
                
            </form>
        </div>
    </div>
    
    <script>
        const container = document.getElementById('container');
        const loginSwitch = document.getElementById('login-switch'); 
        const registerSwitch = document.getElementById('register-switch'); 
        const loginContent = document.querySelector('.login-content'); 
        const registerContent = document.querySelector('.register-content'); 

        const loginError = "<?php echo addslashes($login_error); ?>";
        const registerError = "<?php echo addslashes($register_error); ?>";
        const message = "<?php echo addslashes($message); ?>";
        
        let defaultToRegister = false; 

        // Nếu có lỗi đăng ký, ưu tiên hiển thị form đăng ký.
        if (registerError !== "" && loginError === "" && message === "") {
            defaultToRegister = true; 
        }
        
        // --- Thiết lập trạng thái ban đầu ---
        if (defaultToRegister) {
            // HIỂN THỊ FORM ĐĂNG KÝ (Panel xanh bên trái)
            container.classList.add('active'); 
            loginContent.style.display = 'block';
            registerContent.style.display = 'none';
        } else {
            // HIỂN THỊ FORM ĐĂNG NHẬP (Mặc định, Panel xanh bên phải)
            container.classList.remove('active');
            loginContent.style.display = 'none';
            registerContent.style.display = 'block';
        }

        // --- Xử lý sự kiện chuyển đổi ---

        // Chuyển sang form Đăng ký (Container active)
        registerSwitch.addEventListener('click', () => {
            container.classList.add('active'); 
            loginContent.style.display = 'block';
            registerContent.style.display = 'none';
        });

        // Chuyển sang form Đăng nhập (Container inactive)
        loginSwitch.addEventListener('click', () => {
            container.classList.remove('active'); 
            loginContent.style.display = 'none';
            registerContent.style.display = 'block';
        });
    </script>
</body>
</html>