<?php
// Подключение к базе данных
include "conn.php";

// Проверка, залогинен ли пользователь
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// Получение данных из формы
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Обновление данных пользователя в базе данных
$sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = ".$_SESSION['user']['id'];

if ($conn->query($sql) === TRUE) {
  // Успешное обновление
  $_SESSION['user']['name'] = $name;
  $_SESSION['user']['email'] = $email;
  $_SESSION['user']['phone'] = $phone;
  header("Location: ../user.php"); // Перенаправление на страницу профиля
} else {
  // Ошибка при обновлении
  echo "Ошибка при обновлении профиля: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
