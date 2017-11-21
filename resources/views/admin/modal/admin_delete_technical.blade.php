<div class="modal fade" id="deleteTechnical" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Delete Technical Program</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['url'=>'deleteTechnical','method'=>'POST','id'=>'technical-delete'])!!}
        {!!Form::hidden('status',null,['id'=>'status','class'=>'form-control'])!!}
        {!!Form::hidden('id',null,['id'=>'id'])!!}     
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">Are you sure to delete this one?</label>
          </div>
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