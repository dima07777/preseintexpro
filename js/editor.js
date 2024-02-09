var dragged;

var dragged;

document.getElementById('addTextButton').addEventListener('click', function() {
  var activeSlide = document.getElementById('activeSlide'); 
  var newText = document.createElement('div'); 
  newText.contentEditable = true;
  newText.appendChild(document.createTextNode('Нажмите для изменения')); 
  activeSlide.appendChild(newText); 

  newText.addEventListener('dblclick', function(event) {
    var targetElement = event.target;
    targetElement.contentEditable = false;
    tinymce.init({
      target: targetElement,
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
      setup: function (editor) {
        editor.on('init', function () {
          editor.setContent(targetElement.innerHTML);
        });
        editor.on('blur', function () {
          targetElement.innerHTML = editor.getContent();
          tinymce.remove();
          targetElement.contentEditable = true;
        });
      }
    });
  });

  makeDraggable(newText); 
  makeResizable(newText); 
});

  outerContainer.appendChild(textContainer);
  makeDraggable(textContainer);
  makeResizable(textContainer);


function makeResizable(element) {
  element.style.resize = 'both';
  element.style.overflow = 'auto';
}

function makeDraggable(element) {
    var isDragging = false;
    var deltaX, deltaY;
  
    element.addEventListener('mousedown', function(e) {
      isDragging = true;
      var rect = element.getBoundingClientRect();
      deltaX = e.clientX - rect.left;
      deltaY = e.clientY - rect.top;
    });
  
    document.addEventListener('mousemove', function(e) {
      if (isDragging) {
        element.style.position = 'absolute';
        element.style.left = e.clientX - deltaX + 'px';
        element.style.top = e.clientY - deltaY + 'px';
      }
    });
  
    document.addEventListener('mouseup', function() {
      isDragging = false;
    });
  }