console.log("✅ Fichier devblog.js chargé");

document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.devblog-card');
  const prevBtn = document.querySelector('.devblog-nav.prev');
  const nextBtn = document.querySelector('.devblog-nav.next');

  if (!cards.length || !prevBtn || !nextBtn) {
    console.warn("⚠️ Élément(s) introuvable(s)");
    return;
  }

  let index = 0;

  function updateSlider() {
    cards.forEach((card, i) => {
      card.classList.remove('prev', 'active', 'next', 'hidden');

      if (i === index) {
        card.classList.add('active');
      } else if (i === (index - 1 + cards.length) % cards.length) {
        card.classList.add('prev');
      } else if (i === (index + 1) % cards.length) {
        card.classList.add('next');
      } else {
        card.classList.add('hidden');
      }
    });
  }

  nextBtn.addEventListener('click', (e) => {
    e.preventDefault();
    index = (index + 1) % cards.length;
    updateSlider();
  });

  prevBtn.addEventListener('click', (e) => {
    e.preventDefault();
    index = (index - 1 + cards.length) % cards.length;
    updateSlider();
  });

  updateSlider(); // affichage initial
});
