<?php
if(isset($_GET['id'])) {
    $presentationId = $_GET['id'];

    include 'conn.php';

    $sql = "SELECT * FROM slides WHERE pr_id = $presentationId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='small-slide'><span style='color: white'>" . $row["id"] . "</span> <button  style='position:absolute; margin-top: 3.5%; margin-left: 7%; width: 2vw; i-index:999' class='presentation_pick_element_delete' onclick='deleteSlide(" . $row["id"] . ")'><img style='width: 2vh; height: 2vh' src='../img/delete.png'></button><div style='margin-top: -13.5%; transform: scale(1); font-size: 0.1vw; background-size: cover; background-position: center; pointer-events: none; width: 100%; height: 100%'>" . $row["slide_content"] . "</div></div>";







            // echo "<div class='small-slide'><span style='color: white'>" . $row["id"] . "</span> <button class='presentation_pick_element_delete' onclick='deleteSlide(" . $row["id"] . ")'><img style='width: 2vh; height: 2vh' src='../img/delete.png'></button></div>";
        }
    } else {
        echo "0 результатов";
    }
    $conn->close();
}
?>