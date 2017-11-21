    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Modify Publishing Deadline</h4>
          </div>
        <div class="modal-body">

       {!!Form::open(['url'=>'updateUser','method'=>'POST','id'=>'user-update'])!!}
       {!!Form::hidden('id',null,['id'=>'id'])!!}
        {!!Form::hidden('admin_id',null,['id'=>'admin_id'])!!}
        {!!Form::hidden('status',null,['id'=>'status'])!!}
          

         <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" data-inputmask="'mask': '99/99/9999'">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>