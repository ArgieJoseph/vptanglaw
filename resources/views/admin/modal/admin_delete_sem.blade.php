    <div class="modal fade" id="deleteStatus" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-sm">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">Modify Status</h4>
                                    </div>
                                  <div class="modal-body">

                                 {!!Form::open(['url'=>'deleteSem','method'=>'POST','id'=>'sem-delete'])!!}
                                  {!!Form::hidden('status',null,['id'=>'status','class'=>'form-control'])!!}
                    
                      {!!Form::hidden('id',null,['id'=>'id'])!!}
                                 

            
<div class="col-md-12">
                     
                        <div class="form-group">
                        <label class="control-label">Are you sure to delete this one?</label>
                        </div>

                      </div>

  <div>
                     
</div>



                       
                         

                      <!--   <div class="col-md-2" id="check_name_exist">
                        <label class="control-label">Code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" required="" id="code">
                            <span class="input-group-addon" id="alert_name_exist">
                              <i class="fa fa-edit"></i>
                              </span>
                        </div>
                      </div>

                      <div class="col-sm-4" id="check_name_exist">
                        <label class="control-label">Name</label>
                        <div class="input-group">
                          <input type="text" class="form-control" required=""  id="name">
                            <span class="input-group-addon" id="alert_name_exist">
                              <i class="fa fa-edit"></i>
                              </span>
                        </div>
                      </div>

                      <div class="col-sm-4" id="check_name_exist">
                        <label class="control-label">Address</label>
                        <div class="input-group">
                          <input type="text" class="form-control" required="" id="address">
                            <span class="input-group-addon" id="alert_name_exist">
                              <i class="fa fa-edit"></i>
                              </span>
                        </div>
                      </div>-->
  
               
        
                   <br>
                        <div class="pull-right">
                           
                          
                        </div>
                    
  

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    {!!Form::submit('Delete',['class'=>'btn btn-success'])!!}
                                  </div>
                                  </div>
                                </div>
                                     {!!Form::close()!!}
                              </div>