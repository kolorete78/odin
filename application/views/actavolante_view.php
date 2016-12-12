<!DOCTYPE html>
<html lang="en" xmlns:text-align="http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style-form-final.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <title>Acta Volante</title>

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
                        url:"<?php echo base_url();?>index.php/Actavolante/dropfechas",
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

                var carrera = $("#Carrera").find("option:selected").text();
                var fecha = document.getElementById("fecha").value;
                var materia_id = document.getElementById("Materias").value;
                var materia_nombre= $("#Materias").find("option:selected").text();
                var cuatrimestre=$("#cuatrimestre").find("option:selected").text();
                var comision=$("#comision").find("option:selected").text();
                var ano=document.getElementById("ano").value;
                var profesores=$("#Profesores").find("option:selected").text();
                var data = {
                   materia_id, materia_nombre , fecha, carrera, cuatrimestre, comision, ano, profesores
                           };


               $.get("<?php echo base_url();?>index.php/actavolante/generar",data, function (resp) {
                  // alert(resp);
                    location.reload();
                    
                })

            }


        </script>




</head>
<body>
<!-- Beginning header -->
<div>
    <!-- Creo menu -->
    <?php $this->load->view('menu');    ?>
    <!-- Cierro menu -->
</div>
<!-- End of header-->
<div style='height:20px;'></div>
<div style='height:40px;text-align: center'; '>
    <?php echo form_label("Carrera: "), form_dropdown('selCarrera', $arrCarrera,'','id="Carrera"');?>
</div>
<div style='height:40px;text-align: center'; '>
    <?php echo form_label("Materia: "),form_dropdown('selMaterias', $arrMaterias,'','id="Materias"'); ?>
</div>
<div style='height:40px;text-align: center'; '>
    <?php echo form_label("Profesores: "), form_dropdown('selProfesores', $arrprofesores,'','id="Profesores"');?>
</div>
<div style='height:40px;text-align: center'; '>
    <label>Fecha: </label>
    <select name="selfecha" id="fecha"> <option value="">Seleccionar</option></select>
</div>

<div style='height:40px;text-align: center'; '>
    <label>Cuatrimestre: </label>
    <select name="cuatrimestre" id="cuatrimestre">
        <option value="1">1er Cuatrimestre</option>
        <option value="2">2do Cuatrimestre</option>
        <option value="3">Anual</option>
     </select>
</div>

<div style='height:40px;text-align: center'; '>
<label>Año de la carrera: </label>
<select name="ano" id="ano">
    <option value="primer">Primer</option>
    <option value="segundo">Segundo</option>
    <option value="tercer">Tercer</option>
</select>
</div>

<div style='height:40px;text-align: center'; '>
        <label>Comision: </label>
        <select name="comision" id="comision">
            <option value="1">A</option>
            <option value="2">B</option>

    </select>
</div>

    <div style="text-align: center">
        <input id="form_button" type="button" value="Continuar" onclick="inscribirse();" />
    </div>


</div>
<!-- Beginning footer -->
<div><?php $this->load->view('footer'); ?></div>
<!-- End of Footer -->
</body>