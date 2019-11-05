  
<div class="btn-group"> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Asunto</button>
    </div>

    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Asunto</h4>
                </div>
                <div class="modal-body">
                    <form id="add_user" name="add_user">
                        <div id="result_user"></div>
                            
                               <label>Describir el Asunto Ticket</label>
     <textarea name="asunto" id="asunto" class="form-control" required></textarea>
     <br />
                       <br />
                        
                                            <label>Departamento</label>
                                                  <select class="form-control" id="departamento">
<option value="">Seleccione el Departamento</option>
    <?php
    if($rowCount > 0){
         
        while($row = mysqli_fetch_array($query)){ 
            echo '<option value="'.$row['id_departamento'].'">'.utf8_encode($row['departamento']).'</option>';
        }}
    ?>
</select>
                        
                      <br />
                      
                           <label>Puesto Asignado</label>
                              <select class="form-control" name="puesto" id="puesto">
  <option value="">Seleccione primero el Departamento</option>
</select>
                        
                      <br />
                      
                        <div class="ln_solid"></div>
                        <div class="form-group">
                              <button id="save_data" type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->