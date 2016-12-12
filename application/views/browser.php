<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
    <script type="text/javascript" src="js/elfinder.min.js"></script>

</head>
<body>

<div>
    <!-- Creo menu -->
    <?php $this->load->view('menu');    ?>
    <!-- Cierro menu -->
</div>
<!-- End of header-->
<div style='height:20px;'></div>
<div>
    <script type="text/javascript" charset="utf-8">
        $().ready(function() {
            var elf = $('#elfinder').elfinder({
                // lang: 'ru',             // language (OPTIONAL)
                url : 'php/connector.php'  // connector URL (REQUIRED)
            }).elfinder('instance');
        });
    </script>

    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder"></div>

</div>
<!-- Beginning footer -->
<div><?php $this->load->view('footer'); ?></div>
<!-- End of Footer -->
</body>