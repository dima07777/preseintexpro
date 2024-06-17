const status = document.getElementById('status');
const messages = document.getElementById('messages');
const form = document.getElementById('form');
const input = document.getElementById('input');

const ws = new WebSocket('ws://localhost:3000');

function setStatus(value) {
  status.innerHTML = value;
}

function printMessage(value) {
  const li = document.createElement('li');

  li.innerHTML = value;
  messages.appendChild(li);
}

// Обработка сообщений чата
form.addEventListener('submit', event => {
  event.preventDefault();

  ws.send(input.value);
  input.value = '';
});

// Обработка изменения цвета фона
const btn = document.getElementById('change-color-btn');

let colorIndex = 0;

btn.addEventListener('click', () => {
  const colors = ['rgb(44, 55, 160)', 'rgb(28, 36, 104)'];

  // Получение текущего цвета
  const color = colors[colorIndex];

  // Отправка цвета всем подключенным клиентам
  ws.send(color);

  // Увеличение счетчика цвета для переключения на следующий цвет
  colorIndex = (colorIndex + 1) % colors.length;
});


// Прослушивание событий WebSocket
ws.onopen = () => setStatus('ONLINE');

ws.onclose = () => setStatus('DISCONNECTED');

ws.onmessage = response => {
  const reader = new FileReader();

  // Слушатель события для чтения данных
  reader.onload = () => {
    const data = reader.result;

    // Проверка типа данных
    if (data.startsWith('rgb')) {
      // Изменение цвета фона для всех клиентов
      document.querySelectorAll('body').forEach(body => {
        body.style.backgroundColor = data;
      });
    } else {
      // Вывод сообщения чата
      printMessage(data);
    }
  };

  // Начало чтения данных
  reader.readAsText(response.data);
};

// Функция для загрузки содержимого слайда
function loadSlideContent(slideId) {
  // Загружаем содержимое слайда
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '/components/get_slide_content.php?id=' + slideId, true);
  xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              // Обновляем содержимое слайда
              document.getElementById('activeSlide').innerHTML = xhr.responseText;
              
              // Широковещательно рассылаем содержимое слайда всем клиентам
              broadcastSlideContent(slideId);
          } else {
              alert('Произошла ошибка при получении содержимого слайда.');
          }
      }
  };
  xhr.send();
}



// Функция для широковещательной рассылки содержимого слайда
function broadcastSlideContent(slideId) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../components/get_slide_content.php?id=' + slideId, true);
  xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              // Отправляем содержимое слайда всем клиентам через WebSocket
              ws.send(xhr.responseText);
          } else {
              alert('Произошла ошибка при получении содержимого слайда.');
          }
      }
  };
  xhr.send();
}

// Прослушивание событий WebSocket
ws.onmessage = response => {
  const reader = new FileReader();

  // Слушатель события для чтения данных
  reader.onload = () => {
      const data = reader.result;

      // Проверка типа данных
      if (data.startsWith('rgb')) {
          // Изменение цвета фона для всех клиентов
          document.querySelectorAll('body').forEach(body => {
              body.style.backgroundColor = data;
          });
      } else {
          // Обновление содержимого слайда
          document.getElementById('activeSlide').innerHTML = data;
      }
  };

  // Начало чтения данных
  reader.readAsText(response.data);
};

