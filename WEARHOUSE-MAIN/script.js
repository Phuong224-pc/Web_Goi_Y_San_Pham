// script.js - Tùy chỉnh JavaScript

// Hiệu ứng fade-in cho card outfit khi trang load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100); // Delay từng card
    });
});

// Alert khi nhấn "Thêm vào Giỏ Hàng" (tùy chỉnh)
function addToCartAlert() {
    alert('Outfit đã được thêm vào giỏ hàng!');
}

// Gắn event cho nút (nếu cần, thêm vào outfits.php)
document.addEventListener('DOMContentLoaded', function() {
    const addButtons = document.querySelectorAll('.btn-success');
    addButtons.forEach(button => {
        button.addEventListener('click', addToCartAlert);
    });
});

// Tùy chỉnh hamburger menu (nếu Bootstrap không đủ)
const toggler = document.querySelector('.navbar-toggler');
toggler.addEventListener('click', function() {
    const navbar = document.querySelector('#navbarNav');
    navbar.classList.toggle('show'); // Toggle show/hide
});

