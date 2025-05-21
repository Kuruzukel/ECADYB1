// Sidebar toggle
const menuBtn = document.querySelector(".menu-btn");
const hamburgerIcon = document.querySelector(".hamburger-menu-ico");
const closeIcon = document.querySelector(".close-ico");
const sidebar = document.querySelector(".sidebar");

menuBtn.addEventListener("click", () => {
  const isOpen = !hamburgerIcon.classList.contains("hidden");
  hamburgerIcon.classList.toggle("hidden", isOpen);
  closeIcon.classList.toggle("hidden", !isOpen);
  sidebar.classList.toggle("closed", isOpen);
});

// Toggle submenu and chevron rotation
function toggleSubmenu(menuId) {
  const currentMenu = document.getElementById(menuId);
  if (!currentMenu) return;

  const isShown = currentMenu.classList.contains("show");
  currentMenu.classList.toggle("show", !isShown);

  const currentChevron = document.querySelector(
    `[onclick="toggleSubmenu('${menuId}')"] .chevron i`
  );
  if (currentChevron) {
    currentChevron.classList.toggle("rotate-180", !isShown);
  }

  document.querySelectorAll(".submenu").forEach((submenu) => {
    if (submenu.id !== menuId) {
      submenu.classList.remove("show");

      const chevron = document.querySelector(
        `[onclick="toggleSubmenu('${submenu.id}')"] .chevron i`
      );
      if (chevron) {
        chevron.classList.remove("rotate-180");
      }
    }
  });
}

// ✅ Only activate the first matching tab or sub-tab
function setActiveTab(currentPage) {
  let activated = false;

  document.querySelectorAll(".tab, .sub-tab").forEach((tab) => {
    tab.classList.remove("active");

    if (!activated) {
      const href = tab.getAttribute("href");
      if (
        href &&
        (href.includes(currentPage) || href.includes(`page=${currentPage}`))
      ) {
        tab.classList.add("active");
        activated = true;
      }
    }
  });
}

// ✅ Expand ONLY the submenu of the one active tab
function expandParentMenuIfActive() {
  let submenuOpened = false;

  document.querySelectorAll(".submenu").forEach((submenu) => {
    submenu.classList.remove("show");

    const chevron = document.querySelector(
      `[onclick="toggleSubmenu('${submenu.id}')"] .chevron i`
    );
    if (chevron) chevron.classList.remove("rotate-180");
  });

  document.querySelectorAll(".sub-tab.active").forEach((activeSubTab) => {
    if (submenuOpened) return;

    const submenu = activeSubTab.closest(".submenu");
    if (submenu) {
      submenu.classList.add("show");
      submenuOpened = true;

      const chevron = document.querySelector(
        `[onclick="toggleSubmenu('${submenu.id}')"] .chevron i`
      );
      if (chevron) {
        chevron.classList.add("rotate-180");
      }
    }
  });
}

// Click behavior for main tabs
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

// Click behavior for sub-tabs
document.querySelectorAll(".sub-tab").forEach((tab) => {
  tab.addEventListener("click", function () {
    document
      .querySelectorAll(".tab, .sub-tab")
      .forEach((t) => t.classList.remove("active"));
    this.classList.add("active");
  });
});

// Get page param or fallback
const urlParams = new URLSearchParams(window.location.search);
const page = urlParams.get("page") || "dashboard";

// Manual activation
function setTabActive(tabId) {
  document
    .querySelectorAll(".tab, .sub-tab")
    .forEach((t) => t.classList.remove("active"));
  const tab = document.getElementById(tabId);
  if (tab) tab.classList.add("active");
}

// Utility scroll
function scrollToBottom() {
  const container = document.getElementById("scrollContainer");
  if (container) {
    container.scrollTop = container.scrollHeight;
  }
}

// ✅ On load: enforce only one tab + submenu active
document.addEventListener("DOMContentLoaded", () => {
  const currentPage =
    urlParams.get("page") || window.location.pathname.split("/").pop();
  setActiveTab(currentPage);
  expandParentMenuIfActive();
});
