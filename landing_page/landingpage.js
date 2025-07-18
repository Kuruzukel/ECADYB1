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