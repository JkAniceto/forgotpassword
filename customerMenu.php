<?php 
    session_start();
    if(!isset($_SESSION["dishes"]) || !isset($_SESSION["price"]) || !isset($_SESSION["orderType"])){
    $_SESSION["dishes"] = array();
    $_SESSION["price"] = array(); 
    $_SESSION["orderType"] = array(); 
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Costumer Menu</title>
    
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
    <!-- <button type="button" class="btn btn-success col-sm-3" id="back">Back</button> -->
    <button type="button" class="btn btn-danger col-12 mb-3" id="viewCart">View Cart</button>
    <button class="btn btn-danger col-12 mb-4" id="customersFeedback">Customers FeedBack</button>
    <div class="table-responsive col-lg-12">
        <table class="table table-bordered border-dark table-striped">
            <thead class="table-dark">
                <tr>	
                    <th scope="col">DISH</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php 
                include_once('class/dishClass.php');
                include_once('method/query.php');
                $dish = new dish();
                $resultSet =  $dish -> getAllDishes(); 
                $dish -> generateDishTableBodyMenu($resultSet);
            ?>
        </table>
    </div>
</div>

</body>
</html>

<?php 
	if(isset($_GET['order'])){
        $order = explode(',',$_GET['order']);  
        $dish = $order[0];
        $price = $order[1];
		$orderType = $order[2];
        array_push($_SESSION['dishes'], $dish);
        array_push($_SESSION['price'], $price);
        array_push($_SESSION['orderType'], $orderType);
    }				
?>

<script>
	// document.getElementById("back").onclick = function () {window.location.replace('customer.php'); };
	document.getElementById("viewCart").onclick = function () {window.location.replace('customerCart.php'); };
    document.getElementById("customersFeedback").onclick = function () {window.location.replace('customerFeedbackList.php'); }; 

    document.getElementById("home").onclick = function () {window.location.replace('customer.php'); };    
    document.getElementById("menu").onclick = function () {window.location.replace('customerMenu.php'); };    
    document.getElementById("customerOrders").onclick = function () {window.location.replace('customerOrdersList.php'); };    

    document.getElementById("logout").addEventListener("click",function(){
      $.post(
      "method/clearMethod.php");
      window.location.replace('login.php');
    });
</script>