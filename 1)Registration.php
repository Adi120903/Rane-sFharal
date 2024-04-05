<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="allcss/loginReg.css?v=<?php echo time();?>">
    <style>
       
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $adminName = $_POST["adminname"];
            $adminId = $_POST["adminid"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();
           
           if (empty($adminName) OR empty($adminId) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           
           require_once "database.php";
           $sql = "SELECT * FROM admin WHERE Admin_Id = '$adminId'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Admin Id already exists!");
           }

           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }
           else {
            
            $sql = "INSERT INTO admin (Admin_Id, AdminName, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$adminId, $adminName, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }
            else{
                die("Something went wrong");
            }
           }
        }
        ?>
        <div id="form1">
            <form action="1)Registration.php" method="post">
                <h1>Rane's Fharal</h1>
                <div class="input-fields">
                    <input type="text"  name="adminname" placeholder="Admin Name">
                </div>
                <div class="input-fields">
                    <input type="text" name="adminid" placeholder="Admin Id">
                </div>
                <div class="input-fields">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="input-fields">
                    <input type="password" name="repeat_password" placeholder="Confirm Password">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn-login" value="Register" name="submit">
                </div>
            </form>
            
            <div>
                <p style=" font-weight: bold;" >Already Registered <a href="2)login.php">Login Here</a></p>
            </div>

        </div>
        
      
    </div>
</body>
</html>