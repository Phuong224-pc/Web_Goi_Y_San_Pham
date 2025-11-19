<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['outfit_id'])) {
    $user_id = $_SESSION['user_id'];
    $outfit_id = (int)$_POST['outfit_id'];

    // Kiểm tra outfit đã tồn tại trong giỏ chưa
    $check = $conn->prepare("SELECT 1 FROM cart WHERE user_id = ? AND outfit_id = ?");
    $check->bind_param("ii", $user_id, $outfit_id);
    $check->execute();
    $exists = $check->get_result()->num_rows > 0;

    // Nếu chưa có thì thêm vào
    if (!$exists) {
        $insert = $conn->prepare("INSERT INTO cart (user_id, outfit_id) VALUES (?, ?)");
        $insert->bind_param("ii", $user_id, $outfit_id);
        $insert->execute();
    }

    // Quay lại trang trước
    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
    exit();
} else {
    echo "Thiếu dữ liệu sản phẩm!";
}
?>
