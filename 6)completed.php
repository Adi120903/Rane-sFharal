<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<?php
include('database.php');
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    include("database.php");
    $sql = "SELECT * FROM ordertable WHERE OrderId = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    $OrderId = $row['OrderId'];
    $CustomerName = $row['CustomerName'];
    $Mobile = $row["Mobile"];
    $Deliverydate = $row["DeliveryDate"];
    $ProductName = $row["Product"];
    $Quantity= $row["Quantity"];
    $Count = $row["Count"];
    $Cost = $row["Cost"];
    $Address =$row["Address"];
    $TotalCost = $Quantity * $Cost;
    $sqlInsert  = "INSERT INTO completed_order(OrderId, CustomerName , Mobile , DeliveryDate, Product ,Quantity, Count, Cost, TotalCost, Address) VALUES ('$OrderId','$CustomerName','$Mobile','$Deliverydate', '$ProductName','$Quantity', '$Count', '$Cost', '$TotalCost', '$Address')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        
        header("Location:6)completed.php");
    }else{
        die("Something went wrong");
    }
    $sqldelete = "DELETE FROM ordertable WHERE OrderId='$id'";
    if(mysqli_query($conn,$sqldelete)){
        
        header("Location:5)orderlist.php");
    }else{
        die("Order not deleted form ordertable");
    }
 

}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/aae22e6166.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="allcss/dashboard.css?v=<?php echo time();?>">
    <title>Order</title>
    <style>
        
        #right{
            padding: 0.5rem;
            width: 75%;
            margin-left: 25%;
        }
    </style>
</head>
<body>
<div id="container">
<div id="left">
    <div id="title">
        <h1>Rane's Fharal</h1>
    </div>
    <div id="navlist">
        <ul>
            <li style="border-top: 1px solid whitesmoke;"><a href="3)dashboard.php"><i class="fa-solid fa-gears"></i>Add Orders</a></li>
            <li><a href="5)orderlist.php"><i class="fa-solid fa-list"></i>Orders list</a></li>
            <li><a href="6)completed.php"><i class="fa-solid fa-check"></i>Completed Orders</a></li>
            
        </ul>
    </div>
    <div class="logout">
        <a href="4)logout.php" class="btn btn-warning">Logout</a>
    </div>
</div>  
<div id="right">
<div class="container my-4">

    <header class="d-flex justify-content-between my-4">
        <h1>Completed Order List</h1>
    </header>
    <?php
    if (isset($_SESSION["COdelete"])) {
    ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["COdelete"];
            unset($_SESSION["COdelete"]);
        }
            ?>
        </div>
        <table class="table table-bordered" id="dataTableId">
            <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Product</th>
                    <th>Delivery Date</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                <?php
                    include('database.php');
                    $sqlSelect = "SELECT * FROM completed_order";
                    $result = mysqli_query($conn,$sqlSelect);
                    $no = 1;
                    while($data = mysqli_fetch_array($result)){
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['OrderId']; ?></td>
                        <td><?php echo $data['CustomerName']; ?></td>
                        <td><?php echo $data['Product']; ?></td>
                        <td><?php echo $data['DeliveryDate']; ?></td>
                        
                        <td>
                            <a href="bill.php?OrderId=<?php echo $data['OrderId']; ?>" class="btn btn-primary"><i class="fa-solid fa-receipt"></i>Bill</a>
                            <a href="COdelete.php?id=<?php echo $data['Id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>
                </tbody>
        </table>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready( function () {
    $('#dataTableId').DataTable();
  });
</script>

</body>
</html>