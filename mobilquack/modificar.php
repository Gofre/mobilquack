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

        <?php

                if(isset($_REQUEST['guardar'])) {

                    $email=$_SESSION["email"];//=$_POST[('email')];
                    $nombre=$_SESSION["nombre"];//=$_POST[('nombre')];
                    $apellido=$_SESSION["apellido"];//=$_POST[('apellido')];
                    $password=$_SESSION["password"];//=$_POST[('password')];
                    $dni=$_SESSION["dni"];//=$_POST[('dni')];
                    $fech_nac=$_SESSION["fech_nac"];//=$_POST[('fech_nac')];

                    $cambioemail=htmlentities( addslashes($_POST[('cambioemail')]));
                    $cambionombre=htmlentities( addslashes($_POST[('cambionombre')]));
                    $cambioapellido=htmlentities( addslashes($_POST[('cambioapellido')]));
                    $cambiopassword=htmlentities( addslashes($_POST[('cambiopassword')]));
                    $cambiodni=htmlentities( addslashes($_POST[('cambiodni')]));
                    $cambiofech_nac=htmlentities( addslashes($_POST[('cambiofech_nac')]));

                    // Comprobar que los datos introducidos no sean iguales a los ya registrados.
                    $sql="SELECT * FROM usuario WHERE email='".$cambioemail."' ";
                    $query=mysqli_query($base, $sql);

                    if(mysqli_num_rows($query) > 0) {
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Este email ya ha sido registrado.<br/><br/>
                        <a class="btn btn-default" href="modificar.php">Reintentar</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
                    }
                    else {
                        $newpass = md5($cambiopassword); // encriptamos la contraseña ingresada con md5
                        // ingresamos los datos a la BD
                        $sql2="UPDATE usuario SET email='$cambioemail', nombre_u='$cambionombre', apellido='$cambioapellido', password='$newpass', dni='$cambiodni', fech_nac='$cambiofech_nac' WHERE email='$email' ";
                        $reg=mysqli_query($base, $sql2);

                        if($reg) {
                            $_SESSION["email"]=$_POST[('cambioemail')];
                            $_SESSION["nombre"]=$_POST[('cambionombre')];
                            $_SESSION["apellido"]=$_POST[('cambioapellido')];
                            $_SESSION["password"]=$newpass;
                            $_SESSION["dni"]=$_POST[('cambiodni')];
                            $_SESSION["fech_nac"]=$_POST[('cambiofech_nac')];
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Datos modificados correctamente.<br/><br/>
                        <a class="btn btn-default" href="main.php">Inicio</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
                        }
                        else {
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Error en los datos introducidos. No se registraron los datos.<br/><br/>
                        <a class="btn btn-default" href="modificar.php">Volver</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
                        }
                    }
                }
                else {
        ?> 

<!-- Container -->
        <div class="container">
            <div class="row"><!-- Fila -->

                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><!-- Navegador de usuario normal -->
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="main.php">Perfil</a></li>
                        <li><a href="comprauser.php">Reservas</a></li>
                        <li class="active"><a href="modificar.php">Modificar Datos</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12"><!-- Formulario para modificar datos -->

                    <form class="form-horizontal" action="modificar.php" method="POST">
                        <fieldset>
                            <legend>Modificar Datos</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" name="cambioemail" class="form-control" id="inputEmail" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNombre" class="col-lg-2 control-label">Nombre</label>
                                <div class="col-lg-10">
                                    <input type="text" name="cambionombre" class="form-control" id="inputNombre" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputApellido" class="col-lg-2 control-label">Apellido</label>
                                <div class="col-lg-10">
                                    <input type="text" name="cambioapellido" class="form-control" id="inputApellido" placeholder="Apellido" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Contraseña</label>
                                <div class="col-lg-10">
                                    <input type="password" name="cambiopassword" class="form-control" id="inputPassword" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDNI" class="col-lg-2 control-label">DNI</label>
                                <div class="col-lg-10">
                                    <input type="text" name="cambiodni" class="form-control" id="inputDNI" placeholder="DNI" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFech_nac" class="col-lg-2 control-label">Fecha de Nacimiento</label>
                                <div class="col-lg-10">
                                    <input type="date" name="cambiofech_nac" class="form-control" id="inputFech_nac" placeholder="Fecha" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="guardar" class="btn btn-primary">Guardar Datos</button>
                                    <button type="reset" class="btn btn-default">Vaciar</button>
                                </div>
                            </div>
                        </fieldset>
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