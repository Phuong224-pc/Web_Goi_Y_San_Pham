<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';

// Nếu chưa đăng nhập thì chuyển hướng về login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Kiểm tra nếu có outfit_id gửi từ form
if (isset($_POST['outfit_id'])) {
    $outfit_id = $_POST['outfit_id'];

    // Xóa sản phẩm khỏi giỏ hàng trong DB
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND outfit_id = ?");
    $stmt->bind_param("ii", $user_id, $outfit_id);
    $stmt->execute();

    header("Location: cart.php");
    exit();
} else {
    echo "Không tìm thấy sản phẩm cần xóa!";
}
?>
