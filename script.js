document.querySelectorAll('.navbar a').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    
    const targetId = this.getAttribute('href');
    if(targetId === '#') return;
    
    const targetElement = document.querySelector(targetId);
    if(targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop - 20,
        behavior: 'smooth'
      });
      
      // Добавляем класс active к текущему пункту меню
      document.querySelectorAll('.navbar li').forEach(li => {
        li.classList.remove('active');
      });
      this.parentElement.classList.add('active');
    }
  });
});

// Добавляем класс active при скролле
window.addEventListener('scroll', function() {
  const scrollPosition = window.scrollY;
  
  document.querySelectorAll('section').forEach(section => {
    const sectionTop = section.offsetTop - 100;
    const sectionBottom = sectionTop + section.offsetHeight;
    
    if(scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
      const id = section.getAttribute('id');
      document.querySelectorAll('.navbar li').forEach(li => {
        li.classList.remove('active');
        if(li.querySelector('a').getAttribute('href') === `#${id}`) {
          li.classList.add('active');
        }
      });
    }
  });
});