<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ipasme - Sesion</title>
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/bootstrap-theme.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('./assets/css/estilos.css') ?>">
</head>
<body>
    <!--Navbar bootstrap  -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img id="img_logo" src="<?php echo base_url('./assets/images/logo.png') ?>" alt="Logo" title="Principal"></a>
            </div>

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!--Formulario de inicio de sesion-->
    <div class="container" id="container_sesion">
        <div class="col col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6">
        <?php if(isset($Error)){ ?>
            <div class="alert alert-danger" role="alert">
                <p ><b><?php echo isset($Error) ? $Error : '';?></b></p>
            </div>
        <?php } ?>
            <form action="<?php echo base_url('Sesion/login'); ?>" method="post">
                    <div class="form-group">
                        <input class="form-control input-lg" type="text" name="usuario" id="usuario" autofocus placeholder="Usuario" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control input-lg" type="password" name="clave" id="password" placeholder="Contraseña" required autocomplete="off">
                    </div>
                    <input class="btn btn-primary btn-block input-lg" type="submit" value="Iniciar sesión">
                </form>
        </div>
    </div>
    <!-- Scripts -->
    <script src="<?php echo base_url('./assets/js/jquery-1.12-4.min.js') ?>"></script>
    <script src="<?php echo base_url('./assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>