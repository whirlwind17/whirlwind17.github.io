let cart = [];
let total = 0;
let totalCalories = 0;

function addToCart(item, price, category, calories) {
    const foundItem = cart.find(cartItem => cartItem.item === item);
    if (foundItem) {
        foundItem.quantity += 1;
        foundItem.totalPrice += price;
        foundItem.totalCalories += calories;
    } else {
        cart.push({ item, price, category, calories, quantity: 1, totalPrice: price, totalCalories: calories });
    }
    total += price;
    totalCalories += calories;
    updateCart();
}

function removeFromCart(item) {
    const foundItem = cart.find(cartItem => cartItem.item === item);
    if (foundItem) {
        total -= foundItem.totalPrice;
        totalCalories -= foundItem.totalCalories;
        cart = cart.filter(cartItem => cartItem.item !== item);
    }
    updateCart();
}

function updateCart() {
    const cartElement = document.getElementById('cart');
    cartElement.innerHTML = '';
    cart.forEach(cartItem => {
        const li = document.createElement('li');
        li.innerHTML = `${cartItem.item} - ${cartItem.price}元 x ${cartItem.quantity} = ${cartItem.totalPrice}元 
                        <button onclick="removeFromCart('${cartItem.item}')">取消</button>`;
        cartElement.appendChild(li);
    });
    document.getElementById('total').textContent = total;
}

function checkout() {
    if (cart.length === 0) {
        alert('購物車是空的！');
        return;
    }

    // 更新彈出視窗中的購物車內容
    const modalCartElement = document.getElementById('modal-cart');
    modalCartElement.innerHTML = '';
    cart.forEach(cartItem => {
        const li = document.createElement('li');
        li.textContent = `${cartItem.item} (${cartItem.calories} kcal) - ${cartItem.price}元 x ${cartItem.quantity} = ${cartItem.totalPrice}元`;
        modalCartElement.appendChild(li);
    });

    // 總熱量計算
    document.getElementById('total-calories').textContent = `這些食物的總熱量是 ${totalCalories.toFixed(2)} 大卡。`;

    // 檢查營養均衡
    const meatItems = cart.filter(item => item.category === 'meat').reduce((acc, item) => acc + item.quantity, 0);
    const vegItems = cart.filter(item => item.category === 'veg').reduce((acc, item) => acc + item.quantity, 0);

    const nutritionAdviceElement = document.getElementById('nutrition-advice');
    if (meatItems > 0 && vegItems / meatItems < 0.5) {
        nutritionAdviceElement.textContent = '您的飲食可能不均衡，建議添加一些蔬菜。';
    } else {
        nutritionAdviceElement.textContent = '您的飲食均衡，保持這樣的選擇！';
    }

    // 顯示彈出視窗
    document.getElementById('nutritionModal').style.display = 'flex';
}
