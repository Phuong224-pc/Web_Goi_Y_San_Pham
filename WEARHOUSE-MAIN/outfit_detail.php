<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("Không tìm thấy sản phẩm");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM outfits WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Sản phẩm không tồn tại");
}

$outfit = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($outfit['name']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="./images/logo.png">
</head>
<body>
<?php include 'menu.php'; ?>

<div class="container mt-4">
    <h1><?php echo htmlspecialchars($outfit['name']); ?></h1>

    <img src="<?php echo htmlspecialchars($outfit['image']); ?>"
     class="img-fluid mb-3" style="max-width: 400px; border-radius: 10px;">


    <p><strong>Châu lục:</strong> <?php echo htmlspecialchars($outfit['continent']); ?></p>
    <p><strong>Quốc gia:</strong> <?php echo htmlspecialchars($outfit['country']); ?></p>

    <p><?php echo nl2br(htmlspecialchars($outfit['description'])); ?></p>

    <a href="index.php" class="btn btn-secondary mt-3">Quay lại</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
