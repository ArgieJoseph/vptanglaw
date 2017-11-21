    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">Modify Branch/Campus Details</h4>
                                    </div>
                                  <div class="modal-body">

                                 {!!Form::open(['url'=>'update','method'=>'POST','id'=>'univ-update'])!!}
                                 {!!Form::hidden('id',null,['id'=>'id'])!!}
                            
                 
                
        <div class="form-group">
                      <div class="col-md-2">
                     
                       <div class="form-group"">

                       <label class="control-label">Type of University</label>
                        {!!Form::select('category_id',$categorys,null,['id'=>'category_id','class'=>'form-control','placeholder'=>''])!!}
                        </div>
                      
                          
                          </div>

                           <div class="col-md-2">
                     
                        <div class="form-group"">

                       <label class="control-label">Code</label>
                        {!!Form::text('code',null,['id'=>'code','class'=>'form-control'])!!}
                        </div>   
                          </div>

                          <div class="col-sm-4">
                     
                        <div class="form-group"">

                       <label class="control-label">Name</label>
                        {!!Form::text('name',null,['id'=>'name','class'=>'form-control'])!!}
                        </div>   
                          </div>

                          <div class="col-sm-4">
                     
                        <div class="form-group"">

                       <label class="control-label">Address</label>
                        {!!Form::text('address',null,['id'=>'address','class'=>'form-control'])!!}
                        </div>   
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
  
                 </div>
        
                   
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