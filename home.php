<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js2/bootstrap.min.js"></script>

</head>
<body class="bg-light">

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
                    <a class="nav-link text-white" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white me-2" href="#contact">Contact</a>
                </li>
            </ul>
      
            <form class="d-flex">
                <a href="Login.php" class="btn btn-outline-light col-12 shadow" type="button">Login</a>
            </form>
        </div>
    </div>
    <hr>
</nav>

<!-- section #home -->
<section id="home" class="mb-5">
    <!-- <div class="container container1 mb-5"> -->
        <div id="carousel" class="carousel slide shadow" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://htmlcolorcodes.com/assets/images/colors/pastel-red-color-solid-background-1920x1080.png" class="d-block w-100" alt="Pics" style="height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://wallpaperaccess.com/full/1684455.jpg" class="d-block w-100" alt="Pics" style="height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://www.solidbackgrounds.com/images/3840x2160/3840x2160-pastel-red-solid-color-background.jpg" class="d-block w-100" alt="Pics" style="height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
  
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <!-- </div> -->
</section>

<!-- section #menu -->
<section id="menu">
    <div class="container mb-5">
        <h1 class="fw-normal text-center">OUR MENU</h1>
        <div class="row g-3">
            <div class="col-sm-6 col-lg-3">
                <div class="card h-100 shadow">
                    <img src="https://htmlcolorcodes.com/assets/images/colors/pastel-red-color-solid-background-1920x1080.png" class="card-img-top" alt="Menu">
                    <div class="card-body">
                        <h5 class="card-title">Menu</h5>
                        <p class="card-text">Description / Price</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card h-100 shadow">
                    <img src="https://htmlcolorcodes.com/assets/images/colors/pastel-red-color-solid-background-1920x1080.png" class="card-img-top" alt="Menu">
                    <div class="card-body">
                        <h5 class="card-title">Menu</h5>
                        <p class="card-text">Description / Price</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card h-100 shadow">
                    <img src="https://htmlcolorcodes.com/assets/images/colors/pastel-red-color-solid-background-1920x1080.png" class="card-img-top" alt="Menu">
                    <div class="card-body">
                        <h5 class="card-title">Menu</h5>
                        <p class="card-text">Description / Price</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card h-100 shadow">
                    <img src="https://htmlcolorcodes.com/assets/images/colors/pastel-red-color-solid-background-1920x1080.png" class="card-img-top" alt="Menu">
                    <div class="card-body">
                        <h5 class="card-title">Menu</h5>
                        <p class="card-text">Description / Price</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section #about -->
<section id="about">
    <div class="container mb-5">
        <h1 class="fw-normal text-center">ABOUT US</h1>
        <div class="row g-3">
            <div class="col-sm-6 col-lg-6">
                <div class="card h-100 shadow">
                    <img src="https://htmlcolorcodes.com/assets/images/colors/pastel-red-color-solid-background-1920x1080.png" class="card-img-top" alt="About">
                </div>
            </div><div class="col-sm-6 col-lg-6">
                <div class="card h-100">
                    <div class="card-body shadow">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                            labore et dolore magna aliqua. Eu volutpat odio facilisis mauris sit amet massa vitae tortor. 
                            Vitae aliquet nec ullamcorper sit. Metus vulputate eu scelerisque felis. Gravida cum sociis 
                            natoque penatibus. Diam ut venenatis tellus in metus vulputate eu scelerisque. Nunc consequat 
                            interdum varius sit amet mattis. Neque gravida in fermentum et sollicitudin. Et odio 
                            pellentesque diam volutpat commodo. Pulvinar pellentesque habitant morbi tristique. Purus 
                            gravida quis blandit turpis cursus in. Amet justo donec enim diam vulputate ut pharetra sit 
                            amet. Vulputate sapien nec sagittis aliquam malesuada. Enim lobortis scelerisque fermentum 
                            dui faucibus in ornare quam viverra. Nisl rhoncus mattis rhoncus urna. Pulvinar sapien et 
                            ligula ullamcorper malesuada proin libero. Phasellus faucibus scelerisque eleifend donec 
                            pretium. Sapien et ligula ullamcorper malesuada.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section #contact -->
<section id="contact">
    <footer class="text-center text-lg-start bg-danger">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span class="text-white">Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="#" class="me-4 text-white link">Facebook</a>
                <a href="#" class="me-4 text-white link">Twitter</a>
                <a href="#" class="me-4 text-white link">Google</a>
                <a href="#" class="me-4 text-white link">Instagram</a>
                <a href="#" class="me-4 text-white link">LinkedIn</a>
                <a href="#" class="me-4 text-white link">GitHub</a>
            </div>
        </section>

        <section>
            <div class="container mt-3 mb-3">
                <div class="row g-3">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100" style="background: none;">
                            <div class="card-body shadow">
                            <input type="text" class="form-control mb-3" placeholder="Your Email">
                                <input type="number" class="form-control mb-3" placeholder="Your Phone Number">
                                <input type="text" class="form-control mb-3" placeholder="Subject">
                                <textarea type="text" class="form-control mb-3" placeholder="Message" rows="5"></textarea>
                                <button type="submit" class="btn btn-light col-12">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-9">
                        <div class="card h-100 shadow">
                            <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 390px">
                                <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center p-4 text-white" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-white fw-bold link" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
</section>
    
</body>
</html>