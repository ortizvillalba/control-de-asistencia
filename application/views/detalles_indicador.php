
<?php if($detalles_indicador){ ?>
    <?php foreach ($detalles_indicador as $indicador) { ?>
        <ol class="breadcrumb m-t-15">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>indicadores">Indicadores</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>"><?php echo $indicador['indicador_desc']; ?></a></li>
        </ol>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        
                            <h3><?php echo $indicador['indicador_desc']; ?></h3>
                            
                            <div class="desc">
                                    
                                <div class="table-responsive">
                                    <table class="table" style="text-align: left;">
                                        <tbody>
                                            <tr>
                                                <td><b>ID indicador</b></td>
                                                <td style="text-align: left;"><?php echo $indicador['id_indicador']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Actualización</b></td>
                                                <td style="text-align: left;"><?php echo $indicador['frecuencia']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Unidad de medida</b></td>
                                                <td style="text-align: left;"><span class="badge badge-primary" style="padding:8px; margin:1px;"><?php echo $indicador['unidad_medida']; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><b>Responsable(s)</b></td>
                                                <td style="text-align: left;">
                                                    <?php $responsables = trim($indicador['responsables']) ?>
                                                    <?php $responsables = explode(" ", $responsables); ?>
                                                    <?php if($responsables){ ?>
                                                        <?php foreach ($responsables as $responsable) { ?>
                                                            <?php if(substr_count($responsable, $this->user_indicadores['usuario']) > 0){ ?>
                                                                <p><b><i class="fa fa-arrow-right m-r-5"></i><?php echo $responsable; ?></b></p>
                                                            <?php }else{ ?>
                                                                <p><?php echo $responsable; ?></p>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Actualizado en el mes</b></td>
                                                <td style="text-align: left;">
                                                    <?php if($listado_indicadores_estado){ ?>
                                                        <?php foreach ($listado_indicadores_estado as $indicador_estado) { ?>
                                                            <?php if($indicador_estado['estado']){ ?>
                                                                <span class="badge badge-success p-15" style="color:#FFF;"><i class="fa fa-check m-r-5"></i>Actualizado</span>
                                                            <?php }else{ ?>
                                                                <span class="badge badge-danger p-15" style="color:#FFF;"><i class="fa fa-close m-r-5"></i>Pendiente</span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger p-15" style="color:#FFF;"><i class="fa fa-close m-r-5"></i>Pendiente</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Cantidades</b></td>
                                                <td style="text-align: left;">
                                                    <p class="m-0"><b>Total:</b> <span class="badge badge-primary" style="padding:12px; margin:1px; font-size:14px; font-weight:bold;"><?php echo number_format($indicador['cantidad_total'], 0, ',', '.'); ?></span></p>
                                                    <p class="m-0">Hombres: <span class="badge badge-info" style="padding:8px; margin:1px;"><?php echo $indicador['cantidad_hombres_total']; ?></span></p>
                                                    <p class="m-0">Mujres: <span class="badge badge-danger" style="padding:8px; margin:1px;"><?php echo $indicador['cantidad_mujeres_total']; ?></span></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <?php if($indicador['cantidad_hombres_total'] || $indicador['cantidad_mujeres_total']){ ?>
                                    <div id="morris-donut-chart-sexo"></div>
                                    <script>
                                        Morris.Donut( {
                                            element: 'morris-donut-chart-sexo',
                                            data: [ {
                                                label: "Hombres",
                                                value: <?php echo $indicador['cantidad_hombres_total']; ?>,
                                            }, {
                                                label: "Mujeres",
                                                value: <?php echo $indicador['cantidad_mujeres_total']; ?>
                                            }],
                                            resize: true,
                                            colors: ['#4680ff', '#fc6180' ]
                                        } );
                                    </script>
                                <?php } ?>
                                
                            <?php if($super_admin){ ?>
                                <a href="<?php echo base_url(); ?>editar_indicador/<?php echo $indicador['id_indicador']; ?>" class="btn btn-inverse btn-flat btn-addon m-b-10 m-r-5"><i class="fa fa-edit"></i>Editar indicador</a>
                            <?php } ?>
                            <?php if(substr_count($indicador['responsables'], $this->user_indicadores['usuario']) > 0){ ?>
                                <a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>/agregar" class="btn btn-success btn-flat btn-addon m-b-10 m-r-5"><i class="fa fa-plus m-r-5"></i>Agregar nuevo valor</a>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <?php if(count($grafico_detalle_evolucion) > 1){ ?>
                            <ul class="nav nav-tabs m-b-30" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tabla" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Registros</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#estadistica" role="tab" onclick="visual_estadistica()"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Estadísticas</span></a> </li>
                            </ul>
                        <?php } ?>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabla" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="hidden">#</th>
                                                <th>Año</th>
                                                <th>Mes</th>
                                                <th>Cantidades</th>
                                                <th>Fuente de verificación</th>
                                                <th>Observación</th>
                                                <?php if(substr_count($indicador['responsables'], $this->user_indicadores['usuario']) > 0){ ?>
                                                    <th>Opciones</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($listado_evolucion){ ?>
                                                <?php foreach($listado_evolucion as $evolucion){ ?>
                                                    <tr>
                                                        <td class="hidden"><?php echo $evolucion['id_evolucion']; ?></td>
                                                        <td><?php echo $evolucion['anho']; ?></td>
                                                        <td><?php echo $evolucion['mes']; ?></td>
                                                        <td>
                                                            <p class="m-0">Total: <?php echo $evolucion['cantidad']; ?></p>
                                                            <p class="m-0">Hombres: <?php echo $evolucion['masc']; ?></p>
                                                            <p class="m-0">Mujeres: <?php echo $evolucion['fem']; ?></p>
                                                        </td>
                                                        <td><?php echo $evolucion['fuente_verificacion']; ?></td>
                                                        <td><?php echo $evolucion['observacion']; ?></td>
                                                        <?php if(substr_count($indicador['responsables'], $this->user_indicadores['usuario']) > 0){ ?>
                                                            <td>
                                                                <a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>/editar/<?php echo $evolucion['id_evolucion']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <style>
                                .visual_estadistica{
                                    visibility: hidden;
                                    height: 0;
                                }
                            </style>
                            <script>
                                function visual_estadistica(){
                                    $('.visual_estadistica').removeClass('visual_estadistica');
                                }
                            </script>
                            <div class="tab-pane active visual_estadistica" id="estadistica" role="tabpanel">
                                <h2 class="color-primary">Cantidades totales por año</h2>
                                <div id="morris-area-chart"></div>
                                <script>
                                    Morris.Area( {
                                        element: 'morris-area-chart',
                                        data: [ 
                                            <?php if($grafico_detalle_evolucion){ ?>
                                                <?php foreach ($grafico_detalle_evolucion as $evo) {  ?>
                                                    {
                                                        periodo: '<?php echo $evo['anho']; ?>',
                                                        total: <?php echo $evo['cantidad_total']; ?>
                                                    },
                                                <?php } ?>
                                            <?php } ?>
                                        ],
                                        xkey: 'periodo',
                                        ykeys: [ 'total' ],
                                        labels: [ 'Total' ],
                                        pointSize: 3,
                                        fillOpacity: 0,
                                        pointStrokeColors: [ '#26DAD2', '#4680ff', '#fc6180' ],
                                        behaveLikeLine: true,
                                        gridLineColor: '#e0e0e0',
                                        lineWidth: 3,
                                        hideHover: 'auto',
                                        lineColors: [ '#26DAD2', '#4680ff', '#fc6180' ],
                                        resize: true

                                    } );
                                </script>
                                <hr>
                                <?php if($indicador['cantidad_hombres_total'] || $indicador['cantidad_mujeres_total']){ ?>
                                    <h2 class="color-primary">Discriminado por sexo</h2>
                                    <div id="morris-bar-chart-sexo"></div>
                                    <script>
                                        Morris.Bar( {
                                            element: 'morris-bar-chart-sexo',
                                            data: [ 
                                                <?php if($grafico_detalle_evolucion){ ?>
                                                    <?php foreach ($grafico_detalle_evolucion as $evo) {  ?>
                                                        {
                                                            periodo: '<?php echo $evo['anho']; ?>',
                                                            hombres: <?php echo $evo['cantidad_hombres_total']; ?>,
                                                            mujeres: <?php echo $evo['cantidad_mujeres_total']; ?>
                                                        },
                                                    <?php } ?>
                                                <?php } ?>
                                            ],
                                            xkey: 'periodo',
                                            ykeys: [ 'hombres', 'mujeres' ],
                                            labels: [ 'Hombres', 'Mujeres'],
                                            barColors: [ '#fc6180', '#4680ff' ],
                                            hideHover: 'auto',
                                            gridLineColor: '#eef0f2',
                                            resize: true
                                        } );
                                    </script>
                                <?php } ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>