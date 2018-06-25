<?php if($detalles_indicador){ ?>
    <?php foreach ($detalles_indicador as $indicador) { ?>
        <ol class="breadcrumb m-t-15">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>indicadores">Indicadores</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>"><?php echo $indicador['indicador_desc']; ?></a></li>
            <li class="breadcrumb-item active">Editar indicador</li>
        </ol>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="color-primary"><i class="fa fa-edit m-r-5"></i>Editar indicador</h2>
                        <h3>Indicador: <b><?php echo $indicador['indicador_desc']; ?></b></h3>
                        <div class="form-validation">
                            
                            <?php echo form_open("editar_indicador/".$indicador['id_indicador'], "id='form_editor'"); ?>
                                <input type="hidden" name="accion" value="editar">
                                <input type="hidden" name="id_indicador" value="<?php echo $indicador['id_indicador']; ?>">
                                
                                <div class="form-group row <?php if(form_error('indicador_desc')){ echo 'has-error';} ?>">
                                    <label class="col-lg-4 col-form-label" for="indicador_desc">Nombre del indicador</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="indicador_desc" value="<?php echo $indicador['indicador_desc']; ?>">
                                        <?php echo form_error('indicador_desc'); ?>
                                    </div>
                                </div>
                                <div class="form-group row <?php if(form_error('descripcion')){ echo 'has-error';} ?>">
                                    <label class="col-lg-4 col-form-label" for="descripcion">Descripción</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" name="descripcion" rows="5" style="min-height:100px; max-height: 400px"><?php echo $indicador['descripcion']; ?></textarea>
                                        <?php echo form_error('descripcion'); ?>
                                    </div>
                                </div>
                                <div class="form-group row <?php if(form_error('frecuencia')){ echo 'has-error';} ?>">
                                    <label class="col-lg-4 col-form-label" for="frecuencia">Frecuencia</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="frecuencia" value="<?php echo $indicador['frecuencia']; ?>">
                                        <?php echo form_error('frecuencia'); ?>
                                    </div>
                                </div>
                                <div class="form-group row <?php if(form_error('unidad_medida')){ echo 'has-error';} ?>">
                                    <label class="col-lg-4 col-form-label" for="unidad_medida">Unidad de medida</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="unidad_medida" value="<?php echo $indicador['unidad_medida']; ?>">
                                        <?php echo form_error('unidad_medida'); ?>
                                    </div>
                                </div>
                                <div class="form-group row <?php if(form_error('responsables')){ echo 'has-error';} ?>">
                                    <label class="col-lg-4 col-form-label" for="responsables">Responsables</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="responsables" value="<?php echo $indicador['responsables']; ?>">
                                        <small>Cargar el email de los responsables separados por <b>ESPACIO</b></small>
                                        <?php echo form_error('responsables'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save m-r-5"></i>Guardar cambios</button>
                                        <a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>" class="btn btn-inverse"><i class="fa fa-close m-r-5"></i>Cancelar</a>
                                        <button type="button" onclick="eliminar_indicador()" class="btn btn-danger"><i class="fa fa-trash m-r-5"></i>Elimniar indicador</button>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                            <?php echo form_open("editar_indicador/".$indicador['id_indicador'], "id='eliminar_indicador'"); ?>
                                <input type="hidden" name="accion" value="eliminar">
                            <?php echo form_close(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function eliminar_indicador(){
                swal({
                    title: "Estas seguro?",
                    text: "Se va a eliminar el indicador con todas sus evoluciones!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, eliminar!!",
                    closeOnConfirm: false
                },
                function(){
                    $("#eliminar_indicador").submit();
                    swal("Eliminando!!", "Se esta procesando la acción", "success");
                });
            };
        </script>
    <?php } ?>
<?php } ?>