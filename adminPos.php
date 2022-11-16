<?php 
  session_start();
  if(!isset($_SESSION["dishes"]) && !isset($_SESSION["price"])){
    $_SESSION["dishes"] = array();
    $_SESSION["price"] = array(); 
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin POS</title>
    
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
                        <a class="nav-link fs-5 mb-2 text-danger text-decoration-underline fw-bold active" aria-current="page" href="#" id="pos">Point of Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="orders">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="ordersQueue">Orders Queue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 mb-2 text-black" href="#" id="inventory">Inventory</a>
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
                <h1 class="h2 mt-3">Dashboard <span class="text-muted">(POS)</span></h1>
            </div>

            <div class="container text-center">
              <!-- <button class="btn btn-danger col-12 mb-3" id="admin">Admin</button> -->
              <button  type="button" class="btn btn-danger col-12 mb-3" id="viewCart" >View Cart</button>
              
              <div class="table-responsive col-lg-12">
            <?php 
                include_once('class/dishClass.php');
                include('method/Query.php');
                $dish = new dish();
                $resultSet =  $dish -> getAllDishes(); 
            ?>
            <table class="table table-bordered border-dark table-striped">
                <thead class="table-dark">
                <tr>	
                <th scope="col">DISH</th>
                <th scope="col">PRICE</th>
                <th scope="col">IMAGE</th>
                <th scope="col"></th>
                </tr>
                </thead>
              <tbody>
                <?php
                  $dish->generateDishTableBodyMenu($resultSet);
                ?>
              </tbody>
            </table>
            </div>
        </main>
    </div>
</div>

</body>
</html>

<script>
  // document.getElementById("admin").onclick = function () {window.location.replace('admin.php'); };
  document.getElementById("viewCart").onclick = function () {window.location.replace('adminCart.php'); };
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
    if(isset($_GET['order'])){
      $order = explode(',',$_GET['order']);  
      $dish = $order[0];
      $price = $order[1];
      array_push($_SESSION['dishes'], $dish);
      array_push($_SESSION['price'], $price);
    }
?>