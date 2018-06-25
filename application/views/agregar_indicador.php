<ol class="breadcrumb m-t-15">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>indicadores">Indicadores</a></li>
    <li class="breadcrumb-item active">Agregar indicador</li>
</ol>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h2 class="color-primary"><i class="fa fa-plus m-r-5"></i>Agregar indicador</h2>

                <div class="form-validation">
                    <?php echo form_open("agregar_indicador/", "id='form_editor'"); ?>

                        <div class="form-group row <?php if(form_error('indicador_desc')){ echo 'has-error';} ?>">
                            <label class="col-lg-4 col-form-label" for="indicador_desc">Nombre del indicador</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="indicador_desc" value="<?php echo set_value('indicador_desc'); ?>">
                                <?php echo form_error('indicador_desc'); ?>
                            </div>
                        </div>
                        <div class="form-group row <?php if(form_error('descripcion')){ echo 'has-error';} ?>">
                            <label class="col-lg-4 col-form-label" for="descripcion">Descripción</label>
                            <div class="col-lg-6">
                                <textarea class="form-control" name="descripcion" rows="5" style="min-height:100px; max-height: 400px"><?php echo set_value('descripcion'); ?></textarea>
                                <?php echo form_error('descripcion'); ?>
                            </div>
                        </div>
                        <div class="form-group row <?php if(form_error('frecuencia')){ echo 'has-error';} ?>">
                            <label class="col-lg-4 col-form-label" for="frecuencia">Frecuencia</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="frecuencia" value="<?php echo set_value('frecuencia'); ?>">
                                <?php echo form_error('frecuencia'); ?>
                            </div>
                        </div>
                        <div class="form-group row <?php if(form_error('unidad_medida')){ echo 'has-error';} ?>">
                            <label class="col-lg-4 col-form-label" for="unidad_medida">Unidad de medida</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="unidad_medida" value="<?php echo set_value('unidad_medida'); ?>">
                                <?php echo form_error('unidad_medida'); ?>
                            </div>
                        </div>
                        <div class="form-group row <?php if(form_error('responsables')){ echo 'has-error';} ?>">
                            <label class="col-lg-4 col-form-label" for="responsables">Responsables</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="responsables" value="<?php echo set_value('responsables'); ?>">
                                <small>Cargar el email de los responsables separados por <b>ESPACIO</b></small>
                                <?php echo form_error('responsables'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus m-r-5"></i>Agregar</button>
                                <a href="<?php echo base_url(); ?>indicadores" class="btn btn-inverse"><i class="fa fa-close m-r-5"></i>Cancelar</a>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
    </div>
</div>