<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" value="text/html; charset=UTF-8" />
</head>
    <body>
        <div class="container">

            <form class="form-horizontal well" method="post" id="form" action=<?php echo base_url()?>index.php/forgotpassword/doforget>
                <fieldset>
                    <legend>Blanqueo de contraseña</legend>

                    <div class="control-group">
                        <label for="email"> Email</label>
                        <input class="box" type="text" id="email" name="email" />
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Resetear" />
                    </div>
                    <?php if( isset($info)): ?>
                        <div class="alert alert-success">
                            <?php echo($info) . '<a href='.base_url().'index.php/login/#>Login</a>'; ?>

                        </div>
                    <?php elseif( isset($error)): ?>
                            <div class="alert alert-error">
                            <?php echo($error) ?>
                            </div>
                        <?php endif; ?>

                </fieldset>
            </form>
        </div>
    </body>
</html>