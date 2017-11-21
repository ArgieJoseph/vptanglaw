@extends('admin.ipo')
@section('title','IPO Dashboard')
@section('header','TANGLAW')


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
                    <h2>Faculty</h2>
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
                                <h6>*Choose specific Branch/Campus first before downloading the template below.</h6>
                               <hr>
                 <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">


                <div class="form-group">

                    <div class="col-md-9" style="padding-left: 240px;">

                           {!!Form::open(['url'=>'/exceldes-faculty','method'=>'Get','id'=>'excel'])!!}
                     
                           {!!Form::select('id',$branch,null,['id'=>'id','class'=>'form-control','placeholder'=>'Select Branch ...'])!!}


                                  <div class="form-group text-center">
                        <label class="col-md-12" style="padding-top: 30px;"><u> {!! Form::submit('Excel Format',['class'=>'btn btn-success pull-right']) !!}
</u>.</label>
                      </div>
                      {!! Form::close() !!}
                      <br>
                      <br>
                      <br>
                      <hr>
                     {!! Form::open(array('route' => 'import-csv-excel-faculty','method'=>'POST','files'=>'true')) !!}
                    {!! Form::file('sample_file', array('class' => 'form-control col-md-7 col-xs-12')) !!}
           
                      <br>
                      <br>
                      <br>

                    </div>
                </div>

          
            </div>
            
        </div>
          </div>
                            </div>
                          </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
           
            {!! Form::submit('Upload',['class'=>'btn btn-success pull-right']) !!}

             {!! Form::submit('Save',['class'=>'btn btn-primary pull-right']) !!}
              {!! Form::submit('Cancel',['class'=>'btn btn-default pull-right']) !!}
            </div>
       {!! Form::close() !!}
 
                
                               <!--END FORM BUTTONS-->
               
       
                  </div>
            
                  <!-- END MAIN CONTENT-->
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
                     var u_id = $('#id').val();
                    

                      var url =$(this).attr('action');
                      var post = $(this).attr('method');
                      //var data = $(this).serialize();
                      //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                        $.ajax({
                        type : post,
                        url : url,
                        data : {'u_id':u_id},

                              success:function(data){
                                alert(data.msg);

                              }  
                      }) 
                    })

    // $('#excel').on('submit',function(e){
    //           e.preventDefault();
    //          var u_id = $('#id').val();
            

    //           var url =$(this).attr('action');
    //           var post = $(this).attr('method');
    //           //var data = $(this).serialize();
    //           //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
    //             $.ajax({
    //             type : post,
    //             url : url,
    //             data : {'u_id':u_id},

    //                   success:function(data){
    //                     alert(data.msg);

    //                   }  
    //           }) 
    //         })

         

</script>
        
        @endsection