<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: 2)login.php");
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
    <title>OrderList</title>
    <style>
        
        #right{
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
            <li style="border-top: 1px solid whitesmoke;"><a href="3)Dashboard.php"><i class="fa-solid fa-gears"></i>Add Orders</a></li>
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
        <h1>Order List</h1>
    </header>
    
    <?php
        
    if (isset($_SESSION["update"])) {
    ?>
    <div class="alert alert-success">
        <?php 
        echo $_SESSION["update"];
        ?>
    </div>
    <?php
    unset($_SESSION["update"]);
    }
    ?>
    <?php
    if (isset($_SESSION["delete"])) {
    ?>
    <div class="alert alert-success">
        <?php 
        echo $_SESSION["delete"];
        ?>
    </div>
    <?php
    unset($_SESSION["delete"]);
    }
    ?>
    <table class="table table-bordered" id="dataTableId">
        <thead>
            <tr>
                <th>Sr no.</td>
                <th>Customer Name</th>
                <th>Product</th>
                <th>Delivery Date</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                <?php
                include('database.php');
                $sqlSelect = "SELECT * FROM ordertable";
                $result = mysqli_query($conn,$sqlSelect);
                $no = 1;
                while($data = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['CustomerName']; ?></td>
                    <td><?php echo $data['Product']; ?></td>
                    <td><?php echo $data['DeliveryDate']; ?></td>
                        
                    <td>
                        <a href="view.php?id=<?php echo $data['OrderId']; ?>" class="btn btn-info">View</a>
                        <a href="edit.php?id=<?php echo $data['OrderId']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $data['OrderId']; ?>" class="btn btn-danger">Delete</a>
                        <a href="6)completed.php?id=<?php echo $data['OrderId']; ?>" class="btn btn-success">Finish</a>
                            
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