@extends('admin.ipo')
@section('title','IPO Dashboard')



@section('body')

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Import Files</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Sta. Mesa Campus</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- MAIN CONTENT-->
                  <div class="x_content">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">                               
                              <div class="x_content">
                               <!--FILE UPLOADER-->
                                <h6>*Only excel files (.xls) are accepted for imports.</h6>
                               <hr>
                 <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">


                <div class="form-group">

                    <div class="col-md-9" style="padding-left: 240px;">
                         {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
                    {!! Form::file('sample_file', array('class' => 'form-control col-md-7 col-xs-12')) !!}
                    {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                    <br>
                     <br>
                      <br>



                    {!!Form::select('sem_id',$semester,null,['id'=>'sem_id','class'=>'form-control','placeholder'=>'Select Semester ...'])!!}

               {!!Form::select('sy_id',$sy,null,['id'=>'sy_id','class'=>'form-control','placeholder'=>'Select School Year ...'])!!}

               
                    </div>
                </div>

                 <div class="form-group text-center">
                        <label class="col-md-12" style="padding-top: 30px;">You can <u><a href="/exceldes">Download Excel Template Here</a></u>.</label>
                      </div>
            </div>
            
        </div>
          </div>
                            </div>
                          </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
           
            {!! Form::submit('Upload',['class'=>'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
              {!! Form::submit('Cancel',['class'=>'btn btn-default pull-right']) !!}
            </div>
   
 
                
                               <!--END FORM BUTTONS-->
                            
                        
       
                  </div>
                  <!-- END MAIN CONTENT-->

                                          <div class="table-responsive">
@include('tables.ipo_main_table')
                        </div>
                </div>
              </div>
            </div>
          </div>


        
        @endsection

               @section('script')
                     <script type="text/javascript">
     $(document).ready(function(){

              $.ajaxSetup({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

              });
            });
  $('#addSySem').on('submit',function(e){
              e.preventDefault();
             var sem_id = $('#sem_id').val();
              var sy_id=$('#sy_id').val();

              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'sy_id':sy_id,'sem_id':sem_id},

                      success:function(data){
                        alert(data.msg);
                        //   read();
            
                 
                         $('#sem_id').val("");
                        $('#sy_id').val("");
                      }  
              }) 
            })

         

</script>
        
        @endsection
         