<?php
    require "../controller/connection.php";
    $dir = $_POST['directory'];
    $filename = $_POST['filename'];
    
    $files = scandir($dir);

    if($files){
        if(!empty($files)){
            if(in_array($filename,$files)){
                echo "0"; //File Exists
            }
            else {
                echo "1"; //File Deosn't Exists
            }
        }
        else {
            echo "2"; //Specified folder is empty
        }
    }
    else {
        echo "3"; //The system cannot find the directory specified
    }
?>