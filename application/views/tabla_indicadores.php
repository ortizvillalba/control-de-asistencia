<h2 class="color-primary m-t-30">
    <?php echo $titulo; ?>
    <?php if($super_admin){ ?>
        <a href="<?php echo base_url(); ?>agregar_indicador" class="btn btn-success"><i class="fa fa-plus"></i></a>
    <?php } ?>
</h2>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example23" class="display nowrap table table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Indicador</th>
                                <th>Actualización</th>
                                <th>Unidad de medida</th>
                                <th>Responsable(s)</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($indicadores){ ?>
                                <?php foreach($indicadores as $indicador){ ?>
                                    <tr>
                                        <td><?php echo $indicador['id_indicador']; ?></td>
                                        <td><b><a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>"><?php echo $indicador['indicador_desc']; ?></a></b></td>
                                        <td><?php echo $indicador['frecuencia']; ?></td>
                                        <td><?php echo $indicador['unidad_medida']; ?></td>
                                        <td>
                                            <?php $responsables = trim($indicador['responsables']) ?>
                                            <?php $responsables = explode(" ", $responsables); ?>
                                            <?php if($responsables){ ?>
                                                <?php foreach ($responsables as $responsable) { ?>
                                                    <?php if(substr_count($responsable, $this->user_indicadores['usuario']) > 0){ ?>
                                                        <span class="badge badge-success" style="padding:8px; margin:1px; text-transform: lowercase;">
                                                            <?php echo $responsable; ?>
                                                        </span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-info" style="padding:8px; margin:1px; text-transform: lowercase;">
                                                            <?php echo $responsable; ?>
                                                        </span>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($super_admin){ ?>
                                                <a href="<?php echo base_url(); ?>editar_indicador/<?php echo $indicador['id_indicador']; ?>" class="btn btn-inverse"><i class="fa fa-edit"></i></a>
                                            <?php } ?>
                                            <a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>" class="btn btn-warning"><i class="fa fa-info"></i></a>
                                            <?php if(substr_count($indicador['responsables'], $this->user_indicadores['usuario']) > 0){ ?>
                                                <a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>/agregar" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
