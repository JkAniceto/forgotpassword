<!DOCTYPE html>
<html>
<head>
    <title>Costumer Orders - View Order</title>

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
  <div class="table-responsive col-lg-12 cont2">
    <button class="btn btn-danger col-12 mb-3" id="orderList">Back</button>
    <?php 
      $arr = explode(',',$_GET['idAndPic']);
      $id = $arr[0];
      $pic = $arr[1];
      include_once('class/transactionClass.php');
      include('method/Query.php');

      $order = new transactionById( $id );
      $arr =  $order -> getAllOrderById(); 
    ?>
    <table class="table table-bordered border-dark table-striped">
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
  </div>
  <h1>PROOF OF PAYMENT:</h1>
  <?php echo "<img src='payment/$pic' style=width:300px;height:500px>";?>
</div>
    
</body>
</html>

<script>
  document.getElementById("orderList").onclick = function () {window.location.replace('customerOrdersList.php'); };
  document.getElementById("home").onclick = function () {window.location.replace('customer.php'); };
  document.getElementById("menu").onclick = function () {window.location.replace('customerMenu.php'); };

  document.getElementById("logout").addEventListener("click",function(){
      $.post(
      "method/clearMethod.php");
      window.location.replace('login.php');
    });
</script> 