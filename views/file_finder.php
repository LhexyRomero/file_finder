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
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 style="margin-top:30px;">Filter By</h4><br>
                    <div class="form-group">
                        <label>Client Name</label><!-- 
                        <input id="client_name" type="text" class="form-control"> -->
                        <button onclick="addClient()" type="button" class="btn btn-primary btn-sm float-right">Add Client</button>
                        <form id="client"><div class="add_client"></div></form>
                    </div>
                    <div class="form-group">
                        <label>User Name</label><!-- 
                        <input id="user_name" type="text" class="form-control"> -->
                        <button onclick="addUser()" type="button" class="btn btn-primary btn-sm float-right">Add User</button>
                        <form id="user" method="POST"><div class="add_user"></div></form>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input id="start_date" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input id="end_date" type="date" class="form-control">
                    </div>
                    <br/>
                    <center>
                        <button type="button" onclick="search(event)" class="btn btn-success">Search</button>
                        <button type="button" class="btn btn-secondary">Clear</button>
                    </center>
                </div>
                <div class="col-md-6">
                    <div class="hide">
                        <h4 style="margin-top:30px;">Results</h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">File Name</th>
                                <th scope="col">FIle Exists?</th>
                                </tr>
                            </thead>
                            <tbody id="searchedFiles">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </body>

    <script>
        $(function(){
            $(".hide").hide();
            addClient();
            addUser();
        });

        
        var clients = [];
        var users = [];
        function search(e){
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();

            console.log(users);

            $.ajax({
                method: "POST",
                url: "../model/search_file.php",
                data: "start_date="+start_date + "&end_date="+end_date + "&users="+users + "&clients="+clients,
                success: (data)=>{
                    var response = JSON.parse(data);
                    $(".hide").show();
                    
                    let html = "";
                    response.forEach((element, index) => {
                        let row = "<tr>";
                        row += "<td>" + element.Filename + "</td>";
                        if (element.File === "yes") {
                            row += "<td class='table-success'>Yes</span>";
                        }
                        else {
                            row += "<td class='table-warning'>No</span>";
                        }
                        row += "</tr>";
                        html += row;
                    });
                    $('#searchedFiles').html(html);
                }
            });
        }

        var client_ctr = 0;
        var user_ctr = 0;
        var client_target = $(".add_client");
        var user_target = $(".add_user");

        function addClient(){
            $.ajax({
                method: "post",
                url: "../model/options.php",
                data: "type=client",
                success: (data)=>{
                    console.log(data);

                    var html = "<div class='multiple'><select id='user"+client_ctr+"' class='for-client form-control chosen-select'>"+data+"</select></div>";
                    client_target.append(html);
                    $(".chosen-select").chosen({width:"100%"}); 
                    
                    $('.for-client').on('change', (event)=>{
                        let value = $(event.target).val();
                        var text = $("#user"+client_ctr+" "+"option[value="+value+"]").text();
                        clients.push(text);
                    });
                }
            });
        }

        function addUser(){
            $.ajax({
                method: "post",
                url: "../model/options.php",
                data: "type=user",
                success: (data)=>{
                    console.log(data);

                    var html = "<div class='multiple'><select id='user"+user_ctr+"' class='for-user form-control chosen-select'>"+data+"</select></div>";
                    
                    user_target.append(html);
                    $(".chosen-select").chosen({width:"100%"}); 

                    $('.for-user').on('change', (event)=>{
                        var value = $(event.target).val();
                        var text = $("#user"+user_ctr+" "+"option[value="+value+"]").text();
                        users.push(text);
                    });
                    
                }
            });
            client_ctr++;
            /* if(client_ctr >= 9){
                alert("SOBRA NA");
                return;
            } */
        }


    </script>
</html>


