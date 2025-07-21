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
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/BUSAD.png',
  '../YB COVER/CRIM.png',
  '../YB COVER/EDUC.png',
  '../YB COVER/MARITIME.png',
];

const track = document.getElementById('carousel-track');

let currentIndex = 0;

function renderImages() {
  // For infinite effect, clone last and first images
  const images = [
    carouselImages[carouselImages.length - 1],
    ...carouselImages,
    carouselImages[0],
  ];
  track.innerHTML = images
    .map(
      (src, i) => `<img src="${src}" class="carousel-img" data-index="${i - 1}" draggable="false" />`
    )
    .join('');
  // Set initial position
  track.style.transform = `translateX(-${100 * (currentIndex + 1)}%)`;
}

function moveToIndex(index) {
  currentIndex = index;
  track.style.transition = 'transform 0.5s cubic-bezier(0.4,0,0.2,1)';
  track.style.transform = `translateX(-${100 * (currentIndex + 1)}%)`;
}

function handleTransitionEnd() {
  // Looping logic
  if (currentIndex < 0) {
    track.style.transition = 'none';
    currentIndex = carouselImages.length - 1;
    track.style.transform = `translateX(-${100 * (currentIndex + 1)}%)`;
  } else if (currentIndex >= carouselImages.length) {
    track.style.transition = 'none';
    currentIndex = 0;
    track.style.transform = `translateX(-${100 * (currentIndex + 1)}%)`;
  }
}

function nextImage() {
  moveToIndex(currentIndex + 1);
}
function prevImage() {
  moveToIndex(currentIndex - 1);
}

// Event listeners
track.addEventListener('transitionend', handleTransitionEnd);

// Touch/drag support (optional, basic)
let startX = 0;
let isDragging = false;
track.addEventListener('touchstart', (e) => {
  startX = e.touches[0].clientX;
  isDragging = true;
});
track.addEventListener('touchmove', (e) => {
  if (!isDragging) return;
  const diff = e.touches[0].clientX - startX;
  track.style.transition = 'none';
  track.style.transform = `translateX(-${100 * (currentIndex + 1)}% + ${diff}px)`;
});
track.addEventListener('touchend', (e) => {
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
