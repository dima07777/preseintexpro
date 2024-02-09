 function loadUserPresentationsFunc() { 
        var xhr = new XMLHttpRequest(); 
        xhr.open('GET', 'components/get_user_presentationsFunc.php', true); 
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
    
    
    


    
    document.addEventListener('DOMContentLoaded', loadUserPresentationsFunc);