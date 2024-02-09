document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('mainForm');
    var subForm = document.getElementById('subForm');

    form.addEventListener('change', function () {
        var selectedOption = document.querySelector('input[name="uni"]:checked').value;

      
        document.getElementById('content1').style.display = 'none';
        document.getElementById('content2').style.display = 'none';

       
        document.getElementById('content' + selectedOption).style.display = 'block';

        
        subForm.reset();
        
    });
});