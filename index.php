<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "=") + 1); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>S'tockpile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Harbour:wght@700&display=swap">
  <link rel="stylesheet" href="index.css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<!-- navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <?php if($type !== 'login'): ?>
        <li><a href="#home">HOME</a></li>
        <li><a href="#newsfeed">NEWSFEED</a></li>
        <li><a href="#merchandise">MERCHANDISE</a></li>
        <li class="login-btn"><a type="button" id="loginBtn" href="index.php?type=login">Login</a></li>
        <?php else: ?><li class="login-btn"><a type="button" id="loginBtn" href="index.php?type=home"> <i class="fas fa-home"></i></a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<?php
if($type == 'login'){
  include 'login.php';
}else {?>
  <div id="home" class="container-fluid">
    <div class="row">
      <div class="col-sm-8">
        <h1>Resource Generation Office 
          at Batstate-U ARASOF 
          Nasugbu Campus</h1><br>
        <h4>RGO offers affordable school uniforms, books, personal accident insurance, 
          improved canteen spaces, innovative facilities, a university shop. It provides 
          quality and affordable services to students and the university, ensuring a safe
          and comfortable environment.</h4><br>
        <br><a type="button" target="_blank" href="https://batstateu.edu.ph/resource-generation/" class="btn btn-default btn-lg btn-custom">Discover more</a>
      </div>
      <div class="col-sm-4">
          <img src="./img/bsu.png" alt="Your Image" class="img-responsive">
        </div>
    </div>
  </div>
  
  
  <!-- Container (HOME Section) -->
  <div id="newsfeed" class="container-fluid text-center">
      <h2 class="home-text">“One Place for Everything”</h2>
      <h4>S'tockpile serves as the university's central repository, named after the idea of a Spartan's Stockpile A 
        Resource Management System ensuring efficient organization and accessibility for everyone.</h4>
      <br>
      <div class="row slideanim">
        <div class="col-sm-4">
          <div class="card-2">
            <img src="img/icon.jpg" class="card-2-img-top" alt="...">
            <div class="card-body-2">
              <h1 class="card-h1">Merchandise<br>Browsing</h1>
              <p class="card-text">Look through all the things available. See what's there and pick what you want.</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card-2">
            <img src="img/icon.jpg" class="card-2-img-top" alt="...">
            <div class="card-body-2">
              <h1 class="card-h1">Stock<br>Reservation</h1>
              <p class="card-text">Hold onto the items you need by reserving them in advance. Make sure you have what you need, when you need it, without any last-minute hassle.</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card-2">
            <img src="img/icon.jpg" class="card-2-img-top" alt="...">
            <div class="card-body-2">
              <h1 class="card-h1">Facility<br>Rental</h1>
              <p class="card-text">Need to use the gym or other facilities? Easily check availability and reserve your spot. Perfect for ensuring you have access to the spaces you need for your activities.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  
  <!-- Container (NEWSFEED Section) -->
  <div id="newsfeed" class="container-fluid text-center bg-grey">
      <h2 class="text-h2">ANNOUNCEMENTS</h2><br>
      <h4>S'tockpile serves as the university's central repository, named after the idea of a Spartan's Stockpile A 
        Resource Management System ensuring efficient organization and accessibility for everyone.</h4>
      
      <!-- Box with Clickable Image -->
      <div class="row text-center">
        <div class="col-sm-4">
          <div class="card">
            <a href="https://example.com/paris" target="_blank">
              <img src="img/bsu1.webp" class="card-img-top" alt="Paris">
            </a>
            <div class="card-body">
              <h5 class="card-title">BatStateU The NEU remains strong in the 2024 Times Higher Education Impact Rankings</h5>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <a href="https://example.com/newyork" target="_blank">
              <img src="img/bsu2.jpg" class="card-img-top" alt="New York">
            </a>
            <div class="card-body">
              <h5 class="card-title">BatStateU The NEU launches the Philippines’ NEED program to redefine the future of engineering education</h5>
             
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <a href="https://example.com/sanfran" target="_blank">
              <img src="img/bsu3.jpg" class="card-img-top" alt="San Francisco">
            </a>
            <div class="card-body">
              <h5 class="card-title">Filipino engineering students from BatStateU secure 3rd place in the World Engineering Day Hackathon</h5>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
  
  <!-- Container (MERCHANDISE Section) -->
  <div id="merchandise" class="container-fluid">
      <div class="text-center">
        <h2 class="h2-text">MERCHANDISE</h2>
      </div>
      <div class="row slideanim">
        <div class="col-sm-4 col-xs-12 custom-col-sm custom-col-xs">
          <div class="panel panel-default text-center">
            <div class="panel-body">
              <img src="img/item.jpg" alt="Item Image" class="panel-image">
              <h1>Item Name</h1>
              <p>Description</p>
            </div>
            <div class="panel-button">  
              <button class="btn btn-lg">Reserve Now</button>
            </div>
          </div>      
        </div>     
        <div class="col-sm-4 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-body">
              <img src="img/item.jpg" alt="Item Image" class="panel-image">
              <h1>Item Name</h1>
              <p>Description</p>
            </div>
            <div class="panel-button">
              <button class="btn btn-lg">Reserve Now</button>
            </div>
          </div>      
        </div>       
        <div class="col-sm-4 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-body">
              <img src="img/item.jpg" alt="Item Image" class="panel-image">
              <h1>Item Name</h1>
              <p>Description</p>
            </div>
            <div class="panel-button">
              <button class="btn btn-lg">Reserve Now</button>
            </div>
          </div>      
        </div> 
        <div class="col-sm-4 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-body">
              <img src="img/item.jpg" alt="Item Image" class="panel-image">
              <h1>Item Name</h1>
              <p>Description</p>
            </div>
            <div class="panel-button">
              <button class="btn btn-lg">Reserve Now</button>
            </div>
          </div>      
        </div>
        <div class="col-sm-4 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-body">
              <img src="img/item.jpg" alt="Item Image" class="panel-image">
              <h1>Item Name</h1>
              <p>Description</p>
            </div>
            <div class="panel-button">
              <button class="btn btn-lg">Reserve Now</button>
            </div>
          </div>      
        </div>     
        <div class="col-sm-4 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-body">
              <img src="img/item.jpg" alt="Item Image" class="panel-image">
              <h1>Item Name</h1>
              <p>Description</p>
            </div>
            <div class="panel-button">
              <button class="btn btn-lg">Reserve Now</button>
            </div>
          </div>      
        </div>             
      </div>
    </div>
    
  
  <!-- Container (Contact Section) -->
  <div id="contact" class="container-fluid bg-grey">
    <h2 class="text-center">RESOURCE GENERATION OFFICE</h2>
    <div class="row">
      <div class="col-sm-5">
        <p>For details and inquiries, you may reach the Resource Generation Office through the following:</p>
        <p><span class="glyphicon glyphicon-phone"></span> +6343 416 0350 local 505</p>
        <p><span class="glyphicon glyphicon-phone"></span> +63 947 996 0075</p>
        <p><span class="glyphicon glyphicon-envelope"></span> rgo.nasugbu@.batstate-u.edu.ph</p>
      </div>
      
        </div>
      </div>
    </div>
  </div>
  
  
  <footer class="container-fluid text-center">
    <a href="#myPage" title="To Top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
  </footer>
<?php } ?>

</body>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>