<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="allcss/bill.css?v=<?php echo time();?>">
    </head>
    <body>

        <div class = "invoice-wrapper" id = "print-area">
            <div class = "invoice">
                <div class = "invoice-container">
                    <div class = "invoice-head">
                        <div class = "invoice-head-top">
                            <div class = "invoice-head-top-left text-start">
                                <h2>Rane's Fharal</h2>
                            </div>
                            <div class = "invoice-head-top-right text-end">
                                <h3>Invoice</h3>
                            </div>
                        </div>
                        <?php
                        if(isset($_GET["OrderId"])) {
                            $id = $_GET['OrderId'];  
                            $output = '';  
                            include('database.php');  
                            $sql = "SELECT * FROM completed_order WHERE OrderId = $id";  
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result)
                        ?>


                        <div class = "hr"></div>
                        <div class = "invoice-head-middle">
                            <div class = "invoice-head-middle-left text-start">
                                <p class="text-bold">Date: <span id='dateDisplay'></span></p>
                                <script>
                                    var currentDate = new Date();
                                    document.getElementById("dateDisplay").innerHTML = currentDate.toDateString();
                                </script>
                            </div>
                            <div class = "invoice-head-middle-right text-end">
                                <p><spanf class = "text-bold">Invoice No:</span><?php echo $row["OrderId"]; ?></p>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                                <ul>
                                    <li class = 'text-bold'>Shop Address:</li>
                                    <li>Shop No.7</li>
                                    <li>Sita Sadan, Kokan Nagar,</li>
                                    <li>Bhandup(west)</li>
                                    <li>Mumbai:-400078.</li>
                                </ul>
                            </div>
                            <div class = "invoice-head-bottom-right">
                                <ul class = "text-end">
                                    <li class = 'text-bold'>Customer Name:</li>
                                    <li><?php echo $row["CustomerName"]; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class = "overflow-view">
                        <div class = "invoice-body">
                            <table>
                                <thead>
                                    <tr>
                                        <td class = "text-bold">Order Id</td>
                                        <td class = "text-bold">Product</td>
                                        <td class = "text-bold">QTY</td>
                                        <td class = "text-bold">Cost</td>
                                        <!-- <td class = "text-bold">Total</td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row["OrderId"]; ?></td>
                                        <td><?php echo $row["Product"]; ?></td>
                                        <td><?php echo $row["Quantity"]; ?> kg</td>
                                        <td>Rs <?php echo $row["Cost"]; ?></td>
                                        <!-- <td class = "text-end"><?php echo $row["TotalCost"]; ?></td> -->
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                            
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class = "invoice-foot text-center">
                        <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt and does not require physical signature.</p>

                        <div class = "invoice-btns">
                            <button type = "button" class = "invoice-btn" onclick="printInvoice()">
                                <span>
                                    <i class="fa-solid fa-print"></i>
                                </span>
                                <span>Print</span>
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function printInvoice(){
            window.print();
            }
        </script>
    </body>
</html>