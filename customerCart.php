<?php 
    session_start(); 
    date_default_timezone_set('Asia/Manila');
    $date = new DateTime();
    $today =  $date->format('Y-m-d'); 
    $todayWithTime =  $date->format('Y-m-d H:i:s'); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Costumer Menu - View Cart</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js2/bootstrap.min.js"></script>

</head>
<body>    

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top shadow">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">JoohLibeh</a>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" id="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black fw-bold active" aria-current="page" href="#" id="menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white me-2 " href="#" id="customerOrders">Orders</a>
                </li>
            </ul>
      
            <form class="d-flex">
                <a href="#" class="btn btn-outline-light col-12 shadow" type="button" id="logout">Logout</a>
            </form>
        </div>
    </div>
    <hr>
</nav>

<div class="container text-center mt-5 pt-5">
    <!-- <button class="btn btn-success col-sm-2" id="home">Home</button> -->
    <button class="btn btn-danger col-12 mb-3" id="back">Back</button>
    <input id="dateTime" type="datetime-local" class="form-control col-12 text-center mb-3" name="date" min="<?php echo $todayWithTime;?>" value="<?php echo $todayWithTime;?>"/>
    <div class="table-responsive col-lg-12">
        <table class="table table-bordered border-dark table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">DISH</th>
                    <th scope="col">PRICE</th>
                </tr>
            </thead>
            <?php 
                $dishesArr = array();
                $priceArr = array();
                $dishesQuantity = array();
                $orderType = array();
                
                for($i=0; $i<count($_SESSION['dishes']); $i++){
                    if(in_array( $_SESSION['dishes'][$i],$dishesArr)){
                        $index = array_search($_SESSION['dishes'][$i], $dishesArr);
                        $newCost = $priceArr[$index] + $_SESSION['price'][$i];
						$priceArr[$index] = $newCost;
                    }
                    else{
                        array_push($dishesArr,$_SESSION['dishes'][$i]);
                        array_push($priceArr,$_SESSION['price'][$i]);
                        array_push($orderType,$_SESSION['orderType'][$i]);
                    }
                }
                    
                foreach(array_count_values($_SESSION['dishes']) as $count){
                    array_push($dishesQuantity,$count);
                }
                       
                $total = 0;
                //getting total price
                for($i=0; $i<count($priceArr); $i++){
                    $total += $priceArr[$i];
                }
                for($i=0; $i<count($dishesArr); $i++){ ?>
            
            <tr>  
                <td> <?php echo $dishesQuantity[$i];?></td>
                <td> <?php echo $dishesArr[$i];?></td>
                <td> <?php echo '₱'.$priceArr[$i];?></td>
            </tr>
            <?php }?>
            <tr>
                <td colspan="2"><b>TOTAL AMOUNT:</b></td>
                <td><b>₱<?php echo $total; ?></b></td>
            </tr>
        </table> 
       
        <form method="post" enctype="multipart/form-data">           
            <label for="fileInput">PROOF OF PAYMENT:</label>
            <input type="file" name="fileInput" class="form-control mb-3" required>
            <button class="btn btn-danger col-12 mb-3" id="clear">Clear Order</button>
            <button class="btn btn-danger col-12" name="order">Place Order</button>
        </form>
    </div>
</div>

</body>
</html>

<script>
    document.getElementById("dateTime").disabled = true;
</script>

<script>
    document.getElementById("home").onclick = function () {window.location.replace('customer.php'); }; 
    document.getElementById("back").onclick = function () {window.location.replace('customerMenu.php'); }; 
    document.getElementById("customerOrders").onclick = function () {window.location.replace('customerOrdersList.php'); }; 
    
    $(document).ready(function () {
        $("#clear").click(function () {
            $.post(
                "method/clearMethod.php", {
                }
            );
            window.location.replace('customerCart.php');
        });
    });

    document.getElementById("logout").addEventListener("click",function(){
		$.post(
        "method/clearMethod.php");
        window.location.replace('login.php');
    });
</script> 

<?php
    if(isset($_POST['order'])){
        $file = $_FILES['fileInput'];
        if($_FILES['fileInput']['name']=='')
            echo "<script>alert('Please complete the details!'); window.location.replace('customerCart.php');</script>";
        include_once('connection.php');
        $fileName = $_FILES['fileInput']['name'];
        $fileTmpName = $_FILES['fileInput']['tmp_name'];
        $fileSize = $_FILES['fileInput']['size'];
        $fileError = $_FILES['fileInput']['error'];
        $fileType = $_FILES['fileInput']['type'];
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg','jpeg','png');

        if(in_array($fileActualExt,$allowed)){
            if($fileError === 0){
                if($fileSize < 10000000){
                    $userlinkId = $_SESSION['userLinkId'];
                    $ordersLinkId = uniqid();
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'payment/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);   
                    $query1 = "insert into orderList_tb(proofOfPayment, userlinkId, status, ordersLinkId, date, isOrdersComplete) values('$fileNameNew','$userlinkId','0','$ordersLinkId','$todayWithTime', '0')";
                    
                    for($i=0; $i<count($dishesArr); $i++){
                        $query2 = "insert into order_tb(orderslinkId, quantity, orderType) values('$ordersLinkId',$dishesQuantity[$i], $orderType[$i])";
                        mysqli_query($conn,$query2);
                    }

                    if(mysqli_query($conn,$query1)){
                        echo '<script>alert("Sucess Placing Order Please wait for verification!");</script>';       
                        $_SESSION["dishes"] = array();
                        $_SESSION["price"] = array();      
                        $_SESSION["orderType"] = array();                                    
                    }
                    else{
                        echo '<script>alert("failed to save to database");</script>';  
                    }
                    echo "<script>window.location.replace('customerCart.php')</script>";           
                }
                else
                    echo "your file is too big!";
            }
            else
                echo "there was an error uploading your file!";
        }
        else
            echo "you cannot upload files of this type";     
    }
?>