<?php
if (isset($_GET['id'])) {
include("database.php");
$id = $_GET['id'];
$sql = "DELETE FROM completed_order WHERE Id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["COdelete"] = "Order Deleted Successfully!";
    header("Location:6)completed.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Order does not exist";
}
?>