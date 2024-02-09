    var ideaCounter = 0; 

    function addIdeaBlock(ideaText) {
    var newIdeaBlock = document.createElement('div');
    newIdeaBlock.textContent = ideaText;
    newIdeaBlock.id = 'idea-' + ideaCounter;
    newIdeaBlock.classList.add('idea-item');

    var likeButton = document.createElement('button'); 
    likeButton.textContent = '♥'; 
    likeButton.classList.add('like-button');
    likeButton.style.transform = 'scale(0.7)';  
    likeButton.onclick = function() { likeIdea(this.parentElement.id); }; 
    var likeCountSpan = document.createElement('span');
    likeCountSpan.id = 'like-count-' + ideaCounter;
    likeCountSpan.textContent = '0';
    likeButton.appendChild(likeCountSpan);

    newIdeaBlock.appendChild(likeButton);

    document.getElementById('new-ideas').appendChild(newIdeaBlock);
    ideaCounter++;
    }

    function submitIdea() {
    var ideaInput = document.getElementById('question-input');
    var idea = ideaInput.value;
    if (idea.trim() !== '') {
        addIdeaBlock(idea);
        ideaInput.value = '';
        ideaInput.style.height = 'auto';
        ideaInput.style.height = (ideaInput.scrollHeight) + 'px';
    }
    }

    function likeIdea(ideaId) {
    var ideaNumber = parseInt(ideaId.split('-')[1]); 
    var likeCountSpan = document.getElementById('like-count-' + ideaNumber);
    if (likeCountSpan !== null) {
        var currentCount = parseInt(likeCountSpan.textContent);
        likeCountSpan.textContent = currentCount + 1;
    } else {
        console.error('Элемент likeCountSpan для идеи с номером ' + ideaNumber + ' не найден');
    }
    }

    function addIdeaBlock(ideaText) { 
        var newIdeaBlock = document.createElement('div'); 
        newIdeaBlock.textContent = ideaText; 
        newIdeaBlock.id = 'idea-' + ideaCounter; 
        newIdeaBlock.classList.add('idea-item'); 
    
        var likeButton = document.createElement('button');  
        likeButton.textContent = '♥';  
        likeButton.classList.add('like-button'); 
        likeButton.style.transform = 'scale(0.7)';   
        likeButton.onclick = function() { likeIdea(this.parentElement.id); }; 
        var likeCountSpan = document.createElement('span'); 
        likeCountSpan.id = 'like-count-' + ideaCounter; 
        likeCountSpan.textContent = '0'; 
        likeButton.appendChild(likeCountSpan); 
    
        newIdeaBlock.appendChild(likeButton);
    
        var ideasContainer = document.getElementById('new-ideas');
        if (ideasContainer.childElementCount > 0) {
            var ideaBlocks = ideasContainer.getElementsByClassName('idea-item');
            var currentLikes = parseInt(likeCountSpan.textContent);
            for (var i = 0; i < ideaBlocks.length; i++) {
                var likeCount = parseInt(ideaBlocks[i].querySelector('.like-button span').textContent);
                if (currentLikes > likeCount) {
                    ideasContainer.insertBefore(newIdeaBlock, ideaBlocks[i]);
                    return;
                }
            }
        }
        
        ideasContainer.appendChild(newIdeaBlock); 
        ideaCounter++;
    }
    
