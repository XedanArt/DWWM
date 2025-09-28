document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.social-card');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('card-in-view');
      }
    });
  }, { threshold: 0.1 });

  cards.forEach(card => observer.observe(card));
});