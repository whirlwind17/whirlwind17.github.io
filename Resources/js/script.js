document.addEventListener("DOMContentLoaded", function () {
    const videoItems = document.querySelectorAll(".video-item");
  
    videoItems.forEach((item) => {
      const title = item.querySelector("h2");
  
      item.addEventListener("mouseenter", function () {
        title.classList.add("hide");
      });
  
      item.addEventListener("mouseleave", function () {
        title.classList.remove("hide");
      });
    });
  });