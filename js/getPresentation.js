    document.getElementById('addPresentationButton').addEventListener('click', function() {
        var presentationName = prompt('Введите название презентации:');
        if (presentationName) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'components/add_presentation.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        loadUserPresentations(); 
                        loadUserPresentations1(); 
                    } else {
                        alert('Произошла ошибка при добавлении презентации в базу данных.');
                    }
                }
            };
            xhr.send('name=' + presentationName);
        }
    });

    function loadUserPresentations1() { 
        var xhr = new XMLHttpRequest(); 
        xhr.open('GET', 'components/get_user_presentations1.php', true); 
        xhr.onreadystatechange = function() { 
            if (xhr.readyState === XMLHttpRequest.DONE) { 
                if (xhr.status === 200) { 
                    document.getElementById('presentationsList1').innerHTML = xhr.responseText; 
                } else { 
                   
                } 
            } 
        }; 
        xhr.send(); 
    }
    

   
function loadUserPresentations() { 
    var xhr = new XMLHttpRequest(); 
    xhr.open('GET', 'components/get_user_presentations.php', true); 
    xhr.onreadystatechange = function() { 
        if (xhr.readyState === XMLHttpRequest.DONE) { 
            if (xhr.status === 200) { 
                document.getElementById('presentationsList').innerHTML = xhr.responseText; 
            } else { 
            
            } 
        } 
    }; 
    xhr.send(); 
}




   
    function deletepresentations(presentationsId) { 
        var xhr = new XMLHttpRequest(); 
        xhr.open('GET', '../components/delete_presentations.php?id=' + presentationsId, true); 
        xhr.onreadystatechange = function() { 
            if (xhr.readyState === XMLHttpRequest.DONE) { 
                if (xhr.status === 200) { 
                    window.location.reload(true); 
                } else { 
                    alert('Произошла ошибка при удалении слайда.'); 
                } 
            } 
        }; 
        xhr.send(); 
    } 
    
    
    


    
    document.addEventListener('DOMContentLoaded', loadUserPresentations);