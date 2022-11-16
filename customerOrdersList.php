<!DOCTYPE html>
<html>
<head>
    <title>Costumer Orders</title>

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
  <!-- <button class="btn btn-success col-sm-4" id="customer">Customer</button> -->
  <div class=" table-responsive col-lg-12">
    <table class="table table-bordered border-dark table-striped">
      <thead class="table-dark">
        <tr>	
          <th scope="col">NAME</th>
          <th scope="col">STATUS</th>
          <th scope="col">EMAIL</th>
          <th scope="col"></th>
          <th scope="col">FEEDBACK</th>
          <th scope="col">DATE & TIME</th>
        </tr>
      </thead>
      <tbody>
      <?php
                session_start();
                include_once('class/transactionClass.php');
                include_once('class/feedbackClass.php');
                include('method/Query.php');
                $transaction = new transactionByUserLinkId($_SESSION["userLinkId"]);  //Scope Resolution Operator (::) double colon = jump to search 
                $resultSet =  $transaction -> getOrderListByUserLinkId(); 
                if($resultSet != null)
                foreach($resultSet as $rows){ ?>
                <tr>	   
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo ($rows['status'] == 1 ? "Approved": "Pending"); 
                ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><a class="btn" style="background: white; padding:2px; border: 2px black solid; color:black;" href="customerOrders.php?idAndPic=<?php echo $rows['ordersLinkId'].','.$rows['proofOfPayment']?>">View Order</a></td>
                <td><?php 
                  $transaction =  new feedback('',$rows['ordersLinkId'],$rows['userLinkId']);
                  if($rows['status'] == 1 && $transaction->CustomerFeedback() == null){
                    ?>  <a class="btn" style="background: white; padding:2px; border: 2px black solid; color:black;" href="customerFeedBack.php?ordersLinkIdAndUserLinkId=<?php echo $rows['ordersLinkId'].','.$rows['userLinkId']?>">feedback</a>  <?php
                  }
                  elseif($rows['status'] == 1){
                    echo "You have already feedback!";
                  }
                  else{
                    echo "you cannot give feedback yet </br> please wait for approvation";
                  }
                ?>
                </td>
                <td><?php echo date('m/d/Y h:i:s a ', strtotime($rows['date'])); ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
	    </div>
    </body>
</html>

<script>
  document.getElementById("menu").onclick = function () {window.location.replace('customerMenu.php'); };
	document.getElementById("home").onclick = function () {window.location.replace('customer.php'); };
  
	document.getElementById("logout").addEventListener("click",function(){
		$.post(
        "method/clearMethod.php");
        window.location.replace('login.php');
    });
</script>

<?php 
  if(isset($_GET['status'])){
    $arr = explode(',',$_GET['status']);  
    $ordersLinkId = $arr[0];
    $email = $arr[1];
    $order = new order($ordersLinkId,$email);
    $order-> computeOrder(); 
    $order-> sendReceiptToEmail(); 
    $order-> approveOrder();
  }
?>