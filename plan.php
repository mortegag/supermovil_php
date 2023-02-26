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
            padding: 75px 25px;
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

        .carousel-control.right,
        .carousel-control.left {
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
            border-radius: 0 !important;
            transition: box-shadow 0.5s;
        }

        .panel:hover {
            box-shadow: 5px 0px 40px rgba(0, 0, 0, .2);
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

        .navbar li a,
        .navbar .navbar-brand {
            color: #fff !important;
        }

        .navbar-nav li a:hover,
        .navbar-nav li.active a {
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

        .slideanim {
            visibility: hidden;
        }

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

        * {
            box-sizing: border-box;
        }

        ul {
            list-style-type: none;
        }

        body {
            font-family: Verdana, sans-serif;
        }

        .month {
            padding: 70px 25px;
            width: 100%;
            background: #1abc9c;
            text-align: center;
        }

        .month ul {
            margin: 0;
            padding: 0;
        }

        .month ul li {
            color: white;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .month .prev {
            float: left;
            padding-top: 10px;
        }

        .month .next {
            float: right;
            padding-top: 10px;
        }

        .weekdays {
            margin: 0;
            padding: 10px 0;
            background-color: #ddd;
        }

        .weekdays li {
            display: inline-block;
            width: 13.6%;
            color: #666;
            text-align: center;
        }

        .days {
            padding: 10px 0;
            background: #eee;
            margin: 0;
        }

        .days li {
            list-style-type: none;
            display: inline-block;
            width: 13.6%;
            text-align: center;
            margin-bottom: 5px;
            font-size: 12px;
            color: #777;
        }

        .days li .active {
            padding: 5px;
            background: #1abc9c;
            color: white !important
        }

        /* Add media queries for smaller screens */
        @media screen and (max-width:720px) {

            .weekdays li,
            .days li {
                width: 13.1%;
            }
        }

        @media screen and (max-width: 420px) {

            .weekdays li,
            .days li {
                width: 12.5%;
            }

            .days li .active {
                padding: 2px;
            }
        }

        @media screen and (max-width: 290px) {

            .weekdays li,
            .days li {
                width: 12.2%;
            }
        }
    </style>
</head>

<body id="midescuento" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div class="jumbotron text-center">
        <h1>Super Movil App</h1>
        <p>Tecnologia de movilidad interurbana</p>
        <form>
            <div class="input-group">
                <input type="email" class="form-control" size="50" placeholder="Email Address" required>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-danger">Subscribe</button>
                </div>
            </div>
        </form>
    </div>

    <div id="about" class="container-fluid">
        <h3>PLAN DE ACTIVACION Y PROMOCION DEL APLICATIVO SUPER MOVIL....</h3>


        <!-- Container (Portfolio Section) -->
        <div id="portfolio" class="container-fluid bg-grey">

            <pr>

                <div class="container">
                    <P><b>Colaboradores y consejeros</b></P>

                    <p>1. Nicanor Ortega ->taxista Piquera Pacora</p>

                    <p>2. Carlos Morales ->taxista Piquera Bugaba</p>

                    <p>3. Lic. Ramon Tapia</p>

                    <p>4. Lic. Elias Querini</p>

                    <p>5. Ing. Leoncio Ambulo</p>

                </div>

                <div class="container">
                    <p><b>Precio por servicio otros App</b></P>

                    <p>1.Uber ->20% por servicio</P>

                    <p>2. InDrive -> 15-20%</P>

                    <p>3. DiDi -> 15%</P>
                </div>
                <pr>



                    <div class="container">
                        <p></b>Super Movilidad Inter Urbana (SUPER MOVIL)</b></P>

                        <p>Precio por Servicio</P>

                        <p> ·Super Móvil Chofer -> 10-15%</P>
                    </div>
                    <pr>
                        <pr>
                            <div class="container">
                                <h3><b> Plan Piloto de promoción en Chiriquí</b></h3>

                                <p>1. Por Venta del SUPER MOVIL servicio en Piqueras.</p>

                                <p>a. Porcentaje a pagar al colaborador -> 30% por piquera de ganancias por dos meses.
                                </p>

                                <p>b. Porcentaje a pagar al dueño de piquera o gerente ->30%</p>



                                <p>2. Piqueras Virtuales : Creación de piqueras virtuales por el colaborador. </p>

                                <p>a. Porcentaje a pagar al colaborador -> 20% por piquera virtual de ganancias por dos meses.
                                </p>
                            </div>
                            <pr>


                                <div class="container">

                                    <p><b>CASO DE EJMPLO DE PIQUERA: En caso de una piquera que tenga 10 unidades de
                                            taxis y
                                            cada taxi
                                            genere al $20.00 por día .</b></p>
                                </div>
                                <div class="container">
                                    <p><b>CASO COLABORADOR POR PIQUERA</b></p>

                                    <p>1. Al mes (30 días x $20 x 10 taxis ) = $6000.00 total.</p>

                                    <p>2. De los $6000 a 10% por servicios = $600.00</p>

                                    <p>3. Beneficio 30% por pago colaborador por piquera $180 x 4 = $720.00 mas los
                                        servicios de Super
                                        Móvil gratis por el mismo tiempo.</p>
                                </div>
                                <div class="container">
                                    <p><b>CASO COLABORADOR PIQUERA VIRTUAL<b></p>

                                    <p>1. Al mes (30 días x $20 x 10 taxis ) = $6000.00 total.</p>

                                    <p>2. De los $6000 a 10% por servicios = $600.00</p>

                                    <p>3. Beneficio 20% por pago colaborador por piquera VIRTUAL $120 mas los servicios
                                        de Super Móvil gratis.</p>

                                </div>


        </div>
        <div class="container-fluid">
            <h2>Establescamos Metas con fechas de cumplimiento !!!! </h2>
        </div>

        <div class="month">
            <ul>
                <li class="prev">&#10094;</li>
                <li class="next">&#10095;</li>
                <li>
                    Febrero<br>
                    <span style="font-size:18px">2023</span>
                </li>
            </ul>
        </div>

        <ul class="weekdays">
            <li>Mi</li>
            <li>Ju</li>
            <li>Vi</li>
            <li>Sa</li>
            <li>Do</li>
            <li>Lu</li>
            <li>Ma</li>
        </ul>

        <ul class="days">
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>6</li>
            <li>7</li>
            <li>8</li>
            <li>9</li>
            <li>10</li>
            <li>11</li>
            <li>12</li>
            <li><span class="active">13</span></li>
            <li>14</li>
            <li>15</li>
            <li>16</li>
            <li>17</li>
            <li>18</li>
            <li>19</li>
            <li>20</li>
            <li>21</li>
            <li>22</li>
            <li>23</li>
            <li>24</li>
            <li>25</li>
            <li>26</li>
            <li>27</li>
            <li>28</li>

        </ul>

        <footer class="container-fluid text-center">
            <a href="#myPage" title="To Top">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
            <p>SuperMovil@2022 Correo:<a href="#" title="">soporte@supermovilapp.com</a></p>
        </footer>

        <script>
            $(document).ready(function () {

                $(".navbar a, footer a[href='#myPage']").on('click', function (event) {

                    if (this.hash !== "") {

                        event.preventDefault();


                        var hash = this.hash;

                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 900, function () {


                            window.location.hash = hash;
                        });
                    }
                });

                $(window).scroll(function () {
                    $(".slideanim").each(function () {
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