<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js2/bootstrap.min.js"></script>

</head>
<body>

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

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form method="post">
                <h3 class="fw-normal mb-4 text-center">Register your account</h3>
                <input type="text" class="form-control form-control-lg" name="username" placeholder="Enter Username" required></br>
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Enter Name" required></br>
                <input type="email" class="form-control form-control-lg" name="email" placeholder="Enter Email" required></br>
                <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Password" required></br>
                <button type="submit" class="btn btn-lg btn-danger col-12 mb-3" name="createAccount">Create Account</button><br>
                <div class="text-center text-muted">
                  Have already an account? <a href="Login.php" class="login_link text-muted">Log in</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>

<script>
    document.getElementById("back").addEventListener("click",function(){
        window.location.replace('login.php');
    });
</script>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['createAccount'])){
      $username = $_POST['username'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      include('method/query.php');
      $query = "select * from customer_tb where name = '$name' or email = '$email'";
      if(getQuery($query) != null){
        echo "<script>alert('Name or Email Already Exist!');</script>";
        echo "<script>window.location.replace('register.php');</script>";
        return;
      }

      $otp = uniqid();
      $hash = password_hash($password, PASSWORD_DEFAULT);
      //Load Composer's autoloader
      require 'vendor/autoload.php';
      //Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
        //Server settings
        $mail->SMTPDebug  = SMTP::DEBUG_OFF;
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'webBasedOrdering098@gmail.com'; //from //SMTP username
        $mail->Password   = 'cgzyificorxxdlau';                     //SMTP password
        $mail->SMTPSecure =  PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
        $mail->Port       =  465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('webBasedOrdering098@gmail.com', 'webBasedOrdering');
        $mail->addAddress("$email");                                //sent to

        //Content
        $mail->Subject = 'OTP';
        $mail->Body    = $otp;

        $mail->send();

        }catch (Exception $e) {
          //return if there is an error in sending an otp
          echo $mail->ErrorInfo;
          echo "<script>window.location.replace('register.php');</script>";
          return;
        }

      $userLinkId = uniqid('',true);
      $query1 = "insert into user_tb(username, password, accountType, userLinkId) values('$username','$hash','2','$userLinkId')";
      $query2 = "insert into customer_tb(name, email, otp, userLinkId) values('$username','$email','$otp','$userLinkId')";
      if(!Query($query1))
        echo "fail to save to database";
      elseif(!Query($query2))
        echo "fail to save to database";
      else
        echo "<script>window.location.replace('login.php'); alert('OTP Sent! Please Verify Your Account First!');</script>";
    }
?>
