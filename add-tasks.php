<?php
include_once('config.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Get data from the REST client
        $task = isset($_POST['task']) ? mysqli_real_escape_string($conn, $_POST['task']) : "";
        $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : "";
        $priority = isset($_POST['priority']) ? mysqli_real_escape_string($conn, $_POST['priority']) : "";
        // Insert data into database
        $sql = "INSERT INTO `Tasks`.`tasks` (`task`, `date`, `priority`) VALUES ('$task', '$date', '$priority');";
        $post_data_query = mysqli_query($conn, $sql);
        if($post_data_query){
                $json = array("status" => 1, "Success" => "Task has been added successfully!");
        }
        else{
                $json = array("status" => 0, "Error" => "Error adding Task! Please try again!");
        }
}
else{
        $json = array("status" => 0, "Info" => "Request method not accepted!");
}
@mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);
