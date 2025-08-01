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

  // Initialize Event Calendar
  new EventCalendar();

  // Setup modal close functionality
  const modal = document.getElementById("event-modal-overlay");
  const cancelBtn = document.getElementById("cancel-event-btn");

  if (modal) {
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  }

  if (cancelBtn) {
    cancelBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });
  }
});

// Event Calendar Class
class EventCalendar {
  constructor() {
    this.currentDate = new Date();
    this.currentView = "month";
    this.events = [];
    this.init();
  }

  async init() {
    await this.loadEvents();
    this.setupEventListeners();
    this.renderCalendar();
  }

  async loadEvents() {
    try {
      const response = await fetch("fetch_announcements.php");
      const data = await response.json();

      if (data.success) {
        this.events = data.announcements.map((announcement) => ({
          id: announcement.id,
          title: announcement.title,
          description: announcement.message,
          date: announcement.date || this.formatDate(new Date()),
          time: announcement.time || "",
          type: "announcement",
          color: "#0c27be",
        }));
        this.renderCalendar();
      }
    } catch (error) {
      console.error("Error loading events:", error);
    }
  }

  setupEventListeners() {
    document.getElementById("prev-month")?.addEventListener("click", () => {
      this.navigateMonth(-1);
    });

    document.getElementById("next-month")?.addEventListener("click", () => {
      this.navigateMonth(1);
    });

    document.querySelectorAll(".view-btn").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        this.setView(e.target.dataset.view);
      });
    });
  }

  navigateMonth(direction) {
    this.currentDate.setMonth(this.currentDate.getMonth() + direction);
    this.renderCalendar();
  }

  setView(view) {
    this.currentView = view;
    document.querySelectorAll(".view-btn").forEach((btn) => {
      btn.classList.remove("active");
    });
    document.querySelector(`[data-view="${view}"]`)?.classList.add("active");
    this.renderCalendar();
  }

  renderCalendar() {
    this.updateHeader();
    this.renderMonthView();
  }

  updateHeader() {
    const header = document.getElementById("current-month");
    if (header) {
      const options = { year: "numeric", month: "long" };
      header.textContent = this.currentDate.toLocaleDateString(
        "en-US",
        options
      );
    }
  }

  renderMonthView() {
    const grid = document.getElementById("calendar-grid");
    if (!grid) return;

    const year = this.currentDate.getFullYear();
    const month = this.currentDate.getMonth();

    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay());

    let html = `
      <div class="calendar-weekdays">
        <div class="weekday">Sun</div>
        <div class="weekday">Mon</div>
        <div class="weekday">Tue</div>
        <div class="weekday">Wed</div>
        <div class="weekday">Thu</div>
        <div class="weekday">Fri</div>
        <div class="weekday">Sat</div>
      </div>
      <div class="calendar-days">
    `;

    for (let i = 0; i < 42; i++) {
      const currentDate = new Date(startDate);
      currentDate.setDate(startDate.getDate() + i);

      const isCurrentMonth = currentDate.getMonth() === month;
      const isToday = this.isToday(currentDate);
      const dayEvents = this.getEventsForDate(currentDate);

      const dayClass = `calendar-day ${
        isCurrentMonth ? "current-month" : "other-month"
      } ${isToday ? "today" : ""}`;

      html += `
        <div class="${dayClass}" data-date="${this.formatDate(currentDate)}">
          <div class="day-number">${currentDate.getDate()}</div>
          ${dayEvents
            .map(
              (event) => `
            <div class="event-dot" style="background-color: ${event.color}" title="${event.title}"></div>
          `
            )
            .join("")}
        </div>
      `;
    }

    html += "</div>";
    grid.innerHTML = html;

    grid.querySelectorAll(".calendar-day").forEach((day) => {
      day.addEventListener("click", () => {
        const date = day.dataset.date;
        this.showDayEvents(date);
      });
    });
  }

  getEventsForDate(date) {
    const dateStr = this.formatDate(date);
    return this.events.filter((event) => event.date === dateStr);
  }

  showDayEvents(date) {
    const events = this.getEventsForDate(new Date(date));

    if (events.length === 0) {
      this.showNotification("No events for this day", "info");
      return;
    }

    const modal = document.getElementById("event-modal-overlay");
    const content = document.getElementById("event-preview-content");

    if (modal && content) {
      content.innerHTML = events
        .map(
          (event) => `
        <div class="event-item">
          <h4>${event.title}</h4>
          <p>${event.description}</p>
          ${event.time ? `<p><strong>Time:</strong> ${event.time}</p>` : ""}
          <p><strong>Date:</strong> ${this.formatDate(new Date(event.date))}</p>
        </div>
      `
        )
        .join("");

      modal.style.display = "flex";
    }
  }

  isToday(date) {
    const today = new Date();
    return date.toDateString() === today.toDateString();
  }

  formatDate(date) {
    return date.toISOString().split("T")[0];
  }

  showNotification(message, type = "info") {
    const notification = document.createElement("div");
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
      <i class="fas fa-${this.getNotificationIcon(type)}"></i>
      <span>${message}</span>
    `;

    notification.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: ${this.getNotificationColor(type)};
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

    setTimeout(() => {
      notification.style.animation = "slideOutRight 0.3s ease-out";
      setTimeout(() => {
        if (notification.parentNode) {
          notification.parentNode.removeChild(notification);
        }
      }, 300);
    }, 3000);
  }

  getNotificationIcon(type) {
    const icons = {
      success: "check-circle",
      error: "exclamation-circle",
      warning: "exclamation-triangle",
      info: "info-circle",
    };
    return icons[type] || "info-circle";
  }

  getNotificationColor(type) {
    const colors = {
      success: "#10b981",
      error: "#ef4444",
      warning: "#f59e0b",
      info: "#8b5cf6",
    };
    return colors[type] || "#8b5cf6";
  }
}

// Event Calendar JavaScript
class EventCalendar {
  constructor() {
    this.currentDate = new Date();
    this.currentView = "month";
    this.events = [];
    this.init();
  }

  init() {
    this.loadEvents();
    this.setupEventListeners();
    this.renderCalendar();
  }

  async loadEvents() {
    try {
      const response = await fetch("fetch_announcements.php");
      const data = await response.json();

      if (data.success) {
        this.events = data.announcements.map((announcement) => ({
          id: announcement.id,
          title: announcement.title,
          description: announcement.message,
          date: announcement.date || this.formatDate(new Date()),
          time: announcement.time || "",
          type: "announcement",
          color: "#0c27be",
        }));
        this.renderCalendar();
      } else {
        console.error("Failed to load events:", data.message);
      }
    } catch (error) {
      console.error("Error loading events:", error);
    }
  }

  setupEventListeners() {
    // Navigation buttons
    document.getElementById("prev-month")?.addEventListener("click", () => {
      this.navigateMonth(-1);
    });

    document.getElementById("next-month")?.addEventListener("click", () => {
      this.navigateMonth(1);
    });

    // View buttons
    document.querySelectorAll(".view-btn").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        this.setView(e.target.dataset.view);
      });
    });
  }

  navigateMonth(direction) {
    this.currentDate.setMonth(this.currentDate.getMonth() + direction);
    this.renderCalendar();
  }

  setView(view) {
    this.currentView = view;

    // Update active button
    document.querySelectorAll(".view-btn").forEach((btn) => {
      btn.classList.remove("active");
    });
    document.querySelector(`[data-view="${view}"]`)?.classList.add("active");

    this.renderCalendar();
  }

  renderCalendar() {
    this.updateHeader();

    if (this.currentView === "month") {
      this.renderMonthView();
    } else if (this.currentView === "week") {
      this.renderWeekView();
    } else if (this.currentView === "day") {
      this.renderDayView();
    } else if (this.currentView === "list") {
      this.renderListView();
    }
  }

  updateHeader() {
    const header = document.getElementById("current-month");
    if (header) {
      const options = { year: "numeric", month: "long" };
      header.textContent = this.currentDate.toLocaleDateString(
        "en-US",
        options
      );
    }
  }

  renderMonthView() {
    const grid = document.getElementById("calendar-grid");
    if (!grid) return;

    const year = this.currentDate.getFullYear();
    const month = this.currentDate.getMonth();

    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay());

    let html = `
      <div class="calendar-weekdays">
        <div class="weekday">Sun</div>
        <div class="weekday">Mon</div>
        <div class="weekday">Tue</div>
        <div class="weekday">Wed</div>
        <div class="weekday">Thu</div>
        <div class="weekday">Fri</div>
        <div class="weekday">Sat</div>
      </div>
      <div class="calendar-days">
    `;

    for (let i = 0; i < 42; i++) {
      const currentDate = new Date(startDate);
      currentDate.setDate(startDate.getDate() + i);

      const isCurrentMonth = currentDate.getMonth() === month;
      const isToday = this.isToday(currentDate);
      const dayEvents = this.getEventsForDate(currentDate);

      const dayClass = `calendar-day ${
        isCurrentMonth ? "current-month" : "other-month"
      } ${isToday ? "today" : ""}`;

      html += `
        <div class="${dayClass}" data-date="${this.formatDate(currentDate)}">
          <div class="day-number">${currentDate.getDate()}</div>
          ${dayEvents
            .map(
              (event) => `
            <div class="event-dot" style="background-color: ${event.color}" title="${event.title}"></div>
          `
            )
            .join("")}
        </div>
      `;
    }

    html += "</div>";
    grid.innerHTML = html;

    // Add click listeners to days
    grid.querySelectorAll(".calendar-day").forEach((day) => {
      day.addEventListener("click", () => {
        const date = day.dataset.date;
        this.showDayEvents(date);
      });
    });
  }

  renderWeekView() {
    const grid = document.getElementById("calendar-grid");
    if (!grid) return;

    const weekStart = this.getWeekStart(this.currentDate);
    let html = '<div class="week-view">';

    for (let i = 0; i < 7; i++) {
      const currentDate = new Date(weekStart);
      currentDate.setDate(weekStart.getDate() + i);

      const dayEvents = this.getEventsForDate(currentDate);
      const isToday = this.isToday(currentDate);

      html += `
        <div class="week-day ${isToday ? "today" : ""}">
          <div class="day-header">
            <div class="day-name">${currentDate.toLocaleDateString("en-US", {
              weekday: "short",
            })}</div>
            <div class="day-number">${currentDate.getDate()}</div>
          </div>
          <div class="day-events">
            ${dayEvents
              .map(
                (event) => `
              <div class="week-event" style="border-left: 3px solid ${
                event.color
              }">
                <div class="event-title">${event.title}</div>
                ${
                  event.time
                    ? `<div class="event-time">${event.time}</div>`
                    : ""
                }
              </div>
            `
              )
              .join("")}
          </div>
        </div>
      `;
    }

    html += "</div>";
    grid.innerHTML = html;
  }

  renderDayView() {
    const grid = document.getElementById("calendar-grid");
    if (!grid) return;

    const dayEvents = this.getEventsForDate(this.currentDate);

    let html = `
      <div class="day-view">
        <div class="day-header">
          <h3>${this.currentDate.toLocaleDateString("en-US", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
          })}</h3>
        </div>
        <div class="day-events">
          ${
            dayEvents.length > 0
              ? dayEvents
                  .map(
                    (event) => `
            <div class="day-event" style="border-left: 4px solid ${
              event.color
            }">
              <div class="event-header">
                <h4 class="event-title">${event.title}</h4>
                ${
                  event.time
                    ? `<span class="event-time">${event.time}</span>`
                    : ""
                }
              </div>
              <div class="event-description">${event.description}</div>
            </div>
          `
                  )
                  .join("")
              : '<div class="no-events">No events for this day</div>'
          }
        </div>
      </div>
    `;

    grid.innerHTML = html;
  }

  renderListView() {
    const grid = document.getElementById("calendar-grid");
    if (!grid) return;

    const sortedEvents = [...this.events].sort(
      (a, b) => new Date(a.date) - new Date(b.date)
    );

    let html = `
      <div class="list-view">
        <h3>All Events</h3>
        <div class="events-list">
          ${
            sortedEvents.length > 0
              ? sortedEvents
                  .map(
                    (event) => `
            <div class="list-event" style="border-left: 4px solid ${
              event.color
            }">
              <div class="event-date">${this.formatDate(
                new Date(event.date)
              )}</div>
              <div class="event-content">
                <h4 class="event-title">${event.title}</h4>
                <div class="event-description">${event.description}</div>
                ${
                  event.time
                    ? `<div class="event-time">${event.time}</div>`
                    : ""
                }
              </div>
            </div>
          `
                  )
                  .join("")
              : '<div class="no-events">No events scheduled</div>'
          }
        </div>
      </div>
    `;

    grid.innerHTML = html;
  }

  getEventsForDate(date) {
    const dateStr = this.formatDate(date);
    return this.events.filter((event) => event.date === dateStr);
  }

  showDayEvents(date) {
    const events = this.getEventsForDate(new Date(date));

    if (events.length === 0) {
      this.showNotification("No events for this day", "info");
      return;
    }

    const modal = document.getElementById("event-modal-overlay");
    const content = document.getElementById("event-preview-content");

    if (modal && content) {
      content.innerHTML = events
        .map(
          (event) => `
        <div class="event-item">
          <h4>${event.title}</h4>
          <p>${event.description}</p>
          ${event.time ? `<p><strong>Time:</strong> ${event.time}</p>` : ""}
          <p><strong>Date:</strong> ${this.formatDate(new Date(event.date))}</p>
        </div>
      `
        )
        .join("");

      modal.style.display = "flex";
    }
  }

  getWeekStart(date) {
    const d = new Date(date);
    const day = d.getDay();
    const diff = d.getDate() - day;
    return new Date(d.setDate(diff));
  }

  isToday(date) {
    const today = new Date();
    return date.toDateString() === today.toDateString();
  }

  formatDate(date) {
    return date.toISOString().split("T")[0];
  }

  showNotification(message, type = "info") {
    const notification = document.createElement("div");
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
      <i class="fas fa-${this.getNotificationIcon(type)}"></i>
      <span>${message}</span>
    `;

    notification.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: ${this.getNotificationColor(type)};
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

    setTimeout(() => {
      notification.style.animation = "slideOutRight 0.3s ease-out";
      setTimeout(() => {
        if (notification.parentNode) {
          notification.parentNode.removeChild(notification);
        }
      }, 300);
    }, 3000);
  }

  getNotificationIcon(type) {
    const icons = {
      success: "check-circle",
      error: "exclamation-circle",
      warning: "exclamation-triangle",
      info: "info-circle",
    };
    return icons[type] || "info-circle";
  }

  getNotificationColor(type) {
    const colors = {
      success: "#10b981",
      error: "#ef4444",
      warning: "#f59e0b",
      info: "#8b5cf6",
    };
    return colors[type] || "#8b5cf6";
  }
}

// Initialize calendar when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  new EventCalendar();

  // Setup modal close functionality
  const modal = document.getElementById("event-modal-overlay");
  const cancelBtn = document.getElementById("cancel-event-btn");

  if (modal) {
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  }

  if (cancelBtn) {
    cancelBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });
  }
});

// Add CSS animations
const style = document.createElement("style");
style.textContent = `
  @keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
  
  @keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
  }
  
  .calendar-weekdays {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: var(--border-color);
    border-radius: 8px 8px 0 0;
  }
  
  .weekday {
    background: var(--section-header);
    color: white;
    padding: 1rem;
    text-align: center;
    font-weight: 600;
  }
  
  .calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: var(--border-color);
    border-radius: 0 0 8px 8px;
  }
  
  .calendar-day {
    background: var(--input-bg);
    min-height: 100px;
    padding: 0.5rem;
    cursor: pointer;
    transition: background-color 0.2s;
    position: relative;
  }
  
  .calendar-day:hover {
    background: var(--menu-hover-bg);
  }
  
  .calendar-day.other-month {
    opacity: 0.5;
  }
  
  .calendar-day.today {
    background: var(--accent);
    color: white;
  }
  
  .day-number {
    font-weight: 600;
    margin-bottom: 0.5rem;
  }
  
  .event-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin: 1px;
    display: inline-block;
  }
  
  .week-view {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: var(--border-color);
    border-radius: 8px;
  }
  
  .week-day {
    background: var(--input-bg);
    min-height: 150px;
    padding: 1rem;
  }
  
  .day-header {
    text-align: center;
    margin-bottom: 1rem;
  }
  
  .day-name {
    font-size: 0.875rem;
    color: var(--text-muted);
  }
  
  .day-number {
    font-size: 1.25rem;
    font-weight: 600;
  }
  
  .week-event {
    background: var(--section-bg);
    padding: 0.5rem;
    margin-bottom: 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
  }
  
  .event-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
  }
  
  .event-time {
    font-size: 0.75rem;
    color: var(--text-muted);
  }
  
  .day-view {
    background: var(--input-bg);
    border-radius: 8px;
    padding: 2rem;
  }
  
  .day-event {
    background: var(--section-bg);
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 8px;
  }
  
  .event-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
  }
  
  .event-description {
    color: var(--text-secondary);
    line-height: 1.6;
  }
  
  .list-view {
    background: var(--input-bg);
    border-radius: 8px;
    padding: 2rem;
  }
  
  .list-event {
    background: var(--section-bg);
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 8px;
    display: flex;
    gap: 1rem;
  }
  
  .event-date {
    font-weight: 600;
    color: var(--accent);
    min-width: 100px;
  }
  
  .no-events {
    text-align: center;
    color: var(--text-muted);
    padding: 2rem;
  }
  
  .event-item {
    background: var(--section-bg);
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 8px;
  }
`;
document.head.appendChild(style);
