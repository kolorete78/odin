<!DOCTYPE html>
<html lang="en">
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

            function generar()
                {
                    var x=window.open();
                    x.document.open();
                    x.document.write('content');
                    x.document.close();
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
<div>
    <?php echo form_label("Carrera: "), form_dropdown('selCarrera', $arrCarrera,'','id="Carrera"');?>
    <?php echo form_label("Materia: "),form_dropdown('selMaterias', $arrMaterias,'','id="Materias"'); ?>
    <select name="selfecha" id="fecha"> <option value="">Seleccionar</option></select>
    <div style="text-align: center">
        <input id="form_button" type="button" value="Continuar" onclick="generar();" />
    </div>


</div>
<!-- Beginning footer -->
<div><?php $this->load->view('footer'); ?></div>
<!-- End of Footer -->
</body>