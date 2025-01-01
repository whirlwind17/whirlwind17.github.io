function toggleCart() {
    const cartPopup = document.getElementById('cart-popup');
    cartPopup.style.display = cartPopup.style.display === 'block' ? 'none' : 'block';
    loadCartContent();
}

function loadCartContent() {
    fetch('get_cart.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('cart-content').innerHTML = data;
        });
}

function checkout() {
    window.location.href = 'checkout.php';
}