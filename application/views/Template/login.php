<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title><?php echo $titulo; ?></title>
    <link href="<?php echo base_url(); ?>assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/lib/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/helper.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
		</svg>
    </div>

	<div id="main-wrapper">
        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
								<img src="<?php echo base_url(); ?>assets/images/Logo-SENATICs-SM-oscuro.png" style="width: 100%; margin-bottom:20px;">

                                <h4>Iniciar sesión</h4>
                                <?php echo form_open('login'); ?>
                                    <div class="form-group <?php if(form_error('usuario')){ echo 'has-error';} ?>">
                                        <label>Usuario</label>
                                        <input type="text" name="usuario" class="form-control" value="<?php echo set_value('usuario'); ?>" placeholder="Usuario sin el '@senatics.gov.py'">
                                        <?php echo form_error('usuario'); ?>
                                    </div>
                                    <div class="form-group <?php if(form_error('contrasena')){ echo 'has-error';} ?>">
                                        <label>Contraseña</label>
                                        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña de correo institucional">
                                        <?php echo form_error('contrasena'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Ingresar</button>
								<?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/lib/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/toastr/toastr.init.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>

    <script>
        $(document).ready(function(){
            <?php echo $this->mensaje; ?>

            function notify(titulo, mensaje, tipo){
                if(tipo == "success"){
                    toastr.success(mensaje,titulo,{
                        "positionClass": "toast-top-right",
                        "timeOut": 5000,
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "tapToDismiss": false
                    })
                }
                if(tipo == "info"){
                    toastr.info(mensaje,titulo,{
                        "positionClass": "toast-top-right",
                        "timeOut": 5000,
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "tapToDismiss": false
                    })
                }
                if(tipo == "error"){
                    toastr.error(mensaje,titulo,{
                        "positionClass": "toast-top-right",
                        "timeOut": 5000,
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "tapToDismiss": false
                    })
                }
                
            }
        });
    </script>
</body>
</html>