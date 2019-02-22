<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class="container center-block">
        <h4 style="margin-top:30px;">Login</h4>
        <form method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="User Name">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button name="submit_button" type="input" class="btn btn-success">Login</button>
        </form>
    </div>
</body>
</html>

<?php
    require_once "controller/connection.php";

    if(!empty($_POST)){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user_t WHERE name = '$username' AND pass = '$password'";
        $query = $connect->query($sql);

        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_array($query)) {
                session_start();

                $_SESSION["client_id"] = $row["id"];
                header('Location:views/search_database.php');
            }
        }
        else {
            echo "<script>alert('Incorrect username or password');</script>";
        }
    }
?>