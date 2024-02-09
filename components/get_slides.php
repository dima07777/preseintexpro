<?php
if(isset($_GET['id'])) {
    $presentationId = $_GET['id'];

    include 'conn.php';

    $sql = "SELECT * FROM slides WHERE pr_id = $presentationId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // echo "<div class='small-slide'>
            // <button class='presentation_pick_element_delete' style='position:absolute; top:-10%; z-index:1000000;' onclick='deleteSlide(" . $row["id"] . ")'><img style='width: 2vh; height: 2vh' src='../img/delete.png'></button>
            // <span style='color: white; display: none; margin: 0;'>" . $row["id"] . "</span>
            // <div style='transform: scale(1);z-index:-2;'>" . $row["slide_content"] . "</div>
            //   </div>";
            echo "<div class='small-slide'><span style='color: white'>" . $row["id"] . "</span> <button class='presentation_pick_element_delete' onclick='deleteSlide(" . $row["id"] . ")'><img style='width: 2vh; height: 2vh' src='../img/delete.png'></button></div>";
        }
    } else {
        echo "0 результатов";
    }
    $conn->close();
}
?>