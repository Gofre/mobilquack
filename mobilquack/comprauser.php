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

                if(isset($_POST['borrar'])) {

                    $email=$_SESSION['email'];
                    $idprod=$_POST['idprod'];

                    $sql2="DELETE compra FROM compra WHERE modelo='".$idprod."' AND email='".$email."' ";
                    $query2=mysqli_query($base, $sql2);
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Se ha eliminado la reserva.<br/><br/>
                        <a class="btn btn-default" href="comprauser.php">Volver</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
                }
                else {

        ?>

<!-- Container -->
        <div class="container">
            <div class="row"><!-- Fila -->

                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><!-- Navegador de usuario normal -->
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="main.php">Perfil</a></li>
                        <li class="active"><a href="comprauser.php">Reservas</a></li>
                        <li><a href="modificar.php">Modificar Datos</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"><!-- Reservas del usuario -->

                    <table class="table table-striped table-hover">
                    <?php

                    $sql="SELECT * FROM compra WHERE email='".$_SESSION['email']."' ";
                    $query=mysqli_query($base, $sql);

                    if(mysqli_num_rows($query) < 1) {
                    ?>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="well well-lg">
                                    No se ha reservado ningún artículo.<br/><br/>
                                </div>
                            </div>
                        </div>
                    </div>
<br/><br/><br/>
                    <?php
                    }
                    else {
                
                    ?>

                        <thead>
                            <tr>
                                <th>Modelo</th>
                            </tr>
                        </thead>
                    <?php
                            
                    while ($row=mysqli_fetch_assoc($query)) {
                        $modelo=$row['modelo'];
                    
                    ?>
                        <form action="comprauser.php" method="POST">
                            <tbody>
                                <tr>
                                    <td><?php echo " ".$row['modelo']." "; ?></td>
                                    <td><input type="hidden" name="idprod" value="<?php echo "$modelo" ?>"><input class="btn btn-danger btn-sm" type="submit" name="borrar" value="Eliminar Reserva"></td>
                                </tr>
                            </tbody>
                        </form>

                    <?php
                    }
                    ?>

                    </table><br/>
                    <?php
                    }
                    ?>
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Debes iniciar sesión para acceder a esta página.<br/><br/>
                        <a class="btn btn-default" href="logout.php">Volver</a>
                    </div>
                </div>
            </div>
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