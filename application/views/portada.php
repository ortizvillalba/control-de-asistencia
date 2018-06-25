<!-- Start Page Content -->
<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <?php if(isset($cant_mis_indicadores) && $cant_mis_indicadores){ ?>
            <div class="col-lg-6">
                <a href="<?php echo base_url(); ?>mis_indicadores">
                <div class="card bg-primary p-30">
                    <div class="media widget-ten">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-bag f-s-40"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <p class="m-b-0">Indicadores asignados</p>
                            <h2 class="color-white m-t-0"><?php echo $cant_mis_indicadores; ?></h2>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>
            <?php if(isset($cant_total_indicadores) && $cant_total_indicadores){ ?>
            <div class="col-md-6">
                <a href="<?php echo base_url(); ?>indicadores">
                <div class="card bg-success  p-30">
                    <div class="media widget-ten">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-chart-pie f-s-40"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <p class="m-b-0">Total de Indicadores</p>
                            <h2 class="color-white m-t-0"><?php echo $cant_total_indicadores; ?></h2>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <?php 
                            $mes = date('m');
                            switch ($mes) {
                                case '01':
                                    $mes = "Enero";
                                    break;
                    
                                case '02':
                                    $mes = "Febrero";
                                    break;
                                    
                                case '03':
                                    $mes = "Marzo";
                                    break;
                    
                                case '04':
                                    $mes = "Abril";
                                    break;
                    
                                case '05':
                                    $mes = "Mayo";
                                    break;
                    
                                case '06':
                                    $mes = "Junio";
                                    break;
                    
                                case '07':
                                    $mes = "Julio";
                                    break;
                    
                                case '08':
                                    $mes = "Agosto";
                                    break;
                    
                                case '09':
                                    $mes = "Setiembre";
                                    break;
                    
                                case '10':
                                    $mes = "Octubre";
                                    break;
                    
                                case '11':
                                    $mes = "Noviembre";
                                    break;
                    
                                case '12':
                                    $mes = "Diciembre";
                                    break;
                            }
                        ?>


                        <h4 class="color-primary">Indicadores a mi cargo <small>(Actualizado al mes de <b><?php echo $mes; ?></b>)</small></h4>
                    </div>
                    <div class="card-body">
                        <?php if($listado_indicadores_estado){ ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Indicador</th>
                                            <th>Actualizado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listado_indicadores_estado as $indicador) { ?>
                                            <tr>
                                                <td><a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>" style="line-height: 1.5; font-size:16px; font-weight:bold;" class="hover"><?php echo $indicador['indicador_desc'] ?></a></td>
                                                <td>
                                                    <?php if($indicador['estado']){ ?>
                                                        <div class="badge badge-success p-10" style="color:#FFF; width:70px;"><i class="fa fa-check"></i></div>
                                                    <?php }else{ ?>
                                                        <div class="badge badge-danger p-10" style="color:#FFF; width:70px"><i class="fa fa-close"></i></div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{ ?>
                            <h1 class="m-t-30 m-b-30">Estas al día</h1>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card bg-dark">
            <div class="testimonial-widget-one p-17">
                <div class="testimonial-widget-one owl-carousel owl-theme">
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial-author">Declaración de Cartagena 2014</div>
                            <div class="testimonial-author-position">(Tercera Reunión Ministerial de Gobierno Electrónico)</div>

                            <div class="testimonial-text">
                                <i class="fa fa-quote-left"></i>  El gobierno electrónico constituye un instrumento fundamental para la mejora de la eficiencia, la eficacia, la transparencia en la gestión pública y la promoción de la participación ciudadana favoreciendo la prestación de servicios públicos y la inclusión digital, y, por tanto, el fortalecimiento de la gobernabilidad democrática y la competitividad.
                                <i class="fa fa-quote-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial-author">SENATICs</div>
                            <div class="testimonial-author-position">Hackathon 2017</div>

                            <div class="testimonial-text">
                                <i class="fa fa-quote-left"></i>  Queremos promover la creatividad y el desarrollo de nuevas ideas, y propuestas que mejoren la gestión en el sector público y posicionen al ciudadano en el centro de todas las acciones.
                                <i class="fa fa-quote-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="year-calendar"></div>
            </div>
        </div>
    
    </div>
</div>
