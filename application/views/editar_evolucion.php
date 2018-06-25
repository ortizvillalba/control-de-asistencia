
<?php if($detalles_evolucion){ ?>
    <?php foreach ($detalles_indicador as $indicador) { ?>
        <?php foreach ($detalles_evolucion as $evolucion) { ?>
            <ol class="breadcrumb m-t-15">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>indicadores">Indicadores</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>"><?php echo $indicador['indicador_desc']; ?></a></li>
                <li class="breadcrumb-item active">Editar evolución</li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="color-primary"><i class="fa fa-edit m-r-5"></i>Editar evolución</h2>
                            <h3>Indicador: <b><?php echo $indicador['indicador_desc']; ?></b></h3>
                            <div class="form-validation">
                                
                                <?php echo form_open("principal/editar_evolucion/".$indicador['id_indicador']."/".$evolucion['id_evolucion'], "id='form_editor'"); ?>
                                    <input type="hidden" name="id_indicador" value="<?php echo $indicador['id_indicador']; ?>">
                                    <input type="hidden" name="id_evolucion" value="<?php echo $evolucion['id_evolucion']; ?>">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="mes">Fecha <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <select name="mes" class="form-control" required="required">
                                                        <option value="Enero" <?php if ($evolucion['mes']=='Enero') {echo "selected";}?> >Enero</option>
                                                        <option value="Febrero" <?php if ($evolucion['mes']=='Febrero') {echo "selected";}?> >Febrero</option>
                                                        <option value="Marzo" <?php if ($evolucion['mes']=='Marzo') {echo "selected";}?> >Marzo</option>
                                                        <option value="Abril" <?php if ($evolucion['mes']=='Abril') {echo "selected";}?> >Abril</option>
                                                        <option value="Mayo" <?php if ($evolucion['mes']=='Mayo') {echo "selected";}?> >Mayo</option>
                                                        <option value="Junio" <?php if ($evolucion['mes']=='Junio') {echo "selected";}?> >Junio</option>
                                                        <option value="Julio" <?php if ($evolucion['mes']=='Julio') {echo "selected";}?> >Julio</option>
                                                        <option value="Agosto" <?php if ($evolucion['mes']=='Agosto') {echo "selected";}?> >Agosto</option>
                                                        <option value="Setiembre" <?php if ($evolucion['mes']=='Setiembre') {echo "selected";}?> >Setiembre</option>
                                                        <option value="Octubre" <?php if ($evolucion['mes']=='Octubre') {echo "selected";}?> >Octubre</option>
                                                        <option value="Noviembre" <?php if ($evolucion['mes']=='Noviembre') {echo "selected";}?> >Noviembre</option>
                                                        <option value="Diciembre" <?php if ($evolucion['mes']=='Diciembre') {echo "selected";}?> >Diciembre</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="anho" class="form-control" required="required">
                                                        <?php for ($i=date("Y"); $i >= 2013 ; $i--) { ?>
                                                            <option value="<?php echo $i; ?>" <?php if ($evolucion['anho']==$i) {echo "selected";}?> ><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-email">Cantidad <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group <?php if(form_error('cantidad')){ echo 'has-error';} ?>">
                                                        <h4>Total</h4>
                                                        <input type="number" class="form-control" name="cantidad" value="<?php echo $evolucion['cantidad']; ?>">
                                                        <?php echo form_error('cantidad'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group <?php if(form_error('masc')){ echo 'has-error';} ?>">
                                                        <h4>Hombres</h4>
                                                        <input type="number" class="form-control" name="masc" value="<?php echo $evolucion['masc']; ?>">
                                                        <?php echo form_error('masc'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group <?php if(form_error('fem')){ echo 'has-error';} ?>">
                                                        <h4>Mujeres</h4>
                                                        <input type="number" class="form-control" name="fem" value="<?php echo $evolucion['fem']; ?>">
                                                        <?php echo form_error('fem'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(form_error('fuente_verificacion')){ echo 'has-error';} ?>">
                                        <label class="col-lg-4 col-form-label" for="fuente_verificacion">Fuente de verificación</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="fuente_verificacion" value="<?php echo $evolucion['fuente_verificacion']; ?>">
                                            <?php echo form_error('fuente_verificacion'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(form_error('observacion')){ echo 'has-error';} ?>">
                                        <label class="col-lg-4 col-form-label" for="observacion">Observación</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" name="observacion" rows="5" style="min-height:100px; max-height: 400px"><?php echo $evolucion['observacion']; ?></textarea>
                                            <?php echo form_error('observacion'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save m-r-5"></i>Guardar cambios</button>
                                            <a href="<?php echo base_url(); ?>indicador/<?php echo $indicador['id_indicador']; ?>" class="btn btn-inverse"><i class="fa fa-close m-r-5"></i>Cancelar</a>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>