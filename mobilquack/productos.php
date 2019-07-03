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
                        <li class="active"><a href="productos.php">Productos<span class="sr-only">(current)</span></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="main.php"><?php echo $_SESSION['email']; ?></a></li>
                        <li><a href="logout.php">Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<!-- FIN de barra de navegación -->

        <?php

                if(isset($_POST['comprar'])) {

                    $email=$_SESSION['email'];
                    $idprod=$_POST['idprod'];

                    $sql2="INSERT INTO compra VALUES ('$email', '$idprod')";
                    $query2=mysqli_query($base, $sql2);
        ?>

        <div class="container">
            <div class="row"><!-- Fila -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- Comienzo del slider -->
                    <div class="well well-lg">
                        Se ha reservado el producto.<br/><br/>
                        <a class="btn btn-default" href="productos.php">Volver</a>
                    </div>
                </div>
            </div><!-- FIN de fila -->
        </div>

        <?php
                }
                else {

        ?>

<!-- Container -->
        <div class="container">
            <div class="row"><!-- Fila -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- Productos a la venta -->

                    <table class="table table-striped table-hover">
                    <?php

                    $sql="SELECT * FROM producto";
                    $query=mysqli_query($base, $sql);
                
                    ?>
                        <thead>
                            <tr>
                                <th></th>
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
                        <form action="productos.php" method="POST">
                            <tbody>
                                <tr>
                                    <td><?php echo " ".$row['modelo']." "; ?></td>
                                    <td><?php echo " ".$row['marca']." "; ?></td>
                                    <td><?php echo " ".$row['s_o']." "; ?></td>
                                    <td><?php echo " ".$row['precio']."€ "; ?></td>
                                    <td><input type="hidden" name="idprod" value="<?php echo "$modelo" ?>"><input class="btn btn-success" type="submit" name="comprar" value="Comprar"></td>
                                </tr>
                            </tbody>
                        </form>

                    <?php
                    }
                    ?>

                    </table><br/>

                </div><!-- FIN de los productos -->
            </div><!-- FIN del fila -->
        </div>
<!-- FIN del container -->

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
                        <li class="active"><a href="productos.php">Productos<span class="sr-only">(current)</span></a></li>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- Comienzo de los productos -->
                    
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>SO</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <?php
                            $sql="SELECT * FROM producto";
                            $query=mysqli_query($base, $sql);
                            while ($consulta=mysqli_fetch_assoc($query)) {
                
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo " ".$consulta['modelo']." "; ?></td>
                                <td><?php echo " ".$consulta['marca']." "; ?></td>
                                <td><?php echo " ".$consulta['s_o']." "; ?></td>
                                <td><?php echo " ".$consulta['precio']."€ "; ?></td>
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>
                    </table><br/>

                </div><!-- FIN de los productos -->
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