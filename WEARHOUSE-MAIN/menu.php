<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">WearHouse</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>  
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Trang Chủ</a></li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="asiaDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Châu Á
                </a>
                <div class="dropdown-menu" aria-labelledby="asiaDropdown">
                    <a class="dropdown-item" href="outfits.php?continent=Asia&country=Vietnam">Việt Nam</a>
                    <a class="dropdown-item" href="outfits.php?continent=Asia&country=Korea">Hàn Quốc</a>
                    <a class="dropdown-item" href="outfits.php?continent=Asia&country=China">Trung Quốc</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="europeDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Châu Âu
                </a>
                <div class="dropdown-menu" aria-labelledby="europeDropdown">
                    <a class="dropdown-item" href="outfits.php?continent=Europe&country=UK">Anh</a>
                    <a class="dropdown-item" href="outfits.php?continent=Europe&country=France">Pháp</a>
                    <a class="dropdown-item" href="outfits.php?continent=Europe&country=Italy">Ý</a>
                </div>
            </li>

            <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="americaDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Châu Mỹ
    </a>
    <div class="dropdown-menu" aria-labelledby="americaDropdown">
        <a class="dropdown-item" href="outfits.php?continent=America&country=USA">Mỹ</a>
        <a class="dropdown-item" href="outfits.php?continent=America&country=Brazil">Brazil</a>
        <a class="dropdown-item" href="outfits.php?continent=America&country=Argentina">Argentina</a>
    </div>
</li>

            
        </ul>

        <ul class="navbar-nav">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="cart.php">Mục Yêu Thích</a></li>

                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
                <?php endif; ?>

                <li class="nav-item"><a class="nav-link" href="logout.php">Đăng Xuất</a></li>

            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="cart.php">Mục Yêu Thích</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="login.php">Đăng Nhập</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Đăng Ký</a></li> -->
                <li class="nav-item"><a class="nav-link" href="auth.php">Đăng Nhập/Đăng Ký</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
</nav>

<!-- ✅ Đặt script JS ở đây để các trang khác (outfits.php, cart.php...) đều có hiệu ứng -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
