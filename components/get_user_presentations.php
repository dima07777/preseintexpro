<?php 
    include 'conn.php'; 

    session_start();
    if(isset($_SESSION['user'])){
        $userId = $_SESSION['user']['id']; 

        $sql = "SELECT id, name FROM presentations WHERE user_id = $userId"; 
        $result = $conn->query($sql); 

        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) { 



            echo"
            <div class='presentation'>
            <div class='wrapper_presentation_main'>
                <form action=''>
                    <input type='checkbox' name='check' id=''>
                </form>
                <img style='border-radius: 10px' src='../img/bg3.png'>
                <div class='presentation_name'>
                    <p><a style='color: white' href='pages/presentation.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></p>
                    <div class='presentation_info'>
                        <img class='presentation_info_logo' src='../img/eye.png' >
                        <p class='presentation_info_name'>public</p>
                        <img class='presentation_info_logo' src='../img/folder.png' >
                        <p class='presentation_info_name'>9</p>
                        <img class='presentation_info_logo' src='../img/people.png' >
                        <p class='presentation_info_name'>1</p>
                    </div>
                </div>
            </div>
            <div class='wrapper_presentation_info'>
                <p>Дмитрий</p>
                <p>17.06.2024</p>
                <a href='pages/present_show.php?id=" . $row["id"] ."' class='hidden present_button'>► Просмотр</a>

                <button style='width:20px; border-radius:9px' onclick='deletepresentations(" . $row["id"] . ")'><img src='../img/delete.png'></button>
            </div>
        </div>

        ";

    

        }
    } else {
        echo "0 результатов";
    }
    }

    $conn->close();
    ?>
