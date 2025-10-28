document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
  const sections = document.querySelectorAll("section, header");
  const navLinks = document.querySelectorAll(".nav-link");

  // --- Navbar transparency behavior ---
  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // --- Active section highlight ---
  window.addEventListener("scroll", () => {
    let current = "";
    const scrollPos = window.scrollY + window.innerHeight / 3;

    sections.forEach(section => {
      const top = section.offsetTop;
      const height = section.offsetHeight;
      if (scrollPos >= top && scrollPos < top + height) {
        current = section.getAttribute("id");
      }
    });

    // Handle bottom of page
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
      current = "contact";
    }

    navLinks.forEach(link => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current) {
        link.classList.add("active");
      }
    });
  });

  // --- Smooth scrolling for nav links ---
  navLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const target = document.getElementById(targetId);
      if (target) target.scrollIntoView({ behavior: "smooth" });

      const navbarCollapse = document.querySelector(".navbar-collapse");
      if (navbarCollapse && navbarCollapse.classList.contains("show")) {
        new bootstrap.Collapse(navbarCollapse).toggle();
      }
    });
  });

  // --- Hero buttons ---
  const reserveBtn = document.getElementById("reserveBtn");
  const readMoreBtn = document.getElementById("readMoreBtn");

  if (reserveBtn) {
    reserveBtn.addEventListener("click", e => {
      e.preventDefault();
      // 🔽 FIX: Scroll to the schedule form instead of slots
      const scheduleSection = document.getElementById("reservation");
      if (scheduleSection) scheduleSection.scrollIntoView({ behavior: "smooth" });
    });
  }

  if (readMoreBtn) {
    readMoreBtn.addEventListener("click", e => {
      e.preventDefault();
      const aboutSection = document.getElementById("about");
      if (aboutSection) aboutSection.scrollIntoView({ behavior: "smooth" });
    });
  }
});
