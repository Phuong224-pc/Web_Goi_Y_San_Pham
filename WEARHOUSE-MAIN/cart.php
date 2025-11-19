<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT outfits.id, outfits.name, outfits.image, outfits.description
    FROM cart
    JOIN outfits ON cart.outfit_id = outfits.id
    WHERE cart.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="./images/logo.png">
    <style>
        .card img {
            height: 250px;
            object-fit: cover;
        }
        /* Đảm bảo 2 nút cùng hàng trên desktop, xếp dọc trên mobile */
        .btn-group-cart {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn-group-cart form, .btn-group-cart a {
            flex: 1;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<?php include 'menu.php'; ?>

<div class="container mt-4 flex-grow-1">
    <h2 class="mb-4 text-center">🛒 Outfits Yêu Thích Của Bạn</h2>

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

                            <div class="btn-group-cart mt-auto">
                                <a href="outfit_detail.php?id=<?php echo $outfit['id']; ?>" class="btn btn-primary">
                                    Xem chi tiết
                                </a>
                                <form method="POST" action="remove_from_cart.php">
                                    <input type="hidden" name="outfit_id" value="<?php echo $outfit['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-muted text-center">Giỏ hàng của bạn đang trống.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
