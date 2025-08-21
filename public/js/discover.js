
  document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".overlay-text-discover");

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("active");
        }
      });
    }, { threshold: 0.3 });

    elements.forEach(el => {
      el.classList.add("fade-in-up-discover");
      observer.observe(el);
    });
  });
