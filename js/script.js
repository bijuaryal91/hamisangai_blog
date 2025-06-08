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

  // Blog Search Functionality
  const searchForm = document.getElementById("blog-search");
  const searchInput = document.getElementById("search-input");
  const blogPosts = document.querySelectorAll(".blog-post-card");

  searchForm.addEventListener("submit", function (e) {
    e.preventDefault();
    filterBlogPosts();
  });

  searchInput.addEventListener("input", function () {
    filterBlogPosts();
  });

  // Category Filter Functionality
  const categoryFilter = document.getElementById("category-filter");
  categoryFilter.addEventListener("change", filterBlogPosts);

  // Sort Functionality
  const sortBy = document.getElementById("sort-by");
  sortBy.addEventListener("change", sortBlogPosts);

  // Filter and Sort Blog Posts
  function filterBlogPosts() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedCategory = categoryFilter.value;

    blogPosts.forEach((post) => {
      const title = post.querySelector(".post-title").textContent.toLowerCase();
      const excerpt = post
        .querySelector(".post-excerpt")
        .textContent.toLowerCase();
      const category = post.getAttribute("data-category");

      const matchesSearch =
        searchTerm === "" ||
        title.includes(searchTerm) ||
        excerpt.includes(searchTerm);

      const matchesCategory =
        selectedCategory === "all" || category === selectedCategory;

      if (matchesSearch && matchesCategory) {
        post.style.display = "block";
      } else {
        post.style.display = "none";
      }
    });

    // After filtering, we should re-sort the visible posts
    sortBlogPosts();
  }

  function sortBlogPosts() {
    const postsContainer = document.querySelector(".blog-posts-grid");
    const posts = Array.from(
      document.querySelectorAll(
        '.blog-post-card[style="display: block"], .blog-post-card:not([style])'
      )
    );
    const sortValue = sortBy.value;

    posts.sort((a, b) => {
      switch (sortValue) {
        case "newest":
          return (
            new Date(b.getAttribute("data-date")) -
            new Date(a.getAttribute("data-date"))
          );
        case "oldest":
          return (
            new Date(a.getAttribute("data-date")) -
            new Date(b.getAttribute("data-date"))
          );
        case "title-asc":
          return a
            .querySelector(".post-title")
            .textContent.localeCompare(
              b.querySelector(".post-title").textContent
            );
        case "title-desc":
          return b
            .querySelector(".post-title")
            .textContent.localeCompare(
              a.querySelector(".post-title").textContent
            );
        default:
          return 0;
      }
    });

    // Re-append posts in new order
    posts.forEach((post) => {
      postsContainer.appendChild(post);
    });
  }

  // Pagination Functionality (simplified example)
  const pageLinks = document.querySelectorAll(
    ".page-link:not(.prev):not(.next)"
  );
  pageLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      // Remove active class from all page links
      pageLinks.forEach((l) => l.classList.remove("active"));

      // Add active class to clicked link
      this.classList.add("active");

      // In a real implementation, you would load the new page content here
      // This is just a demonstration
      console.log("Loading page:", this.textContent);
    });
  });

  // Previous and Next buttons
  const prevLink = document.querySelector(".page-link.prev");
  const nextLink = document.querySelector(".page-link.next");

  prevLink.addEventListener("click", function (e) {
    e.preventDefault();
    if (this.classList.contains("disabled")) return;

    const activePage = document.querySelector(".page-link.active");
    const prevPage = activePage.previousElementSibling;

    if (prevPage && prevPage.classList.contains("page-link")) {
      activePage.classList.remove("active");
      prevPage.classList.add("active");
      nextLink.classList.remove("disabled");

      if (
        !prevPage.previousElementSibling ||
        !prevPage.previousElementSibling.classList.contains("page-link")
      ) {
        this.classList.add("disabled");
      }

      // In a real implementation, load the previous page content
      console.log("Loading previous page:", prevPage.textContent);
    }
  });

  nextLink.addEventListener("click", function (e) {
    e.preventDefault();
    if (this.classList.contains("disabled")) return;

    const activePage = document.querySelector(".page-link.active");
    const nextPage = activePage.nextElementSibling;

    if (nextPage && nextPage.classList.contains("page-link")) {
      activePage.classList.remove("active");
      nextPage.classList.add("active");
      prevLink.classList.remove("disabled");

      if (
        !nextPage.nextElementSibling ||
        !nextPage.nextElementSibling.classList.contains("page-link")
      ) {
        this.classList.add("disabled");
      }

      // In a real implementation, load the next page content
      console.log("Loading next page:", nextPage.textContent);
    }
  });

  // Initialize pagination state
  function initPagination() {
    prevLink.classList.add("disabled");
    document
      .querySelector(".page-link:not(.prev):not(.next)")
      .classList.add("active");
  }

  initPagination();

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
