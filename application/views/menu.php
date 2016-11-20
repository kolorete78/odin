<?php
    echo '<nav class="navbar navbar-inverse">';
    echo $_SESSION['navigation'];

    //Boton para salir y nombre
    echo '<ul class="nav navbar-nav navbar-right">';
        echo '<li><a href=' . site_url('usuario') . '><span class="glyphicon glyphicon-user"></span> '. $_SESSION['nombre']. '</a></li>';
        echo '<li><a href=' . site_url('home/logout') . '><span class="glyphicon glyphicon-log-out"> </span>Salir</a></li>';
        echo '</ul>';
    echo '</nav>';
?>