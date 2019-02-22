
<?php
    require "../controller/connection.php";
    $dir    = '../public/files';
    $key = array('Filename','File');
    $values = array();
    $response = array();
    $files = array();
    $clients = explode(",", $_POST['clients']);
    $users = explode(",", $_POST['users']);
    $q_c = "";
    $q_u = "";


    if(!empty($_POST)){
        $startdate = $_POST['start_date'];
        $enddate = $_POST['end_date'];

        $sql = "SELECT * FROM files_t WHERE date_uploaded BETWEEN '$startdate' AND '$enddate' AND file_exists IS NULL";
        
        for ($i = 0; $i < count($clients); $i++) {
            $q_c .="client_name = '$clients[$i]' OR ";
        }
    
        for ($j = 0; $j < count($users); $j++) {
            $q_u .="user_name = '$users[$j]' OR ";
        }
        $q_us = substr_replace($q_u, "", -3);
        $q_cs = substr_replace($q_c, "", -3);
        $sql .= " AND(".$q_cs.") AND (".$q_us.")";
        
        $query = $connect->query($sql);

        if(mysqli_num_rows($query) > 0) {
            
            while($row = mysqli_fetch_array($query)) {
                $files = scandir($dir);
                if(in_array($row['file_name'],$files)){

                    $sql_update = "UPDATE files_t SET file_exists = 'yes' WHERE id = ".$row['id']."";
                    $query_update = $connect->query($sql_update);
                    
                    $values = array($row['file_name'],'yes');
                    $response[] = array_combine($key, $values);
                }
                else {
                    
                    $values = array($row['file_name'],'no');
                    $response[] = array_combine($key, $values);
                }
            }
        }
        echo json_encode(@$response);
    }
?>