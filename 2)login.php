<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: 3)Dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="allcss/loginReg.css?v=<?php echo time();?>">
    <style>
        
    </style>
</head>
<body>
    
    <div class="container">
        <?php
        $login = false;
        if(isset($_POST["login"])) {
            $adminId = $_POST["adminid"];
            $password = $_POST["password"];
            

            require_once "database.php";
            // $sql = "Select * from admin where Admin_Id='$adminId' AND password='$password'";
            $sql = "Select * from admin where Admin_Id='$adminId'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1){
                while($row=mysqli_fetch_assoc($result)){
                    if (password_verify($password, $row['Password'])){ 
                        $login = true;
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("location: 3)Dashboard.php");
                        die();
                    } 
                    else{
                        echo "<div class='alert alert-danger'>Invalid Credentials</div>";
                    }
                }
                
            }
            else{
                echo "<div class='alert alert-danger'>Invalid Credentials</div>";
            }
            
           

        }
        ?>
        <div id="form1">
            <form action="2)login.php" method="post">
                <h1>Rane's Fharal</h1>
                <div class="input-fields">
                    <input type="text" placeholder="Enter Admin Id" name="adminid" >
                </div>
                <div class="input-fields">
                    <input type="password" placeholder="Enter Password" name="password" >
                </div>
                <div class="form-btn">
                    <input type="submit" value="Login" name="login" class="btn-login">
                </div>
            </form>
            <div>
                <p style="font-weight: bold;">Not registered yet <a href="1)Registration.php">Register Here</a></p>
            </div>  
        </div>
        
    </div>
    
</body>
</html>