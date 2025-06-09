document.addEventListener("DOMContentLoaded", function () {
  // Theme toggle (existing code)
  const themeToggle = document.createElement("button");
  themeToggle.className = "theme-toggle";
  themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
  themeToggle.setAttribute("aria-label", "Toggle dark mode");
  document.body.appendChild(themeToggle);

  const currentTheme = localStorage.getItem("theme");
  if (currentTheme === "dark") {
    document.body.classList.add("dark-mode");
    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
  }

  themeToggle.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
    const isDark = document.body.classList.contains("dark-mode");

    if (isDark) {
      localStorage.setItem("theme", "dark");
      themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    } else {
      localStorage.setItem("theme", "light");
      themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
    }
  });

  // Mobile Navigation Toggle (existing code)
  const navToggle = document.querySelector(".nav-toggle");
  const navList = document.querySelector(".nav-list");

  navToggle.addEventListener("click", function () {
    navToggle.classList.toggle("active");
    navList.classList.toggle("active");
  });

  const navLinks = document.querySelectorAll(".nav-link");
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      if (navList.classList.contains("active")) {
        navToggle.classList.remove("active");
        navList.classList.remove("active");
      }
    });
  });

  const sections = document.querySelectorAll("section[id]");

  function updateActiveNavLink() {
    let scrollPosition = window.scrollY + 200; // Adding offset for better detection

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute("id");

      if (
        scrollPosition >= sectionTop &&
        scrollPosition < sectionTop + sectionHeight
      ) {
        navLinks.forEach((link) => {
          link.classList.remove("active");
          if (
            link.getAttribute("href") === `#${sectionId}` ||
            (link.getAttribute("href").includes(sectionId) &&
              link.getAttribute("href").startsWith("#"))
          ) {
            link.classList.add("active");
          }
        });
      }
    });

    // Handle home page special case
    if (scrollPosition < sections[0]?.offsetTop || sections.length === 0) {
      navLinks.forEach((link) => {
        link.classList.remove("active");
        if (
          link.getAttribute("href") === "index.php" ||
          link.getAttribute("href") === "/"
        ) {
          link.classList.add("active");
        }
      });
    }
  }

  // Initial call
  updateActiveNavLink();

  // Add scroll event listener
  window.addEventListener("scroll", updateActiveNavLink);

  // Click event for nav links to update active state
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      navLinks.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    });
  });

  // Existing smooth scrolling and other functionality...
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();

      const targetId = this.getAttribute("href");
      if (targetId === "#") return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        const headerHeight = document.querySelector(".header").offsetHeight;
        const targetPosition =
          targetElement.getBoundingClientRect().top +
          window.pageYOffset -
          headerHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });
      }
    });
  });

  // Back to top button (existing code)
  const backToTopButton = document.createElement("button");
  backToTopButton.innerHTML = "&uarr;";
  backToTopButton.className = "back-to-top";
  backToTopButton.setAttribute("aria-label", "Back to top");
  document.body.appendChild(backToTopButton);

  window.addEventListener("scroll", function () {
    if (window.pageYOffset > 300) {
      backToTopButton.style.display = "block";
    } else {
      backToTopButton.style.display = "none";
    }
  });

  backToTopButton.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });
});
