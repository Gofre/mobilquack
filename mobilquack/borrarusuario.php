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

        <!-- Container -->
        <div class="container">
            <div class="row"><!-- Fila -->

                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><!-- Navegador de usuario normal -->
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="main.php">Perfil</a></li>
                        <li><a href="comprauser.php">Reservas</a></li>
                        <li><a href="modificar.php">Modificar Datos</a></li>
                    </ul>
                </div>

            </div>
        </div>

<!-- SI ES USUARIO ES ADMINISTRADOR -->
        <?php
                if($_SESSION['admin']==1) {

                    if(isset($_REQUEST['borrar'])) {

                        $iduser=$_POST['iduser'];

                        // Comprobar que el email introducido se encuentra en la base de datos.
                        $sql2="DELETE usuario FROM usuario WHERE email='".$iduser."' ";
                        $query2=mysqli_query($base, $sql2);
        ?>

        <div class="container">
            <div class="row"><!-- Fila -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Se ha eliminado el usuario.<br/><br/>
                        <a class="btn btn-default" href="borrarusuario.php">Volver</a>
                    </div>
                </div>
            </div><!-- FIN de fila -->
        </div>

        <?php
                    }
                    else {
        ?>

<hr/>
<!-- Container -->
        <div class="container">
            <div class="row"><!-- Fila -->

                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="altabaja.php">Administrar Productos</a></li>
                        <li class="active"><a href="borrarusuario.php">Eliminar Usuarios</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"><!-- Todos los usuarios -->

                    <table class="table table-striped table-hover">
                    <?php

                    $sql="SELECT * FROM usuario";
                    $query=mysqli_query($base, $sql);

                    ?>
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Contraseña</th>
                                <th>DNI</th>
                                <th>Fecha de Nacimiento</th>
                            </tr>
                        </thead>
                    <?php
                    
                    while ($row=mysqli_fetch_assoc($query)) {
                        $email=$row['email'];    
                            
                    ?>
                        <form action="borrarusuario.php" method="POST">
                            <tbody>
                                <tr>
                                    <td><?php echo " ".$row['email']." "; ?></td>
                                    <td><?php echo " ".$row['nombre_u']." "; ?></td>
                                    <td><?php echo " ".$row['apellido']." "; ?></td>
                                    <td><?php echo " ".$row['password']." "; ?></td>
                                    <td><?php echo " ".$row['dni']." "; ?></td>
                                    <td><?php echo " ".$row['fech_nac']." "; ?></td>
                                    <td><input type="hidden" name="iduser" value="<?php echo "$email" ?>"><input class="btn btn-danger btn-sm" type="submit" name="borrar" value="Eliminar Usuario"></td>
                                </tr>
                            </tbody>
                        </form>
                    <?php
                    }
                    ?>
                    </table><br/>
                </div>

            </div><!-- FIN del fila -->
        </div>
<!-- FIN del container -->

<!-- SI NO SE ES ADMINISTRADOR -->
        <?php
                    }
                }
                else {
                        
        ?>

        <div class="container">
            <div class="row"><!-- Fila -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- Aviso de permisos -->
                    <div class="well well-lg">
                        No tienes permisos para acceder a esta página.<br/><br/>
                        <a class="btn btn-default" href="main.php">Volver</a>
                    </div>
                </div>
            </div><!-- FIN de fila -->
        </div>

        <?php
                }
        ?>

<!-- SI NO SE HA INICIADO SESIÓN -->
        <?php

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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- Aviso de no inicio de sesión -->
                    <div class="well well-lg">
                        Debes iniciar sesión para acceder a esta página.<br/><br/>
                        <a class="btn btn-default" href="logout.php">Volver</a>
                    </div>
                </div>
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