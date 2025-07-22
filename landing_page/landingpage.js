// Feature toggle logic for tab style
document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".feature-toggle-btn");
  const descs = document.querySelectorAll(".feature-toggle-desc");
  function showDesc(idx) {
    descs.forEach((d, i) => {
      d.classList.remove("active");
      if (i === idx) {
        d.classList.add("active");
      }
    });
    buttons.forEach((b) => b.classList.remove("active"));
    buttons[idx].classList.add("active");
  }
  buttons.forEach((btn, idx) => {
    btn.addEventListener("click", function () {
      showDesc(idx);
    });
  });
  // Show the first by default
  showDesc(0);
});

// Login dropdown functionality
const loginBtn = document.getElementById("loginDropdownBtn");
const loginMenu = document.getElementById("loginDropdownMenu");
document.addEventListener("click", function (e) {
  if (loginBtn.contains(e.target)) {
    loginMenu.style.display =
      loginMenu.style.display === "block" ? "none" : "block";
  } else {
    loginMenu.style.display = "none";
  }
});

// Center navbar active button switching
const centerNav = document.querySelector("nav.center-nav");
if (centerNav) {
  const navLinks = centerNav.querySelectorAll("a");
  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      // Remove 'active' from all links
      navLinks.forEach((l) => l.classList.remove("active"));
      // Add 'active' to the clicked link
      this.classList.add("active");
    });
  });
}

// Header hide on scroll animation
document.addEventListener("DOMContentLoaded", function () {
  let lastScrollY = window.scrollY;
  const header = document.querySelector("header");
  window.addEventListener("scroll", function () {
    if (window.scrollY > lastScrollY && window.scrollY > 50) {
      // Scrolling down
      header.classList.add("header-hidden");
    } else {
      // Scrolling up or at top
      header.classList.remove("header-hidden");
    }
    lastScrollY = window.scrollY;
  });
});

// Carousel Sample Images
const carouselImages = [
  "../CAROUSEL/sample1.jpg",
  "../CAROUSEL/sample2.jpg",
  "../CAROUSEL/sample3.jpg",
  "../CAROUSEL/sample4.jpg",
  "../CAROUSEL/sample5.jpg",
  "../CAROUSEL/sample6.jpg",
  "../CAROUSEL/sample7.jpg",
  "../CAROUSEL/sample8.jpg",
  "../CAROUSEL/sample9.jpg",
  "../CAROUSEL/sample10.jpg",
  "../CAROUSEL/sample11.jpg",
  "../CAROUSEL/sample12.jpg",
  "../CAROUSEL/sample13.jpg",
  "../CAROUSEL/sample14.jpg",
  "../CAROUSEL/sample15.jpg",
];

const track = document.getElementById("carousel-track");

let currentIndex = 0;

function renderImages() {
  // For infinite effect, clone last and first images
  const images = [
    carouselImages[carouselImages.length - 1], // last (sample15)
    ...carouselImages, // sample1 to sample15
    carouselImages[0], // first (sample1)
  ];

  track.innerHTML = images
    .map(
      (src, i) =>
        `<img src="${src}" class="carousel-img" data-index="${
          i - 1
        }" draggable="false" />`
    )
    .join("");

  // Set initial position to the first real image (sample1)
  track.style.transition = "none";
  track.style.transform = `translateX(-100%)`;
  currentIndex = 0;
}

function moveToIndex(index) {
  currentIndex = index;
  track.style.transition = "transform 0.5s ease";
  track.style.transform = `translateX(-${(index + 1) * 100}%)`;
}

function handleTransitionEnd() {
  // Loop logic
  if (currentIndex < 0) {
    currentIndex = carouselImages.length - 1;
    track.style.transition = "none";
    track.style.transform = `translateX(-${(currentIndex + 1) * 100}%)`;
  } else if (currentIndex >= carouselImages.length) {
    currentIndex = 0;
    track.style.transition = "none";
    track.style.transform = `translateX(-100%)`;
  }
}

function nextImage() {
  moveToIndex(currentIndex + 1);
}

function prevImage() {
  moveToIndex(currentIndex - 1);
}

// Event listener
track.addEventListener("transitionend", handleTransitionEnd);

// Touch support
let startX = 0;
let isDragging = false;

track.addEventListener("touchstart", (e) => {
  startX = e.touches[0].clientX;
  isDragging = true;
});

track.addEventListener("touchmove", (e) => {
  if (!isDragging) return;
  const diff = e.touches[0].clientX - startX;
  track.style.transition = "none";
  track.style.transform = `translateX(calc(-${
    (currentIndex + 1) * 100
  }% + ${diff}px))`;
});

track.addEventListener("touchend", (e) => {
  isDragging = false;
  const diff = e.changedTouches[0].clientX - startX;
  if (diff > 50) {
    prevImage();
  } else if (diff < -50) {
    nextImage();
  } else {
    moveToIndex(currentIndex);
  }
});

// Initialize
renderImages();

// Auto-slide
let autoSlideInterval = null;
let timeoutId = null;

function startAutoSlide() {
  autoSlideInterval = setInterval(() => {
    nextImage();
  }, 3000);
}

function stopAutoSlide() {
  clearInterval(autoSlideInterval);
}

// Reset after 1 minute
function resetCarouselAfterTimeout() {
  timeoutId = setTimeout(() => {
    stopAutoSlide();
    currentIndex = 0;
    track.style.transition = "none";
    track.style.transform = `translateX(-100%)`;
    setTimeout(() => {
      startAutoSlide();
    }, 100);
    resetCarouselAfterTimeout();
  }, 60000);
}

startAutoSlide();
resetCarouselAfterTimeout();
