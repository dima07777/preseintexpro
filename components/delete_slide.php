<?php
if(isset($_GET['id'])) {
    $slideId = $_GET['id'];

    include 'conn.php';
    
    $sql = "DELETE FROM slides WHERE id = $slideId";
    if ($conn->query($sql) === TRUE) {
        echo "Слайд успешно удален";
    } else {
        echo "Ошибка при удалении слайда: " . $conn->error;
    }

    $conn->close();
}
?>
