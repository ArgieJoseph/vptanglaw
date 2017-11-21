    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">Modify Semester Details</h4>
                                    </div>
                                  <div class="modal-body">

                                 {!!Form::open(['url'=>'updateTechnical','method'=>'POST','id'=>'tp-update'])!!}
                                 {!!Form::hidden('id',null,['id'=>'id'])!!}

                 
                
        <div class="form-group">
                  
                       

                          <div class="col-sm-4">
                     
                        <div class="form-group"">

                     <div class="form-group">
                        <label class="col-md-2 control-label">Campus</label>
                        {!!Form::select('univ_id',$univs,null,['id'=>'univ_id','class'=>'form-control','placeholder'=>''])!!}
                      </div>
                        </div>   
                          </div>

    <div class="form-group">
                        <label class="col-md-2 control-label">Course</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="name" id="name" class="form-control">
                        </div>
                      </div>

                          <div class="form-group">
                        <label class="col-md-2 control-label">Major/Minor</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="mname" id="mname" class="form-control">
                        </div>
                      </div>

                <div class="ln_solid"></div>
                     <div class="pull-right">
                           
                          {!!Form::submit('Save',['class'=>'btn btn-success'])!!}
                        </div>
       {!!Form::close()!!}

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                  </div>
                                </div>
                              </div>