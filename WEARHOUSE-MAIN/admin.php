<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}


include 'config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Thêm outfit mới
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $country = $_POST['country'];
    $continent = $_POST['continent'];
    $name = $_POST['name'];
    
    $description = $_POST['description'];

    // Upload hình ảnh
    $target_dir = "images/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Lưu vào DB
    $stmt = $conn->prepare("INSERT INTO outfits (country, continent, name, image, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $country, $continent, $name, $target_file, $description);
    $stmt->execute();
}

// Xóa outfit
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM outfits WHERE id = $id");
    header("Location: admin.php");
    exit();
}

// Lấy danh sách outfits
$result = $conn->query("SELECT * FROM outfits ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị Outfit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="./images/logo.png">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Quản Lý Outfit</h2>
            <a href="index.php" class="btn btn-danger">Quay lại</a>
            <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
        </div>

        <form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
            <h4>Thêm Outfit Mới</h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" name="country" placeholder="Quốc Gia" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="continent" placeholder="Châu Lục" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="name" placeholder="Tên Outfit" class="form-control" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <input type="file" name="image" class="form-control-file" accept="image/*" required>
                </div>
                <div class="col-12 mb-3">
                    <textarea name="description" placeholder="Mô Tả" class="form-control" rows="4" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Outfit</button>
        </form>

        <h3 class="mt-5 mb-3">Danh Sách Outfit</h3>
        <table class="table table-striped table-bordered bg-white shadow-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên Outfit</th>
                    <th>Quốc Gia</th>
                    <th>Châu Lục</th>
                    
                    <th>Mô Tả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="<?php echo $row['image']; ?>" width="80"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['continent']; ?></td>
                        
                        <td style="max-width:250px;"><?php echo $row['description']; ?></td>
                        <td>
                            <a href="admin_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                            <a href="admin.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa outfit này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
