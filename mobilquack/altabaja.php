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

                    if(isset($_REQUEST['crear'])) {

                        $modelo=htmlentities( addslashes($_POST[('modelo')]));
                        $marca=htmlentities( addslashes($_POST[('marca')]));
                        $s_o=htmlentities( addslashes($_POST[('s_o')]));
                        $precio=htmlentities( addslashes($_POST[('precio')]));

                        // Comprobar que el producto no se encuentra en la base de datos.
                        $sql="SELECT * FROM producto WHERE modelo='".$modelo."' ";
                        $query=mysqli_query($base, $sql);

                        if(mysqli_num_rows($query) > 0) {
                            echo "Error al crear producto. <a href='javascript:history.back();'>Reintentar</a>";
                        }
                        else {
                            // ingresamos los datos a la BD
                            $sql2="INSERT INTO producto VALUES ('$modelo', '$marca', '$s_o', '$precio')";
                            $reg=mysqli_query($base, $sql2);

                            if($reg) {
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Producto creado correctamente.<br/><br/>
                        <a class="btn btn-default" href="altabaja.php">Volver</a>
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
                        Ha ocurrido un error y no se creó el producto.<br/><br/>
                        <a class="btn btn-default" href="altabaja.php">Volver</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
                            }
                        }
                    }
                    elseif (isset($_REQUEST['borrar'])) {

                        $idprod=$_POST['idprod'];

                        // Comprobar que el producto se encuentra en la base de datos.
                        $sql2="DELETE producto FROM producto WHERE modelo='".$idprod."' ";
                        $query2=mysqli_query($base, $sql2);
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="well well-lg">
                        Se ha eliminado el producto.<br/><br/>
                        <a class="btn btn-default" href="altabaja.php">Volver</a>
                    </div>
                </div>
            </div>
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
                        <li class="active"><a href="altabaja.php">Administrar Productos</a></li>
                        <li><a href="borrarusuario.php">Eliminar Usuarios</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"><!-- Todos los Productos -->

                    <table class="table table-striped table-hover">
                    <?php

                    $sql="SELECT * FROM producto";
                    $query=mysqli_query($base, $sql);
                
                    ?>

                        <thead>
                            <tr>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>SO</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                    <?php
                            
                    while ($row=mysqli_fetch_assoc($query)) {
                        $modelo=$row['modelo'];
                
                    ?>
                        <form action="altabaja.php" method="POST">
                            <tbody>
                                <tr>
                                    <td><?php echo " ".$row['modelo']." "; ?></td>
                                    <td><?php echo " ".$row['marca']." "; ?></td>
                                    <td><?php echo " ".$row['s_o']." "; ?></td>
                                    <td><?php echo " ".$row['precio']."€ "; ?></td>
                                    <td><input type="hidden" name="idprod" value="<?php echo "$modelo" ?>"><input class="btn btn-danger btn-sm" type="submit" name="borrar" value="Eliminar Producto"></td>
                                </tr>
                            </tbody>
                        </form>
                    <?php
                    }
                    ?>
                    </table><br/>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="altabaja.php" method="POST">
                        <fieldset>
                            <legend>Añadir Producto</legend>
                            <div class="form-group">
                                <label for="inputModelo" class="col-lg-2 control-label">Modelo</label>
                                <div class="col-lg-10">
                                    <input type="text" name="modelo" class="form-control" id="inputModelo" placeholder="Modelo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputMarca" class="col-lg-2 control-label">Marca</label>
                                <div class="col-lg-10">
                                    <input type="text" name="marca" class="form-control" id="inputMarca" placeholder="Marca" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSO" class="col-lg-2 control-label">Sistema Operativo</label>
                                <div class="col-lg-10">
                                    <input type="text" name="s_o" class="form-control" id="inputSO" placeholder="SO" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPrecio" class="col-lg-2 control-label">Precio</label>
                                <div class="col-lg-10">
                                    <input type="number" name="precio" class="form-control" id="inputPrecio" placeholder="Precio" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="crear" class="btn btn-primary">Añadir Producto</button>
                                    <button type="reset" class="btn btn-default">Vaciar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

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
