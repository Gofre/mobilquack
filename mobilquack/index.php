<?php
    include 'dbacceso.php';
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/estilos.css" rel="stylesheet" type="text/css">
        <title>Mobilquack</title>
    </head>

    <body>
        <?php
            // Se comprueba si se ha iniciado sesión. Si la variable de sesión del email tiene valor, se mostrará lo siguiente.
            if(isset($_SESSION['email'])) {

        ?>

<!-- Barra de navegación -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-phone"></span>Mobilquack</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Inicio<span class="sr-only">(current)</span></a></li>
                        <li><a href="productos.php">Productos</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="main.php"><?php echo $_SESSION['email']; ?></a></li>
                        <li><a href="logout.php">Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<!-- FIN de barra de navegación -->

            <div class="row"><!-- Fila -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- Comienzo del slider -->
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicadores -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Items & Imágenes -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="img/01.png" alt="Phone">
                            </div>

                            <div class="item">
                                <img src="img/02.png" alt="Phone">
                            </div>

                            <div class="item">
                                <img src="img/03.png" alt="Phone">
                            </div>

                            <div class="item">
                                <img src="img/04.png" alt="Phone">
                            </div>
                        </div>

                        <!-- Controles -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div><!-- FIN del slider -->
            </div><!-- FIN del fila -->
<br/>
<!-- SI NO SE HA INICIADO SESIÓN -->
        <?php

            }
            elseif(isset($_POST['login'])) { // Se comprueba si se ha dado click al botón de login y se hayan enviado los datos del formulario.

                $email=htmlentities( addslashes($_POST[('email')]));
                $password=htmlentities( addslashes($_POST[('password')]));
                $newpass=md5($password);

                // "limpiamos" los campos del formulario de posibles códigos maliciosos
                //$email = mysqli_real_escape_string($_POST['email']);
                //$password = mysqli_real_escape_string($_POST['password']);
                                    
                // Comprobar que los datos ingresados en el formulario coinciden con los de la base de datos.
                $sql="SELECT * FROM usuario WHERE email='$email' AND password='$newpass'";
                $query=mysqli_query($base,$sql);

                // Recorrer filas para comprobar los datos.
                if (!$row=mysqli_fetch_assoc($query)) {     // Si los datos no son correctos, se redirige a la misma página de inicio.
                    header("Location: index.php?LoginFallido1");
                    exit();
                }
                else {  // Por otro lado, si los datos son correctos, se envía también a la página de inicio pero los menús cambian para que se pueda acceder a su perfil y modificar sus datos.
                //También se cogen todos sus datos de la base de datos y los introducimos en las variables de sesión.

                    $_SESSION['email']=$row['email'];
                    $_SESSION['nombre']=$row['nombre_u'];
                    $_SESSION['apellido']=$row['apellido'];
                    $_SESSION['password']=$row['password'];
                    $_SESSION['dni']=$row['dni'];
                    $_SESSION['fech_nac']=$row['fech_nac'];
                    $_SESSION['admin']=$row['admin'];
                    header("Location: index.php?LoginCorrecto1");
                        
                    exit();
                }
            }
            else {
        ?>
<!-- Barra de navegación -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-phone"></span>Mobilquack</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Inicio<span class="sr-only">(current)</span></a></li>
                        <li><a href="productos.php">Productos</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="registro.php">Registrar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<!-- FIN de barra de navegación -->

<!-- Container -->
        <div class="container">
            <div class="row"><!-- Fila -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"><!-- Comienzo del slider -->
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicadores -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Items & Imágenes -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="img/01.png" alt="Phone">
                            </div>

                            <div class="item">
                                <img src="img/02.png" alt="Phone">
                            </div>

                            <div class="item">
                                <img src="img/03.png" alt="Phone">
                            </div>

                            <div class="item">
                                <img src="img/04.png" alt="Phone">
                            </div>
                        </div>

                        <!-- Controles -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div><!-- FIN del slider -->

<!-- Formulario de inicio de sesión -->
                <div class="col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="" method="POST">
                        <fieldset>
                            <legend>Login</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-3 control-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-default">Borrar</button>
                                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                                </div>
                                <a class="btn btn-link" href="registro.php">Registrarse</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
<!-- FIN del formulario de inicio de sesión -->

            </div><!-- FIN de fila -->

            <br/>
            <div class="row">
                <div class="jumbotron">
                    <p>¿Todavía no te has registrado? ¡Aprovéchate de los mejores precios!</p>
                    <p><a class="btn btn-primary btn-lg" href="registro.php">Registrarse</a></p>
                </div>
            </div>

        <?php
                }
        ?>

        </div><!-- FIN del container -->

        <?php
            include 'footer.php';
        ?>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>