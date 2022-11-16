
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

    <title>Login Form</title>
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

    if(isset($_POST["reset"])){

        include_once('connection.php');
        $email = $_POST["email"];

        $sql = mysqli_query($conn,"SELECT * FROM customer_tb WHERE email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "No email exsist "?>");
            </script>
            <?php
        }else if($fetch["email"] == 0){
            ?>
               <script>
                   alert("verify your account first!");
                   window.location.replace("resetform.php");
               </script>
           <?php
        }else{


            // generate token by binaryhexa
            $token = bin2hex(random_bytes(50));

            //session_start ();
            // $token = $_SESSION['token'];
            // $_SESSION['email'] = $email;

            // $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;


            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=465;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='email account';
            $mail->Password='email password';

            // send by h-hotel email
            $mail->setFrom('username', 'Password Reset');
            $mail->addAddress($_POST["email"]);


            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recover your password";
            $mail->Body="<b>link</b>
            http://localhost/Php/Web-Based-Ordering-latest/Web-Based-Ordering-Management-System-master/resetpassword.php
            <br><br>
            <b>Web Based Ordering Management System/b>";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo " Invalid Email "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        window.location.replace("login.php");
                    </script>
                <?php
            }
        }
    }


?>
