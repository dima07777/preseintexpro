<?php
include 'conn.php';
$slideContent = $_POST['slideContent'];

$sql = "INSERT INTO slides (slide_content) VALUES ('$slideContent')";

if ($conn->query($sql) === TRUE) {
  echo "Содержимое слайда успешно сохранено в базу данных";
} else {
  echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>