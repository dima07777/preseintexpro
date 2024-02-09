<?php
include 'conn.php';
$presentationId = $_POST['pr_id'];

$sql = "INSERT INTO slides (slide_content, pr_id) VALUES (NULL, $presentationId)";

if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}
$conn->close();
?>
