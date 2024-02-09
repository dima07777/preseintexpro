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
            <div class='func'>
            <img class='function_logo'style='border-radius: 10px' src='../img/bg3.png'>
            <p class='function_name'><a style='color: white' href='pages/presentation.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></p>
        </div>
            ";




        }
    } else {
        echo "0 результатов";
    }
    }

    $conn->close();
    ?>
