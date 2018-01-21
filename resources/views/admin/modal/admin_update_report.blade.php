 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel">Modify Semester Details</h4>
                                    </div>
                                  <div class="modal-body">

                                 {!!Form::open(['url'=>'updateReport','method'=>'POST','id'=>'report'])!!}
                                 {!!Form::hidden('id',null,['id'=>'id'])!!}
                                
                 
                
        <div class="form-group">
           
                       

                          <div class="col-sm-4">
                     
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Report Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="reportcategory" name="reportcategory" required="required" class="form-control col-md-7 col-xs-12" disabled>
                        </div>
                      </div>

                          </div>

                       
                         

                      <div class="col-md-2" id="check_name_exist">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Report Value<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="reportvalue" max="100" min="1" name="reportvalue" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      </div>

                      <div class="col-sm-4" id="check_name_exist">
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Due Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" id="duedate"  name="duedate" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      </div>

                      <div class="col-sm-4" id="check_name_exist">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Report Deduction<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="deduction"  name="deduction" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      </div>
                      
                      <div class="col-sm-4" id="check_name_exist">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Per No. of Days<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="day"  name="day" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      </div>
  
                 </div>
        
                   <br>
                    
     

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                     {!!Form::submit('Save Changes',['class'=>'btn btn-primary'])!!}
                                       {!!Form::close()!!}
                                  </div>
                                  </div>
                                </div>
                              </div>