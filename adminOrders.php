<!DOCTYPE html>
<html>
<head>
    <title>Admin Orders - View Order</title>
    
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
                        <a class="nav-link fs-5 mb-2 text-danger text-decoration-underline fw-bold active" aria-current="page" href="#" id="orders">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="ordersQueue">Orders Queue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="inventory">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="adminSalesReport.php" id="">Sale Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="Logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mt-3">Dashboard <span class="text-muted">(Orders - View Order)</span></h1>
            </div>

            <div class="container text-center">
              <div class="table-responsive col-lg-12">
              <button class="btn btn-danger col-12 mb-3" id="orderList">Order List</button>
                <button class="btn btn-danger col-12 mb-3" id="salesReport">Sales Report</button>
                <?php 
                  $arr = explode(',',$_GET['idAndPic']);
                  $id = $arr[0];
                  $pic = $arr[1];
                  include_once('class/transactionClass.php');
                  include('method/Query.php');
                  $order = new transactionById( $id );  
                  $arr =  $order -> getAllOrderById(); 
                ?>
                <table class="table table-bordered border-dark table-striped mb-3">
                <thead class="table-dark">
                <tr>	
                <!-- <th scope="col">price</th> -->
                <th scope="col">QUANTITY</th>
                <th scope="col">NAME</th>
                <th scope="col">PRICE</th>
                </tr>
                </thead>
                  <tbody>
                    <?php 
                    $total = 0;
                    if($arr != null)
                    foreach($arr as $rows){ ?>
                    <tr>	   
                      <?php $price = ($rows['price']*$rows['quantity']);  $total += $price;?>
                      <td><?php echo $rows['quantity']; ?></td>
                      <td><?php echo $rows['dish']; ?></td>
                      <td><?php echo '₱'.$price?></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td colspan="2"><b>TOTAL AMOUNT:</b></td>
                      <td><b>₱<?php echo $total?></b></td>
                    </tr>
                  </tbody>
                </table>
                <div class="text-center">
                  <h3 class="fw-normal">PROOF OF PAYMENT:</h3>
                  <?php echo "<img src='payment/$pic' style=width:300px;height:500px>";?>
                </div>
              </div>    
            </div>  
        </main>
    </div>
</div>

</body>
</html>

<script>
  document.getElementById("orderList").onclick = function () {window.location.replace('adminOrdersList.php'); };
  // document.getElementById("salesReport").onclick = function () {window.location.replace('adminSalesReport.php'); };
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