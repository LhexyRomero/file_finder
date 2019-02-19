<?php
require "../controller/connection.php";

$type = $_POST['type'];

if($type == 'client'){
    $sql = "SELECT DISTINCT client_id as id, client_name as name FROM files_t";
} else {
    $sql = "SELECT DISTINCT user_id as id, user_name as name FROM files_t";
}

$query = $connect->query($sql);

$options = "";
    while($row = mysqli_fetch_array($query)){
        $options .= "<option value=".$row['id'].">".$row['name']."</option>";
    }

    echo $options;
?>