function closeModal() {
    document.getElementById('nutritionModal').style.display = 'none';
}

function confirmOrder() {
    // 如果點擊確定，進行下一步
    const finalTotal = total > 500 ? total * 0.95 : total;
    const cartData = encodeURIComponent(JSON.stringify(cart));
    window.location.href = `checkout.html?total=${Math.round(finalTotal)}&cart=${cartData}`;
}
