
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    echo '<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
    echo '<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
    ?>

    <meta charset="utf-8" />
</head>
<body>
<!-- Beginning header -->
<div>
    <!-- Creo menu -->
    <?php
    echo '<nav class="navbar navbar-inverse">';
        echo $_SESSION['navigation'];

    //Boton para salir y nombre
    echo '<ul class="nav navbar-nav navbar-right">';
    echo '<li><a><span class="glyphicon glyphicon-user"></span> '. $_SESSION['nombre']. '</a></li>';
    echo '<li><a href="http://127.0.0.1/CodeIgniter/index.php/home/logout" target="_self"><span class="glyphicon glyphicon-log-out"> </span>Salir</a></li>';
    echo '</ul>';
    echo '</nav>';
    ?>
    <!-- Cierro menu -->
</div>
<!-- End of header-->
<div style='height:20px;'></div>
<div>
    

</div>
<!-- Beginning footer -->
<div>IFTS 19 - 2016</div>
<!-- End of Footer -->
</body>
</html>