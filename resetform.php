
<?php session_start() ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>PASSWORD RECOVERY FORM</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>

<main class="login-form">

    <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
              <div class="card-body py-5 px-md-5">
                <form method="post">
                      <div class="form-group row">
                          <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                          <div class="col-md-6">
                              <input type="text" id="emailaddress" class="form-control" name="email" required autofocus>
                          </div>
                      </div>

                      <div class="col-md-6 offset-md-4">
                          <input type="submit" value="Reset" name="reset">
                      </div>
              </div>
              </form>
                </form>
              </div>
            </div>
        </div>
    </div>

    </div>


</main>
</body>
</html>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

        if(isset($_POST["reset"])){

        include_once('connection.php');
        $email = $_POST["email"];

        $sql = mysqli_query($conn,"SELECT * FROM customer_tb WHERE email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            echo "<script>alert('No Email Exist!');</script>";
        }else{
           // generate token by binaryhexa
            $token = bin2hex(random_bytes(1));
            // $otp = uniqid();
            $link = "http://localhost/Php/Web-Based-Ordering-latest/Web-Based-Ordering-Management-System-master/resetpassword.php";
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;

            require 'vendor/autoload.php';
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
              $mail->Subject = 'Reset Link';
              $mail->Body    = $link;

              $mail->send();

              }catch (Exception $e) {
                //return if there is an error in sending an otp
                echo $mail->ErrorInfo;
                echo "<script>window.location.replace('register.php');</script>";
                return;
              }
              include('method/Query.php');
              $query =  "insert into passwordreset(email,token) values('$email','$token')";;
              if(!Query($query))
              echo "<script>alert('sent!'); window.location.replace('resetform.php');</script>";
              else
                echo "<script>window.location.replace('resetform.php'); alert('Reset Link Sent!');</script>";



        }
  }


?>
