<!DOCTYPE html>
<html>
<head>
    <title>Admin Inventory - Update</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"> 
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
        <script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>  
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js2/bootstrap.min.js"></script>
</head>
<body>

<header class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top flex-md-nowrap shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">Joohlibeh</a>
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</header>

<div class="container-fluid mt-5">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse vh-100 shadow">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link fs-2 mb-2 mt-1 text-black" href="#" id="admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="pos">Point of Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="orders">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="ordersQueue">Orders Queue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-danger text-decoration-underline fw-bold active" aria-current="page" href="#" id="inventory">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="salesReport">Sale Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="Logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mt-3">Dashboard <span class="text-muted">(Inventory - Update)</span></h1>
            </div>

            <div class="container">
                <?php
                    $idAndPicname = explode(' ',$_GET['idAndPicnameUpdate']);    
                    $id = $idAndPicname[0];
                    $dish = $idAndPicname[1];
                    $price = $idAndPicname[2];
                    $picName = $idAndPicname[3];
                    $cost = $idAndPicname[4];
                    $stock = $idAndPicname[5];
                    // echo 
                    // "</br>dish: ".$dish.
                    // "</br>price: ".$price.
                    // "</br> cost: ".$cost.
                    // "</br> stock: ".$stock.
                    // "</br>picname: ".$picName.
                    // "<br></br>";
                ?>
                <div class="table-responsive col-lg-12 mb-3">
                    <table class="table table-bordered border-dark">
                        <tr>
                            <td><b>DISH</b></td>
                            <td><?php echo $dish ?></td>
                        </tr>
                        <tr>
                            <td><b>PRICE</b></td>
                            <td><?php echo $price ?></td>
                        </tr>
                        <tr>
                            <td><b>COST</b></td>
                            <td><?php echo $cost ?></td>
                        </tr>
                        <tr>
                            <td><b>STOCK</b></td>
                            <td><?php echo $stock ?></td>
                        </tr>
                        <tr>
                            <td><b>IMAGE (FILE NAME)</b></td>
                            <td><?php echo $picName ?></td>
                        </tr>
                    </table>
                </div>

                <form method="post" class="form-group" enctype="multipart/form-data">
                    <input type="text" class="form-control" name="dish" placeholder="Enter New Dish Name" required></br>
                    <input type="number" class="form-control" name="price" placeholder="Enter New Price" required></br>
                    <input type="number" class="form-control" name="cost" placeholder="Enter New Cost" required></br>
                    <input type="number" class="form-control" name="stock" placeholder="Enter New Number of Stock" required></br>
                    <input type="file" class="form-control" name="fileInput" required></br>
                    <button type="submit" class="btn btn-success col-12 mb-3" name="update">Update</button>
                    <button type="button" class="btn btn-danger col-12 mb-3" id="cancel">Cancel</button>
                </form>
            </div>
        </main>
    </div>
</div>

</body>
</html>

<script>
    document.getElementById("cancel").addEventListener("click",function(){
        window.location.replace('adminInventory.php');
    });
</script>

<script>
    document.getElementById("admin").onclick = function () {window.location.replace('admin.php'); };
    document.getElementById("pos").onclick = function () {window.location.replace('adminPos.php'); };
    document.getElementById("orders").onclick = function () {window.location.replace('adminOrdersList.php'); };
    document.getElementById("ordersQueue").onclick = function () {window.location.replace('adminOrdersQueue.php'); };
    document.getElementById("inventory").onclick = function () {window.location.replace('adminInventory.php'); };
    document.getElementById("salesReport").onclick = function () {window.location.replace('adminSalesReport.php'); };

    document.getElementById("Logout").onclick = function () {window.location.replace('Login.php'); 
    $.post(
        "method/clearSessionMethod.php", {
        }
    );};
  </script>

<?php
    //if update button click
    if(isset($_POST['update'])){
        $dish = $_POST['dish'];
        $price = $_POST['price'];
        $cost = $_POST['cost'];
        $stock = $_POST['stock'];
        if(empty($dish) || empty($price) || empty($cost) || empty($stock) || $_FILES['fileInput']['name']==''){
        echo "<script>alert('Please complete the details! ');</script>";
        return;    
        }
        include_once('connection.php');
        $file = $_FILES['fileInput'];
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
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'dishesPic/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);         
                    $updateQuery = "UPDATE dishes_tb
                    SET dish='$dish', 
                    price='$price',
                    picName = '$fileNameNew',
                    cost = '$cost',
                    stock =  '$stock'
                    WHERE orderType=$id ";        
                    if($conn->query($updateQuery)){
                        echo '<script>alert("Sucess updating the database!");</script>';       
                        unlink("dishespic/".$picName);                                        
                    }
                    else{
                        echo '<script type="text/javascript">alert("failed to save to database");</script>';  
                    }
                    echo "<script>window.location.replace('adminInventory.php')</script>";                                
                }
                else
                    echo "your file is too big!";
            }
            else
                echo "there was an error uploading your file!";
        }
        else
            echo "you cannot upload files of this type";  

        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: ../read.php?success=successfully updated");
        }else {
            header("Location: ../update.php?id=$id&error=unknown error occurred&$user_data");
        }
    }
?>