<?php
include "../components/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bad1.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Презентации</title>
</head>

<body>
    <header class="main_menu stay">
        <a href="../index.php">
            <div class="logo">
            <img src="../img/logo.png" alt="">
            <h6>Prese<b style="color: #1b4aa0;font-size: 2vw">INTE<b style="font-size: 2.5vw;">X</b></b><b style="color:#2ca3dc;font-size: 2vw">PRO</b></h6>
            </div>
        </a>
        <div class="main_menu_items">

            <!-- <a href="" class="main_menu_item">Предпросмотр</a> -->
            <!-- <a href="" class="main_menu_item">Показ</a> -->
        <?php 
               if (isset($_SESSION['user']) and isset($_SESSION['user']['name'])) { 
                echo "<a href='' class='main_menu_item'>Пользователь: {$_SESSION['user']['name']}</a> 
                <a href='components/exit.php' class='main_menu_item'>Выход</a>"; 
                }    else {
                    echo "<a href='pages/registration.php' class='main_menu_item'>Регистрация</a>
                    <a href='pages/authorization.php' class='main_menu_item'>Авторизация</a>";
                }
            ?>
        </div>
    </header>
    <main>
        <aside class="slides">
        <div id="slideContainer">

              </div>
              <div class="slide" id="addSlideButton">
                    <img src="../img/plus.png"
                        alt="">
                </div>
        </aside>

        <article class="article">
            <div class="fixed activeSlide" id="activeSlide">
                <p style="margin-top: 5vw;">для изменения слайда используйте РС или laptop</p>
            </div>
        </article>
        



        <div class="right-menu">
            <div class="presentation_pick_menu">
                <form id="mainForm" class='main_uni_choice'>
                    <label>
                        <input class='rad' type="radio" name="uni" value="1" checked>
                        <p><b>Функции</b></p>
                    </label>
                    <label>
                        <input class='rad' type="radio" name="uni" value="2">
                        <p><b>Дизайн</b></p>
                    </label>
                </form>
            </div>
            <hr style="margin-bottom: 2vw;">

            <div class="presentation_pick_elements" id="content1">
                <div class="presentation_pick_name">
                    <img src="https://w7.pngwing.com/pngs/932/861/png-transparent-addition-plus-and-minus-signs-plus-miscellaneous-sign-electric-blue-thumbnail.png"
                        alt="">
                    <p><b>Создание</b></p>
                </div>
                <div class="presentation_pick_gallery">
                    <button class="presentation_pick_element" onclick="showTitle()">
                        <img src="../img/quizbgHeading.png"
                            alt="">
                        <p>Заголовок</p>
                    </button>
                    <button class="presentation_pick_element" onclick="showContent()" >
                        <img src="../img/quizbgcontent.png"
                            alt="">
                        <p>Контент</p>
                    </button>
                    <button class="presentation_pick_element" onclick="showList()">
                        <img src="../img/quizbgList.png"
                            alt="">
                        <p>Список</p>
                    </button>
                    <button class="presentation_pick_element" onclick="showImage()">
                        <img src="../img/quizbgImage.png"
                            alt="">
                        <p>Изображение</p>
                    </button>
                </div>

                <div class="presentation_pick_name">
                    <img src="https://w7.pngwing.com/pngs/932/861/png-transparent-addition-plus-and-minus-signs-plus-miscellaneous-sign-electric-blue-thumbnail.png"
                        alt="">
                    <p><b>Коллективные опции</b></p>
                </div>
                <div class="presentation_pick_gallery">
                    <button class="presentation_pick_element" onclick="showQuestions()">
                        <img src="../img/quizbgQA.png"
                            alt="">
                        <p>Вопросы и ответы</p>
                    </button>
                    <button class="presentation_pick_element" onclick="showBrainstorm()">
                        <img src="../img/quizbgBrainStorm.png"
                            alt="">
                        <p>Мозговой штурм</p>
                    </button>
                    <button class="presentation_pick_element" onclick="showYoutube()">
                        <img src="../img/YouTube.png"
                            alt="">
                        <p>YouTube</p>
                    </button>
                </div>

                <div class="presentation_pick_name">
                    <img src="https://w7.pngwing.com/pngs/932/861/png-transparent-addition-plus-and-minus-signs-plus-miscellaneous-sign-electric-blue-thumbnail.png"
                        alt="">
                    <p><b>Collect options - Q&A</b></p>
                </div>
                <div class="presentation_pick_gallery" >
                    <button class="presentation_pick_element" id="addTextButton">
                        <img src="../img/textedit.png"
                            alt="">
                        <p>Добавить текст</p>
                    </button>
                    <button id="add-text">Добавить текст</button>
                    <button class="presentation_pick_element">
                        <img src="../img/plus.png"
                            alt="">
                        <p>Pick Answer</p>
                    </button>
                    <button class="presentation_pick_element">
                        <img src="../img/plus.png"
                            alt="">
                        <p>Spinner While</p>
                    </button>
                    <button class="presentation_pick_element">
                        <img src="../img/plus.png"
                            alt="">
                        <p>Pick Answer</p>
                    </button>
                </div>
            </div>

            <div class="presentation_pick_elements" id="content2" style="display:none;">
                <div class="presentation_pick_name">
                    <img src="https://w7.pngwing.com/pngs/932/861/png-transparent-addition-plus-and-minus-signs-plus-miscellaneous-sign-electric-blue-thumbnail.png"
                        alt="">
                    <p><b>Дизайн</b></p>
                </div>
                <div class="presentation_pick_gallery">
                <button class="presentation_pick_element" style="background-color: white" onclick="createbgph0()">
                        <p>Белый</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg1.png')" onclick="createbgph1()">
                        <p  style="color: white">Вечер</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg2.png')" onclick="createbgph2()">
                        <p  style="color: white">Ночь</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg3.png')" onclick="createbgph3()">
                        <p>Бизнесс</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg4.png')" onclick="createbgph4()">
                        <p  style="color: white">Будущее</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg5.png')" onclick="createbgph5()">
                        <p>Шоу</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg6.png')" onclick="createbgph6()">
                        <p>Вечеринка</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg7.png')" onclick="createbgph7()">
                        <p  style="color: white">Встреча</p>
                    </button>
                    <button class="presentation_pick_element" style="background-image: url('../img/bg8.png')" onclick="createbgph8()">
                        <p  style="color: white"> Ретро</p>
                    </button>
                </div>
            </div>
        </div>



        <!-- функции -->
        <div class="boxfunck2" id="contentSlide">
            <h1 class="contentSlide1" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:left; margin-top: 5%; margin-left: 2%; color: black;">Заголовок</h1>
            <!-- <h1 id="editableList" ondblclick="enableEditor('editableList')" style="text-align:left; margin-top: 5%; margin-left: 2%; color: black;">Заголовок</h1> -->
            <h3 class="contentSlide2" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:left; margin-left: 2.5%;">Нажмите для изменения</h3>
          </div>
          
          <div class="boxfunck2" id="questionsSlide">
            <h1 class="questionsSlide1" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:left; margin-top: 5%; margin-left: 2%;  color: black;">Заголовок</h1>
            <div class="container">
            <div class="block new-questions" id="new-questions">
              <h3 class="questionsSlide2">Новые вопросы</h3>
            </div>
            <div class="block answered-questions" id="answered-questions">
              <h3 class="questionsSlide3">Отвеченные вопросы</h3>
            </div>
          </div>
            <div class="block ask-question">
             
                <H3>Меню пользователя</H3>
                <hr>
                <h3>Задайте вопрос</h3>
                <textarea id='question-input' placeholder='Введите ваш вопрос' oninput='autoResize(this)'></textarea>
                <button onclick='submitQuestion()'>Отправить</button>;
              
            </div>
          
          </div>
          
          <div class="boxfunck2" id="titleSlide">
            <h1 class="titleSlide1" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align: center; color: black">Заголовок</h1>
            <h3  class="titleSlide2" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:center; ">Нажмите для изменения</h3>
          </div>
          
          <div class="boxfunck2" id="brainstormSlide">
            <h1 class="brainstormSlide1" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:left; margin-top: 5%; margin-left: 2%;  color: black;">Заголовок</h1>
          
            <div class="block new-idea" id="new-ideas"> 
            </div>
            
            <div class="block brainstorm ask-question" style="margin-top:0%">
              <h3>Меню пользователя</h3>
              <hr>
              <h4>Напишите вашу идею</h4>
              <textarea id="question-input" placeholder="Введите ваш вопрос" oninput="autoResize(this)"></textarea>
              <button onclick="submitIdea()">Отправить</button>
            </div>
            
            </div>
          </div>
          
          <div class="boxfunck2" id="listSlide">
            <h1 class="listSlide1" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:center; margin-top: 15%;  color: black;">Заголовок</h1>
            <ul class="listSlide2" oncontextmenu="showContextMenu(event, this)" id="editableText"   style="margin-left: 30%; font-size: 18px;">
              <li>Элемент 1</li>
              <li>Элемент 2</li>
              <li>Элемент 3</li>
            </ul>
          </div>
          
          <div class="boxfunck2" id="imageSlide">
            <h1 class="imageSlide1" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:center;  color: black; margin-top: 5%">Заголовок</h1>
            <div class="imageSlide2" id="square" onclick="openImageDialog()" style="text-align:center; margin-left: 32%;">Вставьте изображение</div>
            <h3 class="imageSlide3" oncontextmenu="showContextMenu(event, this)" id="editableText" style="text-align:center;">Описание</h3>
          </div>
          </div>

          <div class="boxfunck2" id="youtubeSlide">
            <div class="youtubeSlide1" id="video-container">
                <input type="text" id="video-link" placeholder="Вставьте ссылку на Youtube" style="margin-top: 0%; text-align: center;" oninput="loadVideo()">
                <div id="player" style="height: 10vw;"></div>
                </div>
            </div>
          

            <div id="contextMenu" class="context-menu"> 
                <div onclick="changeText()">Изменить текст</div> 
                <div onclick="changeSize()">Изменить размер</div> 
                <div onclick="changeColor()">Изменить цвет</div> 
                <div onclick="toggleBold()">Жирный</div> 
                <div onclick="toggleItalic()">Курсив</div> 
                <div onclick="changeFont()">Изменить шрифт</div> 
                <div onclick="deleteText()">Удалить текст</div>  
            </div>
        <!-- функции-конец -->





    
    </main>
    <script>
        variable1 = 2;
        const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    if (mutation.addedNodes.length > 0) {
      const block = document.querySelector('.block.ask-question');
      if (block && variable1 === 1) {
        block.style.display = 'none';
      }
    }
  });
});

observer.observe(document.body, {
  childList: true,
  subtree: true
});

    </script>

    <script>
    const activeSlide = document.querySelector('.activeSlide');
    const addTextBtn = document.getElementById('add-text');

    let isDragging = false;
    let offsetX = 0;
    let offsetY = 0;

    const texts = document.querySelectorAll('.text');
    texts.forEach((text) => {
      text.addEventListener('mousedown', (e) => {
        offsetX = e.clientX - text.offsetLeft;
        offsetY = e.clientY - text.offsetTop;
        isDragging = true;
      });

      text.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        text.style.left = Math.min(Math.max(e.clientX - offsetX, 0), activeSlide.offsetWidth - text.offsetWidth) + 'px';
        text.style.top = Math.min(Math.max(e.clientY - offsetY, 0), activeSlide.offsetHeight - text.offsetHeight) + 'px';
      });

      text.addEventListener('mouseup', () => {
        isDragging = false;
      });
    });

    addTextBtn.addEventListener('click', () => {
  const text = document.createElement('div');
  text.classList.add('text');
  text.setAttribute('oncontextmenu', 'showContextMenu(event, this)');
  text.setAttribute('id', 'editableText');
  text.style.display = 'block';
  text.innerText = 'Новый текст';

  text.addEventListener('mousedown', (e) => {
    offsetX = e.clientX - text.offsetLeft;
    offsetY = e.clientY - text.offsetTop;
    isDragging = true;
  });

  text.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    text.style.left = Math.min(Math.max(e.clientX - offsetX, 0), activeSlide.offsetWidth - text.offsetWidth) + 'px';
    text.style.top = Math.min(Math.max(e.clientY - offsetY, 0), activeSlide.offsetHeight - text.offsetHeight) + 'px';
  });

  text.addEventListener('mouseup', () => {
    isDragging = false;
  });

  activeSlide.appendChild(text);
});

  </script>
    <script>
function resizeSmallSlideObjects() {
  const smallSlideObjects = document.querySelectorAll('.small-slide');

  smallSlideObjects.forEach((object) => {
    const textElement = object.querySelector('div');
    textElement.style.transform = 'scale(1)';

    if (textElement.classList.contains('shuak2')) {
      textElement.style.fontSize = '0.2vw';
      textElement.style.marginTop = '-25%';
    } else {
      textElement.style.marginTop = '-13.5%';
    }
  });
}

// Вызовите функцию после загрузки страницы
resizeSmallSlideObjects();

// Вызывать функцию каждый раз, когда добавляется новый элемент с классом 'small-slide'
document.addEventListener('DOMNodeInserted', (event) => {
  if (event.target.classList.contains('small-slide')) {
    resizeSmallSlideObjects();
  }
});

        
document.addEventListener('DOMContentLoaded', function() {
    resizeSmallSlideObjects();
  var slides = document.getElementsByClassName('slide');
  for (var i = 0; i < slides.length; i++) {
    (function(slideId) {
      setInterval(function() {
        autoSaveSlideContent(slideId);
      }, 10000);
    })(slides[i].id);
  }
});
            document.getElementById('addSlideButton').addEventListener('click', addSlide);

// Функция для добавления слайда
function addSlide() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../components/add_slide.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                loadSlides(); 
            } else {
                alert('Произошла ошибка при добавлении слайда в базу данных.');
            }
        }
    };
    xhr.send('pr_id=<?php echo $_GET["id"]; ?>');
}

 // Функция для удаления слайда
 function deleteSlide(slideId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../components/delete_slide.php?id=' + slideId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                loadSlides(); 
            } else {
                alert('Произошла ошибка при удалении слайда.');
            }
        }
    };
    xhr.send();
}



function loadSlides() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../components/get_slides.php?id=<?php echo $_GET["id"]; ?>', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('slideContainer').innerHTML = xhr.responseText;
                let smallSlides = document.querySelectorAll('.small-slide');
                smallSlides.forEach(slide => {
                    var slideId = slide.firstChild.textContent;
                    slide.addEventListener('click', function() {
                        loadSlideContent(slideId);
                        toggleHover(slide);
                        smallSlides.forEach(otherSlide => {
                            if (otherSlide !== slide) {
                                otherSlide.classList.remove('hover');
                            }
                        });
                    });

                    var deleteButton = slide.lastChild;
                    deleteButton.addEventListener('click', function(event) {
                        event.stopPropagation();
                        deleteSlide(slideId);
                    });
                });
            } else {
                alert('Произошла ошибка при получении списка слайдов.');
            }
        }
    };
    xhr.send();
}





function toggleHover(element) {
    element.classList.toggle('hover');
}


var activeSlideId = null;

// Функция для загрузки содержимого конкретного слайда
function loadSlideContent(slideId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../components/get_slide_content.php?id=' + slideId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('activeSlide').innerHTML = xhr.responseText;
                activeSlideId = slideId;
            } else {
                alert('Произошла ошибка при получении содержимого слайда.');
            }
        }
    };
    xhr.send();
}

// Функция для сохранения содержимого слайда
function saveSlideContent(slideId) {
if (!slideId) {
console.error("Ошибка: slideId не был предоставлен.");
return;
}

var slideContent = document.getElementById('activeSlide').innerHTML;
var xhr = new XMLHttpRequest();
var url = "../components/save_slide_content.php"; // Это endpoint, куда будет отправлен запрос
var params = "id=" + slideId + "&content=" + encodeURIComponent(slideContent);
xhr.open("POST", url, true);

xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xhr.onreadystatechange = function () {
if (xhr.readyState === 4 && xhr.status === 200) {
  console.log(xhr.responseText);
}
};

xhr.send(params);
}

// Функция для отправки содержимого слайда на сервер и его сохранения
function saveSlideContentToServer(slideId, slideContent) { 
  var xhr = new XMLHttpRequest(); 
  var url = "../components/save_slide_content.php"; 
  var params = "id=" + slideId + "&content=" + encodeURIComponent(slideContent); 
  xhr.open("POST", url, true); 
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 

  xhr.onreadystatechange = function () { 
    if (xhr.readyState === 4 && xhr.status === 200) { 
      console.log(xhr.responseText);
    } 
  }; 

  xhr.send(params); 
} 
// Функция для автоматического сохранения содержимого активного слайда через каждые 10 секунд
function autoSaveSlideContent() {
    setInterval(function() {
        if (activeSlideId) {
            saveSlideContent(activeSlideId);
        }
    }, 1000); 
}

document.addEventListener('DOMContentLoaded', loadSlides);


    </script>



    <script src="../js/rad.js"></script>
    <script src="../js/editor2.js"></script>
    <script src="../js/bgph.js"></script>
    <script src="../js/youtube.js"></script>
    <script src="../js/imgset.js"></script>
    <script src="../js/brainstorm.js"></script>
    <script src="../js/questions.js"></script>
    <script src="../js/background.js"></script>
    <script src="../js/editor.js"></script>
    <script src="../js/slider.js"></script>
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
</body>

</html>