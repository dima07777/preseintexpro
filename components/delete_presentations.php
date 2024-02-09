<?php  
if(isset($_GET['id'])) {  
    $presentationsId = $_GET['id'];  
    
    include 'conn.php';  
    
    $sql = "DELETE FROM presentations WHERE id = $presentationsId";  
    if ($conn->query($sql) === TRUE) {  
        echo "Презентация успешно удалена";  
        
        echo '<script>window.location.reload(true);</script>';
        echo "<script>window.location.replace('../index.php');</script>";
    } else {  
        echo "Ошибка при удалении слайда: " . $conn->error;  
    }  
    
    $conn->close();  
}  
?>
