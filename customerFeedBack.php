<!DOCTYPE html>
<html>
<head>
    <title>Costumer Orders - Feedback</title>
        
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
                    <a class="nav-link text-white" href="#" id="menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black fw-bold me-2 active" aria-current="page" href="#" id="customerOrders">Orders</a>
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
        <button class="btn btn-danger col-12" id="orderList">Back</button>
        <script>document.getElementById("orderList").onclick = function () {window.location.replace('customerOrdersList.php'); }; </script> 
            <div class="col-lg-12">
                <form method="post">
                    </br>
                    <textarea name="feedback" placeholder="Enter Your Feedback" cols="100" rows="5" class="form-control mb-3" required></textarea>
                    <button type="submit" name="submit" class="btn btn-danger col-12">Submit</button>
                </form>
            </div>
	    </div>
        
</body>
</html>

<script>
	document.getElementById("home").onclick = function () {window.location.replace('customer.php'); };
	document.getElementById("menu").onclick = function () {window.location.replace('customerMenu.php'); };

    document.getElementById("logout").addEventListener("click",function(){
		$.post(
        "method/clearMethod.php");
        window.location.replace('login.php');
    });
</script>

<?php 
    if(isset($_POST['submit'])){
        $arr = explode(',',$_GET['ordersLinkIdAndUserLinkId']);
        $ordersLinkId = $arr[0];
        $userLinkId = $arr[1];
        $feedback = $_POST['feedback'];
        include('class/feedbackClass.php');
        include('method/Query.php');
        $dish = new feedback($feedback,$ordersLinkId,$userLinkId);
        $dish -> giveFeedBackByOrdersLinkIdAndUserLinkId();
    }
?>