document.addEventListener("DOMContentLoaded", () => {
const html = document.getElementById("htmlPage"); // for bootstrap dark/light mode
const checkbox = document.getElementById("theme-checkbox");
checkbox.addEventListener("change", ()=>{
    if (checkbox.checked) {
        html.setAttribute("data-bs-theme", "dark");
    } else {
        html.setAttribute("data-bs-theme", "light");
    }
});

    const selectResult = document.querySelector("#select-result .fi");
    const langList = document.querySelectorAll(
      '.icon-selector-component .radio-selector-list input[name="lang"]'
    );
    langList.forEach((input) => {
      input.addEventListener("change", () => {
        if (input.checked) {
          const label = input.nextElementSibling;
          const flag = label.querySelector(".fi");
          if (flag && selectResult) {
            selectResult.className = flag.className;
            console.log(flag.className);
          }
        }
      });
    });

    const topNavLinks = document.querySelectorAll(".left-nav .nav-link");
    const bottomNavLinks = document.querySelectorAll(".bottom-nav .nav-link");

    function handleNavClick(e, links) {
      e.preventDefault();
      links.forEach(link => link.classList.remove("active"));
      e.currentTarget.classList.add("active");
    }

    topNavLinks.forEach(link => {
      link.addEventListener("click", function (e) {
        handleNavClick(e, topNavLinks);
        // Sync with bottom nav (if needed)
        const index = [...topNavLinks].indexOf(link);
        bottomNavLinks.forEach(link => link.classList.remove("active"));
        if (bottomNavLinks[index]) bottomNavLinks[index].classList.add("active");
      });
    });

    bottomNavLinks.forEach(link => {
      link.addEventListener("click", function (e) {
        handleNavClick(e, bottomNavLinks);
        // Sync with top nav
        const index = [...bottomNavLinks].indexOf(link);
        topNavLinks.forEach(link => link.classList.remove("active"));
        if (topNavLinks[index]) topNavLinks[index].classList.add("active");
      });
    });

    let lastScrollY = window.scrollY;
    const navbar = document.getElementById("navbar");

    window.addEventListener("scroll", () => {
      const currentScrollY = window.scrollY;

      if (currentScrollY <= 0) {
        navbar.classList.remove("hidden");
      } else if (currentScrollY > lastScrollY) {
        // Scrolling down
        navbar.classList.add("hidden");
      } else {
        // Scrolling up
        navbar.classList.remove("hidden");
      }

      lastScrollY = currentScrollY;
    });

    
  });
