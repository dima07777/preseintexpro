var questionCounter = 1;

function submitQuestion() {
  var questionInput = document.getElementById('question-input');
  var question = questionInput.value;
  if (question.trim() !== '') {
    var newQuestionBlock = document.createElement('div');
    newQuestionBlock.textContent = question;
    newQuestionBlock.id = 'question-' + questionCounter;
    newQuestionBlock.classList.add('question-item');
    var markAsAnsweredButton = document.createElement('button');
    markAsAnsweredButton.textContent = 'Пометить как отвеченный';
    markAsAnsweredButton.id = 'markAsAnsweredButton';
    document.body.appendChild(markAsAnsweredButton);    
    markAsAnsweredButton.onclick = function() {
      markAsAnswered(newQuestionBlock.id);
    };
    newQuestionBlock.appendChild(markAsAnsweredButton);
    document.getElementById('new-questions').appendChild(newQuestionBlock);
    questionCounter++;
    questionInput.value = ''; 
    questionInput.style.height = 'auto'; 
    questionInput.style.height = (questionInput.scrollHeight) + 'px'; 
  }
}

function markAsAnswered(questionId) {
  var question = document.getElementById(questionId);
  var answeredQuestionsBlock = document.getElementById('answered-questions');
  answeredQuestionsBlock.appendChild(question);
  var markAsAnsweredButton = question.querySelector('button');
  markAsAnsweredButton.remove();
  question.style.height = 'auto'; 
}

function autoResize(input) {
    input.style.height = 'auto';
    input.style.height = (input.scrollHeight) + 'px'; 
  }

  document.getElementById("scrollSlider").addEventListener("input", function() {
    var box = document.getElementById("new-questions");
    box.scrollTop = box.scrollHeight * (this.value / this.max);
});