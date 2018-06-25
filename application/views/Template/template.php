<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Control de Asistencia</title>
    
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <link href="<?php echo base_url(); ?>assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/lib/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/helper.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>

<body class="fix-header fix-sidebar">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header hidden-xs">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>portada">
                        <b><img src="<?php echo base_url(); ?>assets/images/Logo-SENATICs-SM-oscuro.png" alt="SENATICs" class="dark-logo" style="max-width:210px; width:100%;" /></b>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <h3 class="text-muted m-t-0 hidden-xs m-l-10">Control de Asistencia</h3>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user m-r-5"></i><?php echo $this->user_indicadores['usuario']; ?></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label"></li>
                        <li> 
                            <a class="has-arrow" href="<?php echo base_url(); ?>portada" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Portada</span></a>
                        </li>
                        <li class="nav-label">Indicadores</li>
                        <li>
                            <a class="has-arrow" href="<?php echo base_url(); ?>mis_indicadores" aria-expanded="false">
                                <i class='ti-bag'></i>
                                <span class="hide-menu">Mis indicadores 
                                    <?php if(isset($cant_mis_indicadores) && $cant_mis_indicadores){ ?>
                                        <span class="label label-rouded label-success pull-right"><?php echo $cant_mis_indicadores; ?></span>
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="has-arrow" href="<?php echo base_url(); ?>indicadores" aria-expanded="false">
                                <i class="fa fa-chart-pie"></i>
                                <span class="hide-menu">Todos los indicadores</span>
                            </a>
                        </li>
                        <?php if($super_admin){ ?>                        
                        <hr>
                        <li>
                            <a class="has-arrow" href="<?php echo base_url(); ?>agregar_indicador" aria-expanded="false">
                                <i class="fa fa-plus"></i>
                                <span class="hide-menu color-success f-700"><b>Agregar indicador</b></span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/lib/morris-chart/raphael-min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/lib/morris-chart/morris.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/lib/morris-chart/dashboard1-init.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/lib/morris-chart/morris-init.js"></script>

                <?php $this->load->view($content); ?> 
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/datatables/datatables-init.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/lib/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/sweetalert/sweetalert.init.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/lib/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/toastr/toastr.init.js"></script>

	<script src="<?php echo base_url(); ?>assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/calendar-2/semantic.ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/calendar-2/prism.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/calendar-2/pignose.init.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
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