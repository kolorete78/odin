<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style-form-final.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

       <title>Inscribirse a Finales</title>

    <form action="#" method="post">
        <script type="text/javascript"
            src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#Materias").change(function(){
                            $("#fecha > option").remove(); //borramos los anteriores

                            /*dropdown post *///
                                $.ajax({
                                url:"<?php echo base_url();?>index.php/Inscfinales/dropfechas",
                                    data: {id:
                                    $(this).val()},
                                    type: "POST",
                                    success:function(data){
                                    $("#fecha").html(data);
                    }
                });
            });
        });
         </script>

        <script type="text/javascript">

            function inscribirse(){

                document.getElementById('form_button').style.visibility='hidden';
                var fecha = document.getElementById("fecha").value;

                var data = {
                    materia_id : document.getElementById("Materias").value, fecha
                };

               $.get("<?php echo base_url();?>index.php/Inscfinales/grabar",data, function (resp) {
                    alert(resp);
                    location.reload();
                })

            }


        </script>



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
<div style='height:30px;'></div>
<div style="text-align: center">
    <p><strong>Esta inscripción reviste caracter de declaración jurada</strong></p>
    <p>Por disposición no se puede inscribir en dos asignaturas en la misma fecha</p>
    <p>Ante cualquier duda presentarse en <strong>Bedelia</strong> junto con libreta de estudiantes</p>
</div>
<div style='height:30px;'></div>
<div style="text-align: center">
<?php echo form_label("Materia: "),form_dropdown('selMaterias', $arrMaterias,'','id="Materias"'); ?>
<br />
</div>
<div style='height:30px;'></div>
<div style="text-align: center">
<label>Fecha: </label>
<select name="selfecha" id="fecha"> <option value="">Seleccionar</option></select>
<br />
    <div style='height:30px;'></div>
    <div style="text-align: center">
        <input id="form_button" type="button" value="Continuar"  onclick="inscribirse();" />
    </div>




<!-- Beginning footer -->
<?php $this->load->view('footer'); ?>
<!-- End of Footer -->


