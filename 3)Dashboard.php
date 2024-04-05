<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: 2)login.php");
}
// if (isset($_POST["create"])) {

//     $CustomerName = $_POST["Cname"];
//     $Mobile = $_POST["mobile"];
//     $Deliverydate = $_POST["deliverydate"];
//     $ProductName = $_POST["productname"];
//     $Quantity= $_POST["Quantity"];
//     $Cost = $_POST["Cost"];
//     $Address =$_POST["Address"];
    
//     if (empty($CustomerName) OR empty($Mobile) OR empty($Deliverydate) OR empty($Quantity) OR empty($Cost) OR empty($Address)) 
//     {
//         session_start();
//         $_SESSION["fields"] = "All fields are manditory";
//         header("Location: 3)Dashboard.php");
//     }
    
//     else {
//         if (strlen($Mobile)!=10) {
//             session_start();
//             $_SESSION["mobile"] = "Mobile number must be 10 digits long!";
//             header("Location:3)Dashboard.php");
//         }
//         else{
//             require_once "database.php";
//             $sqlInsert  = "INSERT INTO ordertable(CustomerName, Mobile, DeliveryDate, Product, Quantity, Count, Cost, Address) VALUES ('$CustomerName','$Mobile','$Deliverydate', '$ProductName', '$Quantity', '$Count', '$Cost', '$Address')";
//             if(mysqli_query($conn,$sqlInsert)){
//                 session_start();
//                 $_SESSION["create"] = "Order Added Successfully!";
//                 header("Location: 3)Dashboard.php");
//             }
//             else{
//                 die("Something went wrong");
//             }
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/aae22e6166.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="allcss/dashboard.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="allcss/generateorder.css?v=<?php echo time();?>">
    <title>User Dashboard</title>
    <style>
        
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
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Generate Order</h1>  
        </header>
        
        <?php
        
            if (isset($_SESSION["fields"])) {
        ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION["fields"];
                ?>
            </div>
        <?php
            unset($_SESSION["fields"]);
            }
            if (isset($_SESSION["mobile"])) {
        ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION["mobile"];
                ?>
            </div>
        <?php
            unset($_SESSION["mobile"]);
            }
            if (isset($_SESSION["create"])) {
        ?>
            <div class="alert alert-success">
            <?php 
                echo $_SESSION["create"];
            ?>
            </div>
            <?php
            unset($_SESSION["create"]);
            }
        ?>
        
        
        <form  action="process.php" method="post">

            <div class="form-elemnt ">
                <label class='blocks' for="CustomerName">Customer Name:</label>
                <input class='inputs' type="text" id = "CustomerName" name="Cname">
            </div>
            <div class="form-elemnt ">
                <label class='blocks' for="Mobile">Mobile:</label>
                <input class='inputs' type="text" id="Mobile" name="mobile" >
            </div>
            <div class="form-elemnt">
                <label class='blocks' for="date">Delivery Date:</label>
                <input class='inputs' type="date" id="date" name="deliverydate" >
                <script>
                    var todayDate = new Date();
                    var month = todayDate.getMonth() + 1;
                    var year = todayDate.getUTCFullYear() - 0;
                    var tdate = todayDate.getDate();
                    if (month < 10) {
                        month = "0" + month;
                    }
                    if (tdate < 10) {
                        tdate = "0" + tdate;
                    }
                    var maxDate = year + "-" + month + "-" + tdate;
                    document.getElementById("date").setAttribute("min", maxDate);
                </script>
            </div>
            <div class="form-elemnt">
                <label class='blocks' for="productname">Product Name:</label>
                <select class='inputs' placeholder="--Select--" name="productname" id="productname">
                    <option selected></option>
                    <option value="Chakali">Chakali</option>
                    <option value="Laddoo">Laddoo</option>
                    <option value="Shankar paalye">Shankar paalye</option>
                    <option value="Chewda">Chewda</option>
                    <option value="Karanji">Karanji</option>
                </select>
                <button  id="addFields" class="btn btn-primary">Add More Product</button>
            </div>
            <div class="form-elemnt">
                <label class='blocks' for="Quantity">Quantity:</label>
                <input class='inputs' placeholder="in Kilogram" type="number" id="Quantity" name="Quantity" step="0.01" value="1">
                <span style="display:block;">(This is in Kilogram)</span>

            </div>
            <!-- <div class="form-elemnt">
                <label class='blocks' for="Count">Count:</label>
                <input class='inputs' type="number" id="Count" name="Count" >
            </div> -->
            <div class="form-elemnt">
                <label class='blocks' for="Cost">Cost:</label>
                <input class='inputs' type="number" id="Cost" name="Cost" placeholder="Cost">
            </div>

            <div id="dynamicFieldsContainer" class="form-elemnt"></div>

            <div class="form-elemnt">
                <label class='blocks' for="Address">Address:</label>
                <input class='inputs' type="text" id="Address" name="Address">
                <input id="createbtn" type="submit" class="btn btn-primary blocks" value="Add order" name="create">
            </div>
            

        </form>
    </div>
</div>
</div>
 
<script>
    // Add duplicate inputs of Product, Quantity, Cost .......
    document.addEventListener("DOMContentLoaded", function () {
        var addButton = document.getElementById("addFields");
        var dynamicFieldsContainer = document.getElementById("dynamicFieldsContainer");

        addButton.addEventListener("click", function () {
            var existingSets = document.querySelectorAll(".dynamic-field-set").length;

            if (existingSets < 4) {
                var fieldSet = document.createElement("div");
                fieldSet.classList.add("dynamic-field-set");

                // Clone the original elements
                var clonedProduct = document.getElementById("productname").cloneNode(true);
                var clonedQuantity = document.getElementById("Quantity").cloneNode(true);
                var clonedCost = document.getElementById("Cost").cloneNode(true);
                

                // Modify the name attribute for the cloned elements
                var uniqueId = existingSets;
                clonedProduct.name = "newProduct_" + uniqueId;
                clonedQuantity.name = "newQuantity_" + uniqueId;
                clonedCost.name = "newCost_" + uniqueId;
                

                // Create a delete button for each set
                var deleteButton = document.createElement("button");
                deleteButton.textContent = "Delete";
                deleteButton.classList.add("btn", "btn-danger");
                deleteButton.addEventListener("click", function () {
                    dynamicFieldsContainer.removeChild(fieldSet);
                });

                // Append the cloned elements and delete button to the fieldSet
                fieldSet.appendChild(clonedProduct);
                fieldSet.appendChild(clonedQuantity);
                fieldSet.appendChild(clonedCost);
                fieldSet.appendChild(deleteButton);

                // Append the fieldSet to the container
                dynamicFieldsContainer.appendChild(fieldSet);
            } else {
                alert("You can only add up to 4 sets of fields.");
            }
        });
    });
    // document.addEventListener("DOMContentLoaded", function () {
    //     var addButton = document.getElementById("addInputSet");
    //     var dynamicInputSetsContainer = document.getElementById("dynamicInputSetsContainer");

    //     addButton.addEventListener("click", function () {
    //         // Check if the number of dynamic input sets is less than 4
    //         if (dynamicInputSetsContainer.childElementCount < 4) {
    //             // Create a container for the dynamic input set
    //             var inputSetContainer = document.createElement("div");
    //             inputSetContainer.classList.add("dynamic-input-set");

    //             // Create dynamic input fields
    //             var dynamicProduct = document.createElement("input");
    //             dynamicProduct.type = "text";
    //             dynamicProduct.name = "dynamicProduct[]";
    //             dynamicProduct.placeholder = "Product";

    //             var dynamicQuantity = document.createElement("input");
    //             dynamicQuantity.type = "number";
    //             dynamicQuantity.name = "dynamicQuantity[]";
    //             dynamicQuantity.placeholder = "Quantity";

    //             var dynamicCost = document.createElement("input");
    //             dynamicCost.type = "number";
    //             dynamicCost.name = "dynamicCost[]";
    //             dynamicCost.placeholder = "Cost";

    //             var dynamicAddress = document.createElement("input");
    //             dynamicAddress.type = "text";
    //             dynamicAddress.name = "dynamicAddress[]";
    //             dynamicAddress.placeholder = "Address";

    //             // Create a delete button for the input set
    //             var deleteButton = document.createElement("button");
    //             deleteButton.textContent = "Delete";
    //             deleteButton.classList.add("btn", "btn-danger");
    //             deleteButton.addEventListener("click", function () {
    //                 dynamicInputSetsContainer.removeChild(inputSetContainer);
    //             });

    //             // Append dynamic fields and delete button to the container
    //             inputSetContainer.appendChild(dynamicProduct);
    //             inputSetContainer.appendChild(dynamicQuantity);
    //             inputSetContainer.appendChild(dynamicCost);
    //             inputSetContainer.appendChild(dynamicAddress);
    //             inputSetContainer.appendChild(deleteButton);

    //             // Append the container to the dynamicInputSetsContainer
    //             dynamicInputSetsContainer.appendChild(inputSetContainer);
    //         } else {
    //             alert("You can only add up to 4 dynamic input sets.");
    //         }
    //     });
    // });

    // Automation for Cost of Product
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