<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Web Gợi Ý Outfit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
        <h1 class="display-4">Chào mừng đến với Trang Web Gợi Ý Outfit</h1>
        <p class="lead">Chọn châu lục và quốc gia để xem outfit phong cách</p>
    </div>
    <?php
// Lấy 3 outfit ngẫu nhiên
$query = "SELECT * FROM outfits ORDER BY RAND() LIMIT 3";
$result = $conn->query($query);
?>

<section class="featured-products my-5">
    <h2 class="text-center mb-4">🌟 Sản phẩm nổi bật 🌟</h2>

    <div class="container">
        <div class="row">

            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" 
                             class="card-img-top" alt="Outfit">
                        
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>

                            <p class="card-text">
                                <?php echo mb_strimwidth($row['description'], 0, 80, "..."); ?>
                            </p>

                            <a href="outfit_detail.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-primary">
                               Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>


    <?php include 'footer.php'; ?> 
</body>
</html>
