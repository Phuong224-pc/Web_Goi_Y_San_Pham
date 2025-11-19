<?php
session_start();
include 'config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit();
}

// Lấy ID sản phẩm
if (!isset($_GET['id'])) {
    die("❌ Không tìm thấy sản phẩm để sửa!");
}
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM outfits WHERE id = $id");

if ($result->num_rows == 0) {
    die("❌ Sản phẩm không tồn tại!");
}

$outfit = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $country = $_POST['country'];
    $continent = $_POST['continent'];
    $name = $_POST['name'];
    
    $description = $_POST['description'];

    // Nếu có ảnh mới
    if (!empty($_FILES['image']['name'])) {
        $target_dir = __DIR__ . "/images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_sql = ", image='images/$image_name'";
    } else {
        $image_sql = "";
    }

    $sql = "UPDATE outfits 
            SET country='$country', continent='$continent', name='$name', description='$description' $image_sql
            WHERE id=$id";

    if ($conn->query($sql)) {
        echo "<script>alert('✅ Cập nhật thành công!');window.location='admin.php';</script>";
    } else {
        echo "<script>alert('❌ Lỗi khi cập nhật!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Outfit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="./images/logo.png">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Sửa Outfit</h2>

    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        <div class="form-group">
            <label>Quốc gia</label>
            <input type="text" name="country" class="form-control" value="<?= $outfit['country'] ?>" required>
        </div>
        <div class="form-group">
            <label>Châu lục</label>
            <input type="text" name="continent" class="form-control" value="<?= $outfit['continent'] ?>" required>
        </div>
        <div class="form-group">
            <label>Tên outfit</label>
            <input type="text" name="name" class="form-control" value="<?= $outfit['name'] ?>" required>
        </div>
       
        <div class="form-group">
            <label>Ảnh hiện tại</label><br>
            <img src="<?= $outfit['image'] ?>" width="120" class="mb-3"><br>
            <label>Chọn ảnh mới (nếu muốn thay)</label>
            <input type="file" name="image" class="form-control-file" accept="image/*">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" rows="4" required><?= $outfit['description'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">💾 Lưu thay đổi</button>
        <a href="admin.php" class="btn btn-secondary">← Quay lại</a>
    </form>
</div>
</body>
</html>
