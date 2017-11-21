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
                    <h2>Campus</h2>
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


                           {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
                           {!!Form::select('id',$branch,null,['id'=>'id','class'=>'form-control','placeholder'=>'Select Campus ...'])!!}

                    {!!Form::select('sem_id',$semester,null,['id'=>'sem_id','class'=>'form-control','placeholder'=>'Select Semester ...'])!!}

               {!!Form::select('sy_id',$sy,null,['id'=>'sy_id','class'=>'form-control','placeholder'=>'Select School Year ...'])!!}

               
                    </div>
                     <div class="form-group text-center">
                        <label class="col-md-12" style="padding-top: 30px;">You can <u><a href="/exceldes">Download Excel Template Here</a></u>.</label>
                      </div>
                </div>


            </div>
            
        </div>
            <br>
                <br>
                <br>
         {!! Form::file('sample_file', array('class' => 'form-control col-md-7 col-xs-12')) !!}
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

         

         