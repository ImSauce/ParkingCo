document.getElementById("reserveBtn").addEventListener("click", function () {
  document.getElementById("slots").scrollIntoView({ behavior: "smooth" });
});

document.getElementById("readMoreBtn").addEventListener("click", function () {
  document.getElementById("about").scrollIntoView({ behavior: "smooth" });
});


// Nav scroll effect
window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});