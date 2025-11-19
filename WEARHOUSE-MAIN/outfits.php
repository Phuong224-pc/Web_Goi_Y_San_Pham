<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';

// Ẩn cảnh báo nhẹ
error_reporting(0);
ini_set('display_errors', 0);

$continent = $_GET['continent'] ?? '';
$country = $_GET['country'] ?? '';

// Chuẩn bị truy vấn lấy outfit theo khu vực
$stmt = $conn->prepare("SELECT * FROM outfits WHERE continent = ? AND country = ?");
$stmt->bind_param("ss", $continent, $country);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Outfit <?php echo htmlspecialchars($country); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="./images/logo.png">
    <style>
        .card img {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'menu.php'; ?>

    <div class="container mt-4 text-center flex-grow-1">
        <h2 class="mb-4 text-uppercase">
            Outfit Phong Cách <?php echo htmlspecialchars($country); ?> 
            <small class="text-muted">(<?php echo htmlspecialchars($continent); ?>)</small>
        </h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="row">
                <?php while ($outfit = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <?php
                            $image = !empty($outfit['image']) ? htmlspecialchars($outfit['image']) : 'images/no-image.png';
                            ?>
                            <img src="<?php echo $image; ?>" class="card-img-top" alt="Outfit">

                            <div class="card-body d-flex flex-column text-center">
                                <h5 class="card-title text-primary"><?php echo htmlspecialchars($outfit['name']); ?></h5>
                                
                                <p class="card-text flex-grow-1">
                                    <?php echo mb_strimwidth(htmlspecialchars($outfit['description'] ?? 'Không có mô tả.'), 0, 80, "..."); ?>
                                </p>

                                <a href="outfit_detail.php?id=<?php echo $outfit['id']; ?>" class="btn btn-primary mb-2">
                                    Xem chi tiết
                                </a>

                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form method="POST" action="add_to_cart.php">
                                        <input type="hidden" name="outfit_id" value="<?php echo $outfit['id']; ?>">
                                        <button type="submit" class="btn btn-success btn-block">
                                            🛒 Lưu outfit
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <p class="text-muted mt-2">Đăng nhập để lưu outfit.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center">Không có outfit nào cho khu vực này.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
