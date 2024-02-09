<?php
include 'conn.php';

$slideContent = $_POST['content'];
$activeSlideId = $_POST['id'];

$sql = "UPDATE slides SET slide_content = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $slideContent, $activeSlideId);

if ($stmt->execute()) {
  echo "Содержимое активного слайда успешно обновлено в базе данных";
} else {
  echo "Ошибка: " . $sql . "<br>" . $stmt->error;
}

$conn->close();
