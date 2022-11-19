<?php session_start() ;
include('connection.php');
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>Reset Password Link Form</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Password Reset Form</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- <div class="card-header">Reset Password Link Form/div> -->
                    <div class="card-body">
                        <form method="POST" name="login">

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    <!-- <i class="bi bi-eye-slash" id="togglePassword"></i> -->
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Reset" name="reset">
                            </div>
                    </div>
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
    include('connection.php');
    $psw = $_POST["password"];

    // $token = $_SESSION['token'];
    // $Email = $_SESSION['email'];
    $userLinkId = $_SESSION['userLinkId'];
    $hash = password_hash( $psw , PASSWORD_DEFAULT );

    $sql = mysqli_query($conn, "SELECT * FROM customer_tb where userLinkId = '$userLinkId'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if($userLinkId){
        $newpass = $hash;
        mysqli_query($conn, "UPDATE user_tb SET password='$newpass' WHERE userLinkId = '$userLinkId'");
        echo "<script>window.location.replace('login.php'); alert('Successfull!');</script>";
    }else{
        echo "<script>alert('Try Again!');</script>";
    }
}

?>
<script>
const toggle = document.getElementById('togglePassword');
const password = document.getElementById('password');

toggle.addEventListener('click', function(){
    if(password.type === "password"){
        password.type = 'text';
    }else{
        password.type = 'password';
    }
    this.classList.toggle('bi-eye');
});
</script>
