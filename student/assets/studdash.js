const menuBtn = document.querySelector(".menu-btn");
const hamburgerIcon = document.querySelector(".hamburger-menu-ico");
const closeIcon = document.querySelector(".close-ico");
const sidebar = document.querySelector(".sidebar");

menuBtn.addEventListener("click", () => {
  if (hamburgerIcon.classList.contains("hidden")) {
    hamburgerIcon.classList.remove("hidden");
    closeIcon.classList.add("hidden");
    sidebar.classList.add("closed");
  } else {
    hamburgerIcon.classList.add("hidden");
    closeIcon.classList.remove("hidden");
    sidebar.classList.remove("closed");
  }
});

function toggleSubmenu(menuId) {
  const menu = document.getElementById(menuId);
  if (menu) {
    menu.classList.toggle("show");

    document.querySelectorAll(".submenu").forEach((submenu) => {
      if (submenu.id !== menuId && submenu.classList.contains("show")) {
        submenu.classList.remove("show");
      }
    });
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const currentPage =
    urlParams.get("page") || window.location.pathname.split("/").pop();
  setActiveTab(currentPage);
  expandParentMenuIfActive();
});

function setActiveTab(currentPage) {
  document.querySelectorAll(".tab, .sub-tab").forEach((tab) => {
    tab.classList.remove("active");

    if (
      tab.getAttribute("href") &&
      tab.getAttribute("href").includes(currentPage)
    ) {
      tab.classList.add("active");
    }

    if (
      tab.getAttribute("href") &&
      tab.getAttribute("href").includes(`page=${currentPage}`)
    ) {
      tab.classList.add("active");
    }
  });
}

function expandParentMenuIfActive() {
  document.querySelectorAll(".sub-tab.active").forEach((activeSubTab) => {
    const submenu = activeSubTab.closest(".submenu");
    if (submenu) {
      submenu.classList.add("show");
    }
  });
}

document.querySelectorAll(".tab[onclick]").forEach((tab) => {
  tab.addEventListener("click", function (e) {
    if (this.getAttribute("href")) return;
    e.preventDefault();
    document
      .querySelectorAll(".tab")
      .forEach((t) => t.classList.remove("active"));
    this.classList.add("active");
  });
});

document.querySelectorAll(".sub-tab").forEach((tab) => {
  tab.addEventListener("click", function () {
    document
      .querySelectorAll(".tab, .sub-tab")
      .forEach((t) => t.classList.remove("active"));
    this.classList.add("active");
  });
});

const urlParams = new URLSearchParams(window.location.search);
const page = urlParams.get("page") || "dashboard";
const currentTab = document.querySelector(`#${page}-tab`);
if (currentTab) currentTab.classList.add("active");

function setTabActive(tabId) {
  document
    .querySelectorAll(".tab, .sub-tab")
    .forEach((t) => t.classList.remove("active"));
  const tab = document.getElementById(tabId);
  if (tab) {
    tab.classList.add("active");
  }
}

function scrollToBottom() {
  const container = document.getElementById("scrollContainer");
  if (container) {
    container.scrollTop = container.scrollHeight;
  }
}
