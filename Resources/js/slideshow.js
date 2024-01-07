// slideshow.js

var currentSlide = 1;
var totalSlides = 5;

function startSlideshow() {
  setInterval(function () {
    currentSlide = (currentSlide % totalSlides) + 1;
    var imageUrl = "Resources/photos/" + currentSlide + ".png";
    document.getElementById("slide1").src = imageUrl;
  }, 5000); // 5000 毫秒（5 秒）換一張圖片，可根據需求調整
}

function stopSlideshow() {
  // 可以在這裡加入停止輪替圖片的相關邏輯
  // 例如，清除 setInterval，或者將圖片設置為固定的一張
}

// 启动时钟
startSlideshow();