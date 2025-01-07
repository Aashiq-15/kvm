document.addEventListener("DOMContentLoaded", () => {
    const heroSection = document.getElementById("hero");
    const images = heroSection.getAttribute("data-images").split(", ");
    let currentIndex = 0;

    setInterval(() => {
      heroSection.style.backgroundImage = `url(${images[currentIndex]})`;
      currentIndex = (currentIndex + 1) % images.length;
    }, 5000);
  });

  document.addEventListener("DOMContentLoaded", function () {
    const grid = document.querySelector('.isotope-container');
    const iso = new Isotope(grid, {
      itemSelector: '.portfolio-item',
      layoutMode: 'masonry',
    });

    // Portfolio filter functionality
    const filters = document.querySelectorAll('.portfolio-filters li');
    filters.forEach(function (filter) {
      filter.addEventListener('click', function () {
        const filterValue = filter.getAttribute('data-filter');
        iso.arrange({ filter: filterValue });
        filters.forEach(f => f.classList.remove('filter-active'));
        filter.classList.add('filter-active');
      });
    });

    // Initialize AOS
    AOS.init({ duration: 1000, once: true });

    // Initialize GLightbox
    const lightbox = GLightbox({ selector: '.glightbox' });
  });