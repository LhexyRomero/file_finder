<?php

session_start();
if(isset($_SESSION["client_id"])) {
}
else {
    header('Location:../index.php');
}
?>

<html>
    <head>
        <title>FILE FINDER</title>
        <link rel="stylesheet" href="../public/css/style.css">
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
        <link rel="stylesheet" href="../public/css/chosen.min.css">
        <script src="../public/js/bootstrap.min.js"></script>
        <script src="../public/js/jquery-3.3.1.min.js"></script>
        <script src="../public/js/moment.min.js"></script>
        <script src="../public/js/chosen.jquery.min.js"></script>
        <script src="../public/js/notify.min.js"></script>
    </head>

    <body>
        <div class="container">
        <nav><br>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="./search_folder.php" class="nav-item nav-link active" id="nav-folder-tab">Search From Folder</a>
                <a href="./search_database.php" class="nav-item nav-link" id="nav-database-tab">Search From Database</a>
           </div>
        </nav>
            <div class="row">
                <div class="col-md-6">
                    <h4 style="margin-top:30px;">Filter By</h4><br>
                    <div class="form-group">
                        <label>File location</label>
                        <input id="directory" type="input" class="form-control">
                        <p class="example">Example: Ex: \Users\lhexy\Desktop\Folder</p>
                    </div>
                    <div class="form-group">
                        <label>File Name</label>
                        <input id="filename" type="input" class="form-control">
                    </div>
                    <br/>
                    <center>
                        <button type="button" onclick="search(event)" class="btn btn-success">Search</button>
                        <button type="button" class="btn btn-secondary">Clear</button>
                    </center>
                </div>
            </div>
        </div>

    </body>

    <script>

        function search(e){
            e.preventDefault();
            var directory = $("#directory").val();
            var filename = $("#filename").val();

            $.ajax({
                method: "POST",
                url: "../model/search_folder.php",
                data:  "directory="+directory + "&filename=" + filename,
                success: (data)=>{
                    if(data == '0'){
                        $.notify("File Exists!", "success");
                    }else if (data == '1'){
                        $.notify("File doesn't Exists!", "success");
                    }else if (data == '2'){
                        $.notify("Specified Folder is Empty!", "success");
                    }else {
                        $.notify("The system cannot find the directory specified!", "danger");
                    }
                }
            });
        }
    </script>
</html>


