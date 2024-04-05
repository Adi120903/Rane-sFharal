<?php
include('database.php');
if (isset($_POST["create"])) {

    $CustomerName = $_POST["Cname"];
    $Mobile = $_POST["mobile"];
    $Deliverydate = $_POST["deliverydate"];
    $ProductName = $_POST["productname"];
    $Quantity= $_POST["Quantity"];
    $Cost = $_POST["Cost"];
    $Address =$_POST["Address"];
    
    if (empty($CustomerName) OR empty($Mobile) OR empty($Deliverydate) OR empty($Quantity) OR empty($Cost) OR empty($Address)) 
    {
        session_start();
        $_SESSION["fields"] = "All fields are manditory";
        header("Location: 3)Dashboard.php");
    }
    
    else {
        if (strlen($Mobile)!=10) {
            session_start();
            $_SESSION["mobile"] = "Mobile number must be 10 digits long!";
            header("Location:3)Dashboard.php");
        }
        else{
            require_once "database.php";
            $sqlInsert  = "INSERT INTO ordertable(CustomerName, Mobile, DeliveryDate, Product, Quantity, Count, Cost, Address) VALUES ('$CustomerName','$Mobile','$Deliverydate', '$ProductName', '$Quantity', '$Count', '$Cost', '$Address')";
            if(mysqli_query($conn,$sqlInsert)){
                session_start();
                $_SESSION["create"] = "Order Added Successfully!";
                header("Location: 3)Dashboard.php");
            }
            else{
                die("Something went wrong");
            }
        }
    }
    


    
    
}

if (isset($_POST["edit"])) {
    
    $CustomerName = $_POST["Cname"];
    $Mobile = $_POST["mobile"];
    $Deliverydate = $_POST["deliverydate"];
    $ProductName = $_POST["productname"];
    $Quantity= $_POST["Quantity"];
    $Cost = $_POST["Cost"];
    $Address =$_POST["Address"];

    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    $sqlUpdate = "UPDATE ordertable SET CustomerName = '$CustomerName', Mobile = '$Mobile', DeliveryDate = '$Deliverydate', Product='$ProductName' ,Quantity = '$Quantity', Cost = '$Cost', Address='$Address'  WHERE OrderId='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Order Updated Successfully!";
        header("Location:5)orderlist.php");
    }else{
        die("Something went wrong");
    }
}

