
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/footer-distributed-with-address-and-phones.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">



  <?php
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
  <?php
        echo '<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
        echo '<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
  ?>


    <?php endforeach; ?>
    <?php foreach($js_files as $file): ?>

        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

    <style type='text/css'>
        body
        {
            font-family: Arial;
            font-size: 14px;
        }
        a {
            color: blue;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover
        {
            text-decoration: underline;
        }
    </style>


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
    echo '<li><a href=' . site_url('usuario') . '><span class="glyphicon glyphicon-user"></span> '. $_SESSION['nombre']. '</a></li>';
    echo '<li><a href=' . site_url('home/logout') . '><span class="glyphicon glyphicon-log-out"> </span>Salir</a></li>';
    echo '</ul>';
    echo '</nav>';
    ?>
    <!-- Cierro menu -->
</div>
<!-- End of header-->
<div style='height:20px;'></div>
<div>
    <?php echo $output; ?>

</div>
<!-- Beginning footer -->
<div><?php $this->load->view('footer'); ?></div>
<!-- End of Footer -->
</body>
