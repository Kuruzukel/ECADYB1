const themes = {
  "Theme 1": {
    "--primary-bg": "#470a0a",
    "--header-bg": "#b21c0e",
    "--accent": "#fcda15",
    "--section-bg": "#bc4f5e",
    "--section-header": "#cb5382",
    "--body-bg": "#470a0a",
    "--sidebar-bg": "#b21c0e",
    "--content-bg": "#bc4f5e",
    "--menu-bg-active": "#cb5382",
    "--menu-border-active": "#fff176",
    "--menu-hover-bg": "#cb5382",
  },
  "Theme 2": {
    "--primary-bg": "#12086F",
    "--header-bg": "#2B35AF",
    "--accent": "#fcda15",
    "--section-bg": "#4895EF",
    "--section-header": "#4CC9F0",
    "--body-bg": "#12086F",
    "--sidebar-bg": "#2B35AF",
    "--content-bg": "#4895EF",
    "--menu-bg-active": "#4CC9F0",
    "--menu-border-active": "#ffffff",
    "--menu-hover-bg": "#4361EE",
  },
  "Theme 3": {
    "--primary-bg": "#0d381e",
    "--header-bg": "#164f2c",
    "--accent": "#fcda15",
    "--section-bg": "#2a834d",
    "--section-header": "#349e5e",
    "--body-bg": "#0d381e",
    "--sidebar-bg": "#164f2c",
    "--content-bg": "#2a834d",
    "--menu-bg-active": "#349e5e",
    "--menu-border-active": "#ffffff",
    "--menu-hover-bg": "#1f693c",
  },
  "Theme 4": {
    "--primary-bg": "#281E18",
    "--header-bg": "#572D0C",
    "--accent": "#fcda15",
    "--section-bg": "#E3B76A",
    "--section-header": "#9D9C75",
    "--body-bg": "#281E18",
    "--sidebar-bg": "#572D0C",
    "--content-bg": "#E3B76A",
    "--menu-bg-active": "#9D9C75",
    "--menu-border-active": "#ffffff",
    "--menu-hover-bg": "#C78E3A",
  },
  Default: {
    "--primary-bg": "#112d4e",
    "--header-bg": "#0c27be",
    "--accent": "#0c27be",
    "--section-bg": "#34495e",
    "--section-header": "#217ff7",
    "--body-bg": "#000042",
    "--sidebar-bg": "#0c27be",
    "--content-bg": "#112d4e",
    "--menu-bg-active": "#000042",
    "--menu-border-active": "#fcda15",
    "--menu-hover-bg": "#1c1c84",
  },
};

function applyTheme(themeName) {
  const theme = themes[themeName] || themes["Default"];
  const root = document.documentElement;
  for (const [key, value] of Object.entries(theme)) {
    root.style.setProperty(key, value);
  }
}

window.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("dashboard-theme") || "Default";
  applyTheme(savedTheme);
});

// Global variable to store original modal content
let originalModalContent = null;
let isPreviewMode = false;
let modalState = 'confirm'; // 'confirm' or 'preview'

// Modern Announcement Form JavaScript
document.addEventListener("DOMContentLoaded", function () {
  // Initialize current date
  displayCurrentDate();

  // Initialize character counter
  initializeCharacterCounter();

  // Initialize form validation
  initializeFormValidation();

  // Initialize modal functionality
  initializeModal();

  // Initialize preview functionality
  initializePreview();
});

// Display current date in header
function displayCurrentDate() {
  const currentDateElement = document.getElementById("current-date");
  if (currentDateElement) {
    const now = new Date();
    const options = {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    };
    currentDateElement.textContent = now.toLocaleDateString("en-US", options);
  }
}

// Character counter for message textarea
function initializeCharacterCounter() {
  const messageTextarea = document.getElementById("message");
  const charCountElement = document.getElementById("char-count");

  if (messageTextarea && charCountElement) {
    messageTextarea.addEventListener("input", function () {
      const currentLength = this.value.length;
      charCountElement.textContent = currentLength;

      // Add visual feedback based on length
      if (currentLength > 500) {
        charCountElement.style.color = "#ef4444"; // Red for long text
      } else if (currentLength > 300) {
        charCountElement.style.color = "#f59e0b"; // Orange for medium text
      } else {
        charCountElement.style.color = "#94a3b8"; // Default color
      }
    });
  }
}

// Form validation
function initializeFormValidation() {
  const form = document.getElementById("announcementForm");
  const titleInput = document.getElementById("title");
  const messageTextarea = document.getElementById("message");

  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      // Basic validation
      if (!titleInput.value.trim()) {
        showNotification("Please enter a title", "error");
        titleInput.focus();
        return;
      }

      if (!messageTextarea.value.trim()) {
        showNotification("Please enter a message", "error");
        messageTextarea.focus();
        return;
      }

      // If validation passes, show confirmation modal
      showModal();
    });
  }

  // Real-time validation feedback
  if (titleInput) {
    titleInput.addEventListener("input", function () {
      validateField(this, "Title is required");
    });
  }

  if (messageTextarea) {
    messageTextarea.addEventListener("input", function () {
      validateField(this, "Message is required");
    });
  }
}

// Field validation helper
function validateField(field, errorMessage) {
  const isValid = field.value.trim().length > 0;

  if (isValid) {
    field.style.borderColor = "#0c27be";
    field.style.boxShadow = "0 0 0 3px rgba(12, 39, 190, 0.1)";
  } else {
    field.style.borderColor = "#ef4444";
    field.style.boxShadow = "0 0 0 3px rgba(239, 68, 68, 0.1)";
  }
}

// Modal functionality
function initializeModal() {
  const modalOverlay = document.getElementById("modal-overlay");
  const modal = modalOverlay.querySelector(".modal");
  const form = document.getElementById("announcementForm");

  if (modalOverlay && modal) {
    // Store original modal content
    originalModalContent = modal.innerHTML;

    // Close modal when clicking overlay
    modalOverlay.addEventListener("click", function (e) {
      if (e.target === modalOverlay) {
        // Just hide the modal - don't restore content to prevent confirm modal from showing
        hideModal();
      }
    });

    // Close modal with Escape key
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && modalOverlay.style.display === "flex") {
        // Just hide the modal - don't restore content to prevent confirm modal from showing
        hideModal();
      }
    });

    // Handle all modal buttons dynamically
    modalOverlay.addEventListener("click", function (e) {
      if (e.target.id === "confirm-btn") {
        hideModal();
        submitForm();
      } else if (e.target.id === "cancel-btn") {
        hideModal();
      } else if (e.target.id === "close-preview-btn") {
        hideModal();
      }
    });
  }
}

// Show modal
function showModal() {
  const modalOverlay = document.getElementById("modal-overlay");
  if (modalOverlay) {
    // Set modal state to confirm
    modalState = 'confirm';
    modalOverlay.style.display = "flex";
    modalOverlay.style.animation = "fadeIn 0.3s ease-out";
  }
}

// Hide modal
function hideModal() {
  const modalOverlay = document.getElementById("modal-overlay");
  if (modalOverlay) {
    modalOverlay.style.animation = "fadeOut 0.3s ease-out";
    setTimeout(() => {
      modalOverlay.style.display = "none";
      // Only restore original modal content if we were in preview mode
      if (modalState === 'preview') {
        const modal = modalOverlay.querySelector(".modal");
        if (modal && originalModalContent) {
          modal.innerHTML = originalModalContent;
        }
        // Reset modal state
        modalState = 'confirm';
      }
    }, 300);
  }
}

// Submit form
function submitForm() {
  const form = document.getElementById("announcementForm");
  if (form) {
    // Show loading state
    const submitBtn = document.getElementById("post-announcement-btn");
    if (submitBtn) {
      const originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Posting...';
      submitBtn.disabled = true;

      // Get form data
      const formData = new FormData(form);

      // Submit via AJAX
      fetch('submit_announcement.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showNotification(data.message, "success");
          // Reset form
          form.reset();
          // Reset character counter
          const charCountElement = document.getElementById("char-count");
          if (charCountElement) {
            charCountElement.textContent = "0";
          }
        } else {
          showNotification(data.message, "error");
        }
      })
      .catch(error => {
        showNotification("An error occurred while posting the announcement", "error");
        console.error('Error:', error);
      })
      .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      });
    }
  }
}

// Preview functionality
function initializePreview() {
  const previewBtn = document.getElementById("preview-btn");
  const titleInput = document.getElementById("title");
  const messageTextarea = document.getElementById("message");

  if (previewBtn) {
    previewBtn.addEventListener("click", function () {
      const title = titleInput.value.trim();
      const message = messageTextarea.value.trim();

      if (!title || !message) {
        showNotification(
          "Please fill in both title and message to preview",
          "warning"
        );
        return;
      }

      showPreviewModal(title, message);
    });
  }
}

// Show preview modal
function showPreviewModal(title, message) {
  const modalOverlay = document.getElementById("modal-overlay");
  const modal = modalOverlay.querySelector(".modal");

  // Set modal state to preview
  modalState = 'preview';

  // Create preview content
  const previewContent = `
        <div class="modal-header">
            <i class="fas fa-eye modal-icon"></i>
            <h3>Preview Announcement</h3>
        </div>
        <div class="modal-content">
            <div class="preview-announcement">
                <h4 class="preview-title">${title}</h4>
                <p class="preview-message">${message}</p>
                <div class="preview-meta">
                    <span class="preview-date">${new Date().toLocaleDateString()}</span>
                </div>
            </div>
        </div>
        <div class="modal-buttons">
            <button class="modal-btn secondary" id="close-preview-btn">
                <i class="fas fa-times"></i>
                Close Preview
            </button>
        </div>
    `;

  modal.innerHTML = previewContent;
  modalOverlay.style.display = "flex";
}

// Notification system
function showNotification(message, type = "info") {
  // Create notification element
  const notification = document.createElement("div");
  notification.className = `notification notification-${type}`;
  notification.innerHTML = `
        <i class="fas fa-${getNotificationIcon(type)}"></i>
        <span>${message}</span>
    `;

  // Add styles
  notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${getNotificationColor(type)};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1001;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        animation: slideInRight 0.3s ease-out;
    `;

  document.body.appendChild(notification);

  // Remove notification after 3 seconds
  setTimeout(() => {
    notification.style.animation = "slideOutRight 0.3s ease-out";
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  }, 3000);
}

// Helper functions for notifications
function getNotificationIcon(type) {
  const icons = {
    success: "check-circle",
    error: "exclamation-circle",
    warning: "exclamation-triangle",
    info: "info-circle",
  };
  return icons[type] || "info-circle";
}

function getNotificationColor(type) {
  const colors = {
    success: "#10b981",
    error: "#ef4444",
    warning: "#f59e0b",
    info: "#8b5cf6",
  };
  return colors[type] || "#8b5cf6";
}

// Add CSS animations
const style = document.createElement("style");
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .preview-announcement {
        background: var(--input-bg);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }
    
    .preview-title {
        color: var(--text-primary);
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .preview-message {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    
    .preview-meta {
        font-size: 0.875rem;
        color: var(--text-muted);
    }
    
    .modal-btn.secondary {
        background: var(--border-color);
        color: var(--text-secondary);
    }
    
    .modal-btn.secondary:hover {
        background: var(--input-border);
        color: var(--text-primary);
    }
`;
document.head.appendChild(style);
