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
                        <li class="active"><a href="registro.php">Registrar<span class="sr-only">(current)</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
<!-- FIN de barra de navegación -->

            <?php

                if(isset($_REQUEST['registrar'])) { // comprobamos que se han enviado los datos desde el formulario

                    $email=htmlentities( addslashes($_POST[('email')]));
                    $nombre=htmlentities( addslashes($_POST[('nombre')]));
                    $apellido=htmlentities( addslashes($_POST[('apellido')]));
                    $password=htmlentities( addslashes($_POST[('password')]));
                    $dni=htmlentities( addslashes($_POST[('dni')]));
                    $fech_nac=htmlentities( addslashes($_POST[('fech_nac')]));
                            
                    // comprobamos que el email ingresado no haya sido registrado antes
                    $sql=mysqli_query($base, "SELECT email FROM usuario WHERE email='".$email."'");
                    if(mysqli_num_rows($sql) > 0) {
                        echo "Este email ya ha sido registrado. <a href='javascript:history.back();'>Reintentar</a>";
                    }
                    else {
                        $newpass = md5($password); // encriptamos la contraseña ingresada con md5
                        // ingresamos los datos a la BD
                        $query="INSERT INTO usuario VALUES ('$email', '$nombre', '$apellido', '$newpass', '$dni', '$fech_nac', '0')";
                        $reg=mysqli_query($base, $query);

                        if($reg) {
            ?>
            <!-- Indicador de que la sentencia ha funcionado -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="well well-lg">
                            Datos ingresados correctamente.<br/><br/>
                            <a class="btn btn-default" href="index.php">Inicio</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                        }
                        else {
            ?>
            <!-- Aviso de que ha habido un error -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="well well-lg">
                            Ha ocurrido un error y no se registraron los datos.<br/><br/>
                            <a class="btn btn-default" href="registro.php">Volver</a>
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

<!-- Formulario de registro -->
                <form class="form-horizontal" action="registro.php" method="POST">
                    <fieldset>
                        <legend>Registrar</legend>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputEmail" placeholder="Email" type="email" name="email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Nombre</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputNombre" placeholder="Nombre" type="text" name="nombre">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Apellido</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputApellido" placeholder="Apellido" type="text" name="apellido">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">DNI</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputDNI" placeholder="DNI" type="text" name="dni" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Fecha de Nacimiento</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputFecha" placeholder="dd/mm/aa" type="date" name="fech_nac">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
                                <button type="reset" class="btn btn-danger">Borrar</button>
                            </div>
                        </div>
                    </fieldset>
                </form><!-- FIN de formulario de registro -->
            </div><!-- FIN de fila -->
        </div>
<!-- FIN de container -->

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