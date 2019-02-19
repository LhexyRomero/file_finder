
<?php
    require "../controller/connection.php";
    $dir    = '../public/files';

    $key = array('Filename','File');
    $values = array();
    $response = array();

    if(!empty($_POST)){
        $username = $_POST['user_name'];
        $clientname = $_POST['client_name'];
        $startdate = $_POST['start_date'];
        $enddate = $_POST['end_date'];

        $sql = "SELECT * FROM files_t WHERE client_name = '$clientname' AND user_name = '$username' AND date_uploaded BETWEEN '$startdate' AND '$enddate' AND file_exists IS NULL";
        $query = $connect->query($sql);

        if(mysqli_num_rows($query) > 0) {
            $ctr = 0;
            while($row = mysqli_fetch_array($query)) {
                $files = scandir($dir);
                if(in_array($row['file_name'],$files)){
                    
                    $date_uploaded = date("F d Y H:i:s.", strtotime($row['date_uploaded']));
                    $file_date =  date("F d Y H:i:s.", filemtime($files[$ctr]));
                    
                    if($date_uploaded = $file_date){
                        $sql_update = "UPDATE files_t SET file_exists = 'yes' WHERE id = ".$row['id']."";
                        $query_update = $connect->query($sql_update);
                        
                        $values = array($row['file_name'],'yes');
                        $response[] = array_combine($key, $values);
                    }
                }
                else {
                    
                    $values = array($row['file_name'],'no');
                    $response[] = array_combine($key, $values);
                }
                $ctr++;
            }
        }
        echo json_encode($response);
    }
?>