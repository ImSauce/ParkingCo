document.addEventListener("DOMContentLoaded", function () {
  // Navbar transparent at top, solid when scrolling
  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) { // threshold for solid background
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled"); // transparent at top
    }
  });

  // Highlight active section in navbar
  const sections = document.querySelectorAll("section, header");
  const navLinks = document.querySelectorAll(".nav-link");

  window.addEventListener("scroll", () => {
    let current = "";
    let scrollPos = window.scrollY + window.innerHeight / 3;

    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;

      if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
        current = section.getAttribute("id");
      }
    });

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

  // Smooth scrolling for navbar links
  navLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        targetSection.scrollIntoView({ behavior: "smooth" });
      }

      // Auto-collapse navbar on mobile
      const navbarCollapse = document.querySelector(".navbar-collapse");
      if (navbarCollapse.classList.contains("show")) {
        new bootstrap.Collapse(navbarCollapse).toggle();
      }
    });
  });

  // Buttons scroll to sections
  document.getElementById("reserveBtn").addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById("slots").scrollIntoView({ behavior: "smooth" });
  });

  document.getElementById("readMoreBtn").addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById("about").scrollIntoView({ behavior: "smooth" });
  });
});
