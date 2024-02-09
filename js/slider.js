
// window.onload = function() {
//      showSlide(0);
//  };
//  let slideCount = 3;

//  document.getElementById('createSlide').addEventListener('click', function() {
//      const newSlide = document.createElement('div');
//      newSlide.className = 'small-slide';
//      newSlide.textContent = 'Слайд ' + (slideCount + 1);
//      newSlide.onclick = function() {
//          showSlide(slideCount + 1);
//      };
//      document.querySelector('.small-slides').appendChild(newSlide);
//      slideCount++;
//  });

//  document.getElementById('deleteSlide').addEventListener('click', function() {
//      const smallSlides = document.querySelectorAll('.small-slide');
//      if(slideCount > 3) {
//          document.querySelector('.small-slides').removeChild(smallSlides[slideCount - 1]);
//          slideCount--;
//      }
//  });



//  document.getElementById('presentationMode').addEventListener('click', function() {
//      document.getElementById('presentationButtons').style.display = 'block';
//      document.querySelector('.menu').style.display = 'none';
//      document.querySelector('.small-slides').style.display = 'none';
//      document.getElementById('activeSlide').classList.add('full-screen-slide');
//      document.getElementById('presentationMode').style.display = 'none';
//  });

//  function showSlide(slideIndex) {
//      const smallSlides = document.querySelectorAll('.small-slide');
//      smallSlides.forEach(slide => slide.classList.remove('active-slide'));
//      document.getElementById('activeSlide').textContent = 'Слайд ' + (slideIndex);
//      document.getElementById('activeSlide').classList.add('active-slide');
//      if(document.getElementById('presentationButtons').style.display === 'none') {
//          exitPresentationMode();
//      }
//  }

//  function showPrevSlide() {
//      const activeIndex = parseInt(document.getElementById('activeSlide').textContent.split(' ')[1]);
//      if (activeIndex > 1) {
//          showSlide(activeIndex - 1);
//      }
//  }

//  function showNextSlide() {
//      const activeIndex = parseInt(document.getElementById('activeSlide').textContent.split(' ')[1]);
//      if (activeIndex < slideCount) {
//          showSlide(activeIndex + 1);
//      }
//  }

//  function exitPresentationMode() {
//      document.getElementById('presentationButtons').style.display = 'none';
//      document.querySelector('.menu').style.display = 'flex';
//      document.querySelector('.small-slides').style.display = 'flex';
//      document.getElementById('activeSlide').classList.remove('full-screen-slide');
//      document.getElementById('presentationMode').style.display = 'block';
//  }

//  document.getElementById('prevSlide').addEventListener('click', showPrevSlide);
//  document.getElementById('nextSlide').addEventListener('click', showNextSlide);
