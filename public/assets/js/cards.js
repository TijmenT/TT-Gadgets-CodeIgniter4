function toggleCardsVisibility() {
    const container = document.querySelector('.product--products');
    const cards = document.querySelectorAll('.product--card1');
    const cardMargin = 0.25;
    const cardWidth = cards[0].offsetWidth; 
    const containerWidth = container.offsetWidth;
    const maxCardsPerRow = Math.floor(containerWidth / (cardWidth + cardWidth * cardMargin)); 
  
    cards.forEach((card, index) => {
        if (index < maxCardsPerRow) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none'; 
        }
    });
  
  
    if (cards.length <= maxCardsPerRow) {
        cards[cards.length - 1].style.display = 'block';
    }
  }
  
  
  window.addEventListener('load', toggleCardsVisibility);
window.addEventListener('resize', toggleCardsVisibility);