<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin POS - View Cart</title>

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
                    <!-- dito yung sidenav -->
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mt-3">Dashboard <span class="text-muted">(POS - View Cart)</span></h1>
            </div>

            <div class="container">
            <!-- <div class="container text-center pt-5 mt-5"> -->
                <button class="btn btn-danger col-12 mb-3" id="back">Back</button>
                <button class="btn btn-danger col-12 mb-3" id="clear">Clear Order</button>
                <div class="table-responsive col-lg-12">
                    <table  class="table table-bordered border-dark table-striped mb-3">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">QUANTITY</th>
                                <th scope="col">DISH</th>
                                <th scope="col">COST</th>
                            </tr>
                        </thead>
                        <?php 
                        $dishesArr = array();
                        $priceArr = array();
                        $dishesQuantity = array();
                        for($i=0; $i<count($_SESSION['dishes']); $i++){
                            if(in_array( $_SESSION['dishes'][$i],$dishesArr)){
                                $index = array_search($_SESSION['dishes'][$i], $dishesArr);
                                $newCost = $priceArr[$index] + $_SESSION['price'][$i];
                                $priceArr[$index] = $newCost;
                            }
                            else{
                                array_push($dishesArr,$_SESSION['dishes'][$i]);
                                array_push($priceArr,$_SESSION['price'][$i]);
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
                            <td> <?php echo $priceArr[$i];?></td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td colspan="2"><b>TOTAL AMOUNT:</b></td>
                            <td><b><?php echo $total; ?></b></td>
                        </tr>
                    </table> 
        
        
                    <form method="post">
                        <input name="cash" placeholder="Cash Amount" type="number" class="form-control mb-3"></input>
                        <button class="btn btn-danger col-12" name="order" id="order">Order</button>
                    </form>
                </div>
            <!-- </div> -->
            </div>
        </main>
    </div>
</div>

</body>
</html>

<?php
    if(isset($_POST['order'])){
        $cash = $_POST['cash'];
        if(empty($cash)){
            echo "<script>alert('Please Enter your Cash Amount');</script>";
            return;
        }
        if($cash<$total){
            echo "<script>alert('Your Cash is less than your total Payment amount');</script>";
            return;
        }
        include_once('class/orderClass.php');
        $order = new order($dishesQuantity,$dishesArr,$priceArr,$cash,$total);
        $order-> displayReceipt(); 
    }
?>

<script>
document.getElementById("back").onclick = function () {window.location.replace('adminPos.php'); }

$(document).ready(function () {
    $("#clear").click(function () {
        $.post(
            "method/clearMethod.php", {
            }
        );
        window.location.replace('adminCart.php');
    });
});

</script> 



<!-- 
        add pdf page and size
        //AddPage [P(PORTRAIT),L(LANDSCAPE)],FORMAT(A4-A5-ETC)
        // $obj_pdf->AddPage('P','A5');
        you can see all possible values in this file: tcpdf/include/tcpdf_static.php
 -->