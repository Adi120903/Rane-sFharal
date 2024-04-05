<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="allcss/edit.css?v=<?php echo time();?>">
    <title>Edit Order</title>
    <style>
        
    </style>
</head>
<body>  
<div class="container my-5">
    <header class="d-flex justify-content-between my-4">
        <h1>Edit Order</h1>
        <div>
            <a href="5)orderlist.php" class="btn btn-primary">Back</a>
        </div>
    </header>
    <?php
    if(isset($_GET["id"])){
        $id = $_GET['id'];
        include("database.php");
        $sql = "SELECT * FROM ordertable WHERE OrderId = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
    ?>  
    <form  action="process.php" method="post">
        <div class="form-elemnt ">
            <label class='blocks' for="CustomerName">Customer Name:</label>
            <input class='inputs' type="text" id ="CustomerName" name="Cname" value="<?php echo $row["CustomerName"]; ?>">
        </div>
        <div class="form-elemnt ">
            <label class='blocks' for="Mobile">Mobile:</label>
            <input class='inputs' type="text" id="Mobile" name="mobile" value="<?php echo $row["Mobile"]; ?>">
        </div>
        <div class="form-elemnt">
            <label class='blocks' for="date">Delivery Date:</label>
            <input class='inputs' type="date" id="date" name="deliverydate" value="<?php echo $row["DeliveryDate"]; ?>">
        </div>
        <div class="form-elemnt">
            <label class='blocks' for="productname">Product Name:</label>
            <select class='inputs' name="productname" id="productname">
                <option selected><?php echo $row["Product"]; ?></option>
                <option value="Chakali">Chakali</option>
                <option value="Laddoo">Laddoo</option>
                <option value="Shankar paalye">Shankar paalye</option>
                <option value="Chewda">Chewda</option>
                <option value="Karanji">Karanji</option>
            </select>
        </div>
        
        <div class="form-elemnt">
            <label class='blocks' for="Quantity">Quantity:</label>
            <input class='inputs' placeholder="in KILOGRAM" type="number" id="Quantity" name="Quantity" value="<?php echo $row["Quantity"];?>" step="0.01">
            <span style="display:block;">(This is in Kilogram)</span>
        </div>
        <!-- <div class="form-elemnt">
            <label class='blocks' for="Count">Count:</label>
            <input class='inputs' type="number" id="Count" name="Count" value="<?php echo $row["Count"]; ?>" >
        </div> -->
        <div class="form-elemnt">
            <label class='blocks' for="Cost">Cost:</label>
            <input class='inputs' type="text" id="Cost" name="Cost" value="<?php echo $row["Cost"]; ?>">
        </div>
        <div class="form-elemnt">
            <label class='blocks' for="Address">Address:</label>
            <input class='inputs' type="text" id="Address" name="Address" value="<?php echo $row["Address"]; ?>">  
        </div>
        
        <input type="hidden" value="<?php echo $id; ?>" name="id">
        <div class="form-elemnt my-4">
            <input type="submit" class="btn btn-primary" value="Edit" name="edit">
        </div>
    </form>
    <?php  
    }
    ?>

</div>
</div>
 
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add event listener to the Quantity input
        document.getElementById("Quantity").addEventListener("input", function () {
            calculateCost();
        });

        // Add event listener to the productname select
        document.getElementById("productname").addEventListener("change", function () {
            calculateCost();
        });

        // Function to calculate the cost based on quantity and product
        function calculateCost() {
            var quantity = parseFloat(document.getElementById("Quantity").value) || 0;
            var product = document.getElementById("productname").value;

            // Define cost per kg for each product
            var costPerKg = {
                "Chakali": 150,
                "Laddoo": 200,
                "Shankar paalye": 240,
                "Chewda": 120,
                "Karanji": 180
                // Add more products if needed
            };

            // Calculate the cost
            var cost = quantity * (costPerKg[product] || 0);

            // Display the calculated cost in the Cost input
            document.getElementById("Cost").value = cost.toFixed(2);
        }
    });
</script>

</body>
</html>