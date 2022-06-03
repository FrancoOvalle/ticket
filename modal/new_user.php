   <?php 
   $depen =mysqli_query($con, "select * from project");
   $unid = mysqli_query($con, "select * from category");
   ?>
   
   <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Usuario</button>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" id="add_user" name="add_user">
                        <div id="result_user"></div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="name" required type="text" class="form-control" placeholder="Nombre">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="lastname" type="text" class="form-control" placeholder="Apellidos" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input name="email" type="text" class="form-control has-feedback-left" placeholder="Correo Electronico" required>
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="status">
                                    <option value="" selected>-- Selecciona estado --</option>
                                    <option value="1" >Activo</option>
                                    <option value="0" >Inactivo</option>  
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="depend_id">Dependencia
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="depend_id" required>
                                <option value="" selected>-- Selecciona Dependencia --</option>
                                      <?php foreach($depen as $dep):?>
                                        <option value="<?php echo $dep['id']; ?>"><?php echo $dep['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unidad_id">Unidad
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="unidad_id" required >
                                <option value="" selected>-- Selecciona Unidad --</option>
                                      <?php foreach($unid as $uni):?>
                                        <option value="<?php echo $uni['id']; ?>"><?php echo $uni['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo_us">Tipo Usuario
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" required name="tipo_us">
                                    <option value="" selected>-- Selecciona Tipo Usuario --</option>
                                    <option value="2" >Usuario</option>
                                    <option value="1" >Administrador</option>  
                            </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <label class=" col-md-12 col-sm-12 col-xs-12" for="password">
                                Contraseña<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="password" name="password" placeholder="Contraseña" required class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="password_comp" name="password_comp" placeholder="Repita Contraseña" required class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->