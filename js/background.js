function changeBackground(imageUrl) {
    document.getElementById('activeSlide').style.backgroundImage = "url('../img/" + imageUrl + "')";
  }

  function showTitle() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('titleSlide').innerHTML;
  }
  function showYoutube() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('youtubeSlide').innerHTML;
  }
  function showBrainstorm() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('brainstormSlide').innerHTML;
  }

  function showContent() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('contentSlide').innerHTML;
  }

  function showList() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('listSlide').innerHTML;
  }

  function showImage() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('imageSlide').innerHTML;
  }

  function showQuestions() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('questionsSlide').innerHTML;
  }

  document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("click", function(event) {
      var isEditorClicked = false;
      var targetElement = event.target;

      while (targetElement) {
        if (targetElement.classList && targetElement.classList.contains("tox-tinymce")) {
          isEditorClicked = true;
          break;
        }
        targetElement = targetElement.parentElement;
      }

      if (!isEditorClicked) {
        tinymce.activeEditor?.remove();
      }
    });
  });

  function showContent() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('contentSlide').innerHTML;
  }

  function showList() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('listSlide').innerHTML;
  }

  function showImage() {
    document.querySelector('.activeSlide').innerHTML = document.getElementById('imageSlide').innerHTML;
  }

  function enableEditor(elementId) {
    tinymce.init({
      selector: "#" + elementId,
    });
  }