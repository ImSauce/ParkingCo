document.addEventListener("DOMContentLoaded", function () {

  // ✅ Navbar background on scroll
  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  });

  // ✅ Dynamic underline highlight on scroll
  const sections = document.querySelectorAll("section, header");
  const navLinks = document.querySelectorAll(".nav-link");

  window.addEventListener("scroll", () => {
    let current = "";
    const scrollPos = window.scrollY + window.innerHeight / 3;

    sections.forEach(section => {
      const top = section.offsetTop;
      const height = section.offsetHeight;
      const id = section.getAttribute("id");

      if (scrollPos >= top && scrollPos < top + height) {
        current = id;
      }
    });

    // ✅ Trigger "Contact" when reaching near bottom
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 20) {
      current = "contact";
    }

    navLinks.forEach(link => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current) {
        link.classList.add("active");
      }
    });
  });

  // ✅ Smooth scrolling + mobile nav auto-close
  navLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      const targetID = this.getAttribute("href");

      // Skip external links like Aboutus.html
      if (!targetID.startsWith("#")) return;

      e.preventDefault();

      const section = document.querySelector(targetID);
      if (section) section.scrollIntoView({ behavior: "smooth" });

      // Close mobile navbar if open
      const navbarCollapse = document.querySelector(".navbar-collapse");
      if (navbarCollapse.classList.contains("show")) {
        new bootstrap.Collapse(navbarCollapse).toggle();
      }
    });
  });

  // ✅ Reserve button scroll
  const reserveBtn = document.getElementById("reserveBtn");
  if (reserveBtn) {
    reserveBtn.addEventListener("click", function (event) {
      event.preventDefault();
      document.getElementById("slots").scrollIntoView({ behavior: "smooth" });
    });
  }

  // ✅ Read More scroll
  const readMoreBtn = document.getElementById("readMoreBtn");
  if (readMoreBtn) {
    readMoreBtn.addEventListener("click", function (event) {
      event.preventDefault();
      document.getElementById("about").scrollIntoView({ behavior: "smooth" });
    });
  }

});
