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

                // Todo usuario que haya iniciado sesión, va a poder eliminar su cuenta.
                if(isset($_POST['borrar'])) {
                    $sql="DELETE usuario FROM usuario WHERE email='".$_SESSION['email']."' ";
                    $query=mysqli_query($base, $sql);

                    if($query) {
        ?>

        <br/><br/>
        <div class="container">
            <div class="well well-lg">
                Cuenta borrada correctamente.<br/><br/>
                <a class="btn btn-default" href="logout.php">Inicio</a>
            </div>
        </div>

        <?php
                    }
                    else {
        ?>

        <br/><br/>
        <div class="container">
            <div class="well well-lg">
                Ha ocurrido un error y no se borró la cuenta.<br/><br/>
                <a class="btn btn-default" href="main.php">Volver</a>
            </div>
        </div>

        <?php
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
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="productos.php">Productos</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="main.php"><?php echo $_SESSION['email']; ?><span class="sr-only">(current)</span></a></li>
                        <li><a href="logout.php">Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<!-- FIN de barra de navegación -->

<!-- Container -->
        <div class="container">
            <div class="row"><!-- Fila -->

                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><!-- Navegador de usuario normal -->
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="main.php">Perfil</a></li>
                        <li><a href="comprauser.php">Reservas</a></li>
                        <li><a href="modificar.php">Modificar Datos</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12"><!-- Perfil de usuario -->

                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Nombre</th>
                                <td><?php echo $_SESSION['nombre']; ?></td>
                            </tr>
                            <tr>
                                <th>Apellido</th>
                                <td><?php echo $_SESSION['apellido']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $_SESSION['email']; ?></td>
                            </tr>
                            <tr>
                                <th>DNI</th>
                                <td><?php echo $_SESSION['dni']; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de Nacimiento</th>
                                <td><?php echo $_SESSION['fech_nac']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <form method="POST">
                        <button type="submit" class="btn btn-danger" name="borrar">Eliminar Cuenta</button>
                    </form>
                </div>

            </div><!-- FIN de fila -->
        </div>

<!-- SI ES USUARIO ES ADMINISTRADOR -->
        <?php
                    if($_SESSION['admin']==1) {
        ?>
<hr/>
        <div class="container">
            <div class="row"><!-- Fila -->
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="altabaja.php">Administrar Productos</a></li>
                        <li><a href="borrarusuario.php">Eliminar Usuarios</a></li>
                    </ul>
                </div>
            </div><!-- FIN del fila -->
        </div>
<!-- FIN del container -->

        <?php
                    }
                    else {
                        //echo "Usuario normal";
                        //echo "<br/><br/>";
                    }
        ?>

<!-- SI NO SE HA INICIADO SESIÓN -->
        <?php
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
                        <li><a href="index.php">Inicio</a></li>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- Comienzo del slider -->
                    <div class="well well-lg">
                        Debes iniciar sesión para acceder a esta página.<br/><br/>
                        <a class="btn btn-default" href="logout.php">Volver</a>
                    </div>
                </div><!-- FIN del slider -->
            </div><!-- FIN de fila -->
        </div>
<!-- FIN del container -->

        <?php
                }
        ?>

        <?php
            include 'footer.php';
        ?>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>