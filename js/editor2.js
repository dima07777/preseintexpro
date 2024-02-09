function showContextMenu(event, element) {
    event.preventDefault();
    const contextMenu = document.getElementById('contextMenu');
    contextMenu.style.display = 'block';
    contextMenu.style.left = event.clientX + 'px';
    contextMenu.style.top = event.clientY + 'px';
    
    contextMenu.targetElement = element;
  }
  
  function changeText() {
    const contextMenu = document.getElementById('contextMenu');
    const editableText = contextMenu.targetElement;
    
    const newText = prompt('Введите новый текст', editableText.innerText);
    if (newText !== null) {
      editableText.innerText = newText;
    }
    hideContextMenu();
  }
  
  function changeSize() {
    const contextMenu = document.getElementById('contextMenu');
    const editableText = contextMenu.targetElement;
    
    const newSize = prompt('Введите новый размер (без px)', window.getComputedStyle(editableText).fontSize);
    if (newSize !== null) {
      editableText.style.fontSize = newSize + 'px';
    }
    hideContextMenu();
  }
  
  function changeColor() {
    const contextMenu = document.getElementById('contextMenu');
    const editableText = contextMenu.targetElement;
    
    const newColor = prompt('Введите новый цвет (например, green или black)', window.getComputedStyle(editableText).color);
    if (newColor !== null) {
      editableText.style.color = newColor;
    }
    hideContextMenu();
  }
  
  function toggleBold() {
    const contextMenu = document.getElementById('contextMenu');
    const editableText = contextMenu.targetElement;
    
    editableText.style.fontWeight = editableText.style.fontWeight === 'bold' ? 'normal' : 'bold';
    hideContextMenu();
  }
  
  function toggleItalic() {
    const contextMenu = document.getElementById('contextMenu');
    const editableText = contextMenu.targetElement;
  
    editableText.style.fontStyle = editableText.style.fontStyle === 'italic' ? 'normal' : 'italic';
    hideContextMenu();
  }
  
  function changeFont() {
    const contextMenu = document.getElementById('contextMenu');
    const editableText = contextMenu.targetElement;
    
    const newFont = prompt('Введите новый шрифт (например, Arial или Times New Roman)', window.getComputedStyle(editableText).fontFamily);
    if (newFont !== null) {
      editableText.style.fontFamily = newFont;
    }
    hideContextMenu();
  }
  
  function deleteText() {
    const contextMenu = document.getElementById('contextMenu');
    const editableText = contextMenu.targetElement;
    
    editableText.innerText = '';
    hideContextMenu();
  }
  
  function hideContextMenu() { 
    const contextMenu = document.getElementById('contextMenu'); 
    contextMenu.style.display = 'none'; 
  }