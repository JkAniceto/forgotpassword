<!DOCTYPE html>
<html>
<head>
    <title>Costumer Menu - Feedback</title>

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
    <button class="btn btn-danger col-12 mb-3" id="customer">Back</button>
        <script>020
            document.getElementById("customer").onclick = function () {window.location.replace('customerMenu.php'); };    
        </script> 
        <?php
            session_start();
            include_once('class/feedbackClass.php');
            include_once('method/query.php');
            $feedback = new feedbackEmpty();  
            $resultSet =  $feedback -> getAllFeedbackSortedByUserLinkId(); 
            $feedback -> generateAllFeedbackTable($resultSet);
        ?>
</div>
</div>

</body>
</html>

<script>
    document.getElementById("home").onclick = function () {window.location.replace('customer.php'); };
	document.getElementById("customerOrders").onclick = function () {window.location.replace('customerOrdersList.php'); };
    
	document.getElementById("logout").addEventListener("click",function(){
		$.post(
        "method/clearMethod.php");
        window.location.replace('login.php');
    });
</script>