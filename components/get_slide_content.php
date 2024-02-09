<?php
if(isset($_GET['id'])) {
    $slideId = $_GET['id'];

    include 'conn.php';
    $sql = "SELECT slide_content FROM slides WHERE id = $slideId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row["slide_content"];
    } else {
        echo "Ошибка: слайд не найден";
    }

    $conn->close();
}
?>