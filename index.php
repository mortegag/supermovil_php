
<?php


if(isset($_POST['correo'])) { 


  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $from = $_POST['email'];
  $name = $_POST['name'];

  $to = "soporte@supermovilapp.com";
  $subject = "Esto es una prueba";
  
  //$message = "<b>This is HTML message.</b>";
  //$message .= "<h1>This is headline.</h1>";
  
  $header = "From:".$from."\r\n";

  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html\r\n";
  
  $retval = mail ($to,$subject,$message,$header);
  
  if( $retval == true ) {
     echo "Message sent successfully...";
  }else {
     echo "Message could not be sent...";
  }


 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
  <title>Super Movil App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 400 15px Lato, sans-serif;
    line-height: 1.8;
    color: #818181;
  }
  h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 600;
    margin-bottom: 30px;
  }
  h4 {
    font-size: 19px;
    line-height: 1.375em;
    color: #303030;
    font-weight: 400;
    margin-bottom: 30px;
  }  
  .jumbotron {
    background-color: #1ec1f4;
    color: #fff;
    padding: 100px 25px;
    font-family: Montserrat, sans-serif;
  }
  .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .logo-small {
    color: #f4511e;
    font-size: 50px;
  }
  .logo {
    color: #1ec1f4;
    font-size: 200px;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
    background-image: none;
    color: #f4511e;
  }
  .carousel-indicators li {
    border-color: #f4511e;
  }
  .carousel-indicators li.active {
    background-color: #f4511e;
  }
  .item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .panel {
    border: 1px solid #f4511e; 
    border-radius:0 !important;
    transition: box-shadow 0.5s;
  }
  .panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
    border: 1px solid #f4511e;
    background-color: #fff !important;
    color: #f4511e;
  }
  .panel-heading {
    color: #fff !important;
    background-color: #1e56f4 !important;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .panel-footer {
    background-color: white !important;
  }
  .panel-footer h3 {
    font-size: 32px;
  }
  .panel-footer h4 {
    color: #aaa;
    font-size: 14px;
  }
  .panel-footer .btn {
    margin: 15px 0;
    background-color: #000000;
    color: #fff;
  }
  .navbar {
    margin-bottom: 0;
    background-color: #0000a0;
    z-index: 9999;
    border: 0;
    font-size: 12px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 4px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: #f4511e !important;
    background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
  }
  footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
    animation-name: slide;
    -webkit-animation-name: slide;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
      width: 100%;
      margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
      font-size: 150px;
    }
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">SM</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ACERCA</a></li>
        <li><a href="#services">SERVICIOS</a></li>
        <li><a href="#portfolio">PORTAFOLIO</a></li>
        <li><a href="#pricing">PRECIOS</a></li>
        <li><a href="#contact">CONTACTOS</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>Super Movil App</h1> 
  <p>Tecnologia de movilidad interurbana</p> 
  <form>
    <div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="Ver nuestros productos SUPER MOVIL -----> " required>
      <div class="input-group-btn">
        <a href="#portfolio">
        <button type="button" class="btn btn-danger">Ir a Productos</button>
        </a>
      </div>
    </div>
  </form>
</div>

 

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <h2>Acerca de nuestros servicio</h2><br>
      <h4>Somos una empresa pyme que le ofrecemos servicios de movilidad inter-urbana, por medios tecnologicos.</h4><br>
      <p>Estamos dirigidos a usuarios y operadores del transporte, solucionando principalmente la necesidad de un transporte, ya sea por  distanciamiento y comunicacion, o desconocimiento la oferta y demanda de miles de personas que necesitan una respuesta rapida y segura de movilidad inter-urbana.</p>
      <br><button class="btn btn-default btn-lg">Adquiera Super Movil</button>
    </div>
    <div class="col-sm-4">
    <img src="img/col1.jpg" class="rounded-circle" alt="App usuario" width="600" height="400"> 
      <span class="glyphicon glyphicon-time logo"></span>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Nuestros Valores</h2><br>
      <h4><strong>MISION:</strong> Nuesta mision es derribar las barreras que dificultan la disponibilidad de la demanda de un transporte seguro y viable, mejorando asi la movilidad vial.</h4><br>
      <p><strong>VISION:</strong> Nuestra vision es faciltar a cada usuario de forma sencilla, una herramienta tecnologica facil de utilizar para resolver de forma tangible la movilidad inter-urbana.</p>
    </div>
  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
   
</div>

<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">

  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"El pensamiento del diligente ciertamente tienden a la abundancia..."<br><span>Proverbios 21:5</span></h4>
      </div>
      <div class="item">
        <h4>"Has visto hombre solicito en su trabajo?, delante de los reyes estara ..."<br><span>Proverbios 22:29</span></h4>
      </div>
      <div class="item">
        <h4>"Todo lo que hagas te saldra bien... ?"<br><span>Salmos 1:3 </span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Container (Pricing Section) -->
<div id="pricing" class="container-fluid">
  <div class="text-center">
    <h2>Precios de nuestros servicios</h2>
    <h4>Escoja si usted va utilizar el App como usuario o como chofer</h4>
  </div>
  <div class="row slideanim">
    <div class="col-sm-6 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Super Movil Usuario</h1>
        </div>
        <div class="panel-body">
          <p><strong>Acceso : </strong>Por Celular</p>
          <p><strong>Mapa : </strong>Google Map</p>
          <p><strong>Buscador : </strong>Transportes disponibles</p>
          <p><strong>Mensajes push : </strong>A choferes</p>
          <p><strong>Opcion: </strong>Cancelar Viaje</p>
          <p><strong>Opcion: </strong>Escoger Chofer</p>
          <p><strong>Radio de Accion : </strong>10 Km</p>
          <p><strong>Perfil :</strong>Datos de Chofer</p>
          <p><strong>Calificacion :</strong>Puntuacion al Chofer</p>
          <p><strong>Historial :</strong>Historial de viajes</p>
        </div>
        <div class="panel-footer">
          <h2>$0.00</h2>
          <a href="https://play.google.com/store/apps/details?id=com.sigredes.supermovilcliente" download="SuperMovilUsuario">         
          <button class="btn"><i class="fa fa-download"></i> Download</button>
          <a href="apk/app-release.apk" download>Descarga directa</a>
          </a>
        </div>
      </div>      
    </div>     
    <div class="col-sm-6 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Super Movil Chofer</h1>
        </div>
        <div class="panel-body">
           <p><strong>Acceso : </strong>Por Celular</p>
          <p><strong>Mapa : </strong>Google Map</p>
          <p><strong>Mensajes push : </strong>Carreras de usuarios</p>
          <p><strong>Opcion: </strong>Aceptar/Rechazar</p>
          <p><strong>Perfil :</strong>Datos de usuario</p>
          <p><strong>Calificacion :</strong>Puntuacion al usuario</p>
          <p><strong>Historial :</strong>Historial de viajes</p>
          <p><strong>Prepago :</strong>Banca en linea</p>
          <p><strong>Falicidad de Pago :</strong>Yappy</p>
           <p><strong>Historial de Credito :</strong>pagos por servicios</p>
        </div>
        <div class="panel-footer">
          <h2>%10 a 15% por servicio</h2>
          <a href="https://play.google.com/store/apps/details?id=com.sigredes.supermovilchofer" download="SuperMovilChofer">         
          <button class="btn" onclick="clicFunction()"><i class="fa fa-download"></i> Download</button>
          </a>
          <p id="clics"></p>
        </div>
      </div>      
    </div>       
      
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Puede Contactactarnos en estos medios.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Panama, Panama</p>
      <p><span class="glyphicon glyphicon-phone"></span> +507 6557-555447  (whatsapp)</p> 
      <p><span class="glyphicon glyphicon-envelope"></span> support@supermovilapp.com</p>
    </div>
    <div class="col-sm-7 slideanim">
    <form method="POST"  action="index.php">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="message" name="message" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit" name="correo"
          value="Submit">Send</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Image of location/map -->
<img src="img/map.jpg" class="w3-image w3-greyscale-min" style="width:100%">

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>SuperMovil@2022  Correo:<a href="#" title="">soporte@supermovilapp.com</a></p>
</footer>

<script>
$(document).ready(function(){

  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    if (this.hash !== "") {
   
      event.preventDefault();

 
      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
    
        window.location.hash = hash;
      });
    }
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

function clicFunction() {
  document.getElementById("clics").innerHTML = "Para Super Movil Chofer, contacte con nosotros ...estamos en modo PRUEBA";
}
</script>


</script>

</body>
</html>
