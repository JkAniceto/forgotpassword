<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Login </title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js2/bootstrap.min.js"></script>

</head>
<body>
<?php include_once('connection.php');?>

<section class="">
  <div class="px-4 py-5 px-md-5 text-center text-lg-start bg-danger vh-100" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight text-white">
            The best offer <br />
            <span class="text-white">for your business</span>
          </h1>
          <p class="text-white">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
            quibusdam tempora at cupiditate quis eum maiores libero
            veritatis? Dicta facilis sint aliquid ipsum atque?
          </p>
        </div>

        <!-- login form -->
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form method="post">
                <h3 class="fw-normal mb-4 text-center">Log in to your account</h3>
                <input class="form-control form-control-lg" type="text" name="username" placeholder="Username" required></br>
                <input class="form-control form-control-lg" type="password" name="password" placeholder="Password" required></br>
                <div class="mb-3">
                  <a href="resetform.php" class="pass text-muted">Forgot Password?</a>
                </div>
                <button class="btn btn-lg btn-danger col-12 mb-3 shadow" type="submit" name="login" value="login">Login</button><br>
                <div class="text-center text-muted">Not a member? <a href="register.php" class="signup_link text-muted">Sign up</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- modal otp -->
<div class="modal fade" id="otpModal" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content container">
      <div class="modal-body text-center">
        <form method="post" class="form-group">
          <input type="text" class="form-control form-control-lg mb-3" placeholder="Please Enter Your OTP" name="otp" >
          <input data-dismiss="modal" type="submit" value="Cancel" name="Cancel" class="btn btn-danger col-sm-5 mb-3">
          <input type="submit" value="Resend" name="Resend" class="btn btn-danger col-sm-5 mb-3">
          <input type="submit" value="Verify" name="Verify" class="btn btn-success col-10">
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  if(isset($_POST['login'])){
    $_SESSION["username"]  = $_POST['username'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
      echo '<script >alert("Please Complete Details!");</script>';
      echo "<script>window.location.replace('login.php')</script>";
      return;
    }

    // user block
    $query = "select * from user_tb where username = '$username'";
    $resultSet = $conn->query($query);

    if(($resultSet && $resultSet->num_rows)  > 0){
      foreach($resultSet as $rows){
        $valid = password_verify($password, $rows['password'])?true:false;
        $accountType = $rows['accountType'];
      }
      if($valid){
        $query = "select * from customer_Tb where name = '$username'";
        $resultSet = $conn->query($query);
        foreach($resultSet as $row){
          $otp = $row['otp'];
          $_SESSION['userLinkId'] = $rows['userLinkId'];
        }

        switch($accountType){
          case 1://admin
            echo "<script> window.location.replace('admin.php');</script>";
          break;

          case 2://customer
            if($valid && $otp == ""){
              echo "<SCRIPT> window.location.replace('customer.php?username=$username');  </SCRIPT>";
            }
            else if($valid && $otp != "")
              echo "<script>$('#otpModal').modal('show');</script>";
            else
              echo "<script>alert('Incorrect Username or Password!');</script>";
          break;
        }
      }
      else
        echo "<script>alert('Incorrect Username or Password!');</script>";
    }
    else
      echo "<script>alert('Incorrect Username or Password! $conn->error');</script>";
  }

  if(isset($_POST['Verify'])){
    $username = $_SESSION["username"];
    $otp = $_POST['otp'];
    $userLinkId = $_SESSION['userLinkId'];
    $readQuery = "select * from customer_tb where userlinkId = '$userLinkId' && otp = '$otp' ";
    $result = mysqli_query($conn,$readQuery);

    if(mysqli_num_rows($result) === 1){
      // while($rows = mysqli_fetch_assoc($result))
      //     $_SESSION['userlinkId'] = $rows['userlinkId'];
      $updateQuery = "UPDATE customer_tb SET otp='' WHERE otp='$otp'";
      if(mysqli_query($conn, $updateQuery))
        echo "<SCRIPT> window.location.replace('customer.php?username=$username'); </SCRIPT>";
    }
    else
      echo  '<script>alert("Incorrect OTP!"); window.location.replace("login.php");</script>';
  }
?>

</body>
</html>
