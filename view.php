<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="allcss/view.css?v=<?php echo time();?>" >
    <title>Order Details</title>
    <style>
        .order-details{
            background-color:#f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Order Details</h1>
            <div>
            <a href="5)orderlist.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="order-details p-5 my-4">
            <?php
            if (isset($_GET["id"])) {
                $id = $_GET['id'];
                include("database.php");
                $sql = "SELECT * FROM ordertable WHERE OrderId = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result)
            ?>
            
            <div class="row">
                <h5>Customer Name:</h5>
                <p><?php echo $row["CustomerName"]; ?></p>
            </div>
            <div class="row">
                <h5>Mobile:</h5>
                <p><?php echo $row["Mobile"]; ?></p>
            </div>
            <div class="row">
                <h5>Delivery Date:</h5>
                <p><?php echo $row["DeliveryDate"]; ?></p>
            </div>
            <div class="row">
                <h5>Product Name:</h5>
                <p><?php echo $row["Product"]; ?></p>
            </div>
            <div class="row">
                <h5>Quantity:</h5>
                <p><?php echo $row["Quantity"]; ?> KG</p>
            </div>
            <!-- <div class="row">
                <h5>Count:</h5>
                <p><?php echo $row["Count"]; ?></p>
            </div> -->
            <div class="row">
                <h5>Cost:</h5>
                <p>Rs <?php echo $row["Cost"]; ?></p>
            </div>
            <div class="row">
                <h5>Address:</h5>
                <p><?php echo $row["Address"]; ?></p>
            </div>
            
            <?php
            }
            else{
                echo "<h3>No order found</h3>";
            }
            ?>
            
        </div>
    </div>
</body>
</html>