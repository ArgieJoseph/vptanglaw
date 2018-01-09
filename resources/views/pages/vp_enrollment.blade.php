@extends('admin.vp')
@section('title','VP Dashboard')
@section('header','PUP - E D I S')


@section('body')


			<!-- page content -->
 
					
<!-- page content -->
 
			<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
									<div class="x_title">
										<h2>Enrollment</h2>
										<ul class="nav navbar-right panel_toolbox">
											<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
											</li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
												<ul class="dropdown-menu" role="menu">
													<li><a href="#">Settings 1</a>
													</li>
													<li><a href="#">Settings 2</a>
													</li>
												</ul>
											</li>
											<li><a class="close-link"><i class="fa fa-close"></i></a>
											</li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">


<br>
 	<div class="col-md-12 col-sm-12  col-xs-12">
		<div class="x_panel">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                        <div class="input-group select2 col-md-8 col-sm-8 col-xs-8">
                          <select class="form-control" id="CategorySelect">
                            <option disabled selected>Choose Category</option>
                            <option value="GenderProgram">Enrollment in the Campuses by Program and Gender</option>
                            <option value="YearProgram">Enrollment in the Campuses by Program and Year Level</option>
                          </select>
                        </div>
                      </div>


                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">
                              Select School Year
                          </label>
                          <div class="input-group select2-bootstrap-prepend col-md-4 col-sm-4 col-xs-4">
        
                               <select id="schoolyear" class="form-control select2">
                               	         <option disabled selected>---</option>
                               		@foreach($school_years as $key =>$sy)
                                       <option value="{{ $sy->id}}">{{ $sy->start_date ."-". $sy->end_date}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>

												<div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-4">
                              Select Semester
                          </label>
                          <div class="input-group select2-bootstrap-prepend col-md-4 col-sm-4 col-xs-4">
        
                               <select id="semester" class="form-control select2">
                               	         <option disabled selected>---</option>
                               		@foreach($sem as $key =>$sm)
                                       <option value="{{ $sm->id}}">{{ $sm->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>

                                            <div class="pull-right">
                          <button id="searchenroll" type="submit" class="btn btn-success">Search</button>
                        </div>
                                      </div>
       
          </div>
          			@include('tables.vp_enrollment_tabletemporary')


			</div>



								</div>
							</div>

					 

		
										 <br>
										 <br>
										 <br>


				
				@endsection

@section('script')
	<script src="../../vendors/code/highcharts.js"></script>
	<script src="../../vendors/code/modules/data.js"></script>
	<script src="../../vendors/code/modules/drilldown.js"></script>
	<!-- For hiding and showing -->
<script type="text/javascript">


      	$('#searchenroll').on('click',function(e){
              var category = $('#CategorySelect').val();
              var schoolyear = $('#schoolyear').val();
              var sem = $('#semester').val();
                $.ajax({
                type:'get',
    					  url:"{{url('vp_search_enrollment')}}",
                data : {'category':category,'schoolyear':schoolyear,'sem':sem},

                      success:function(data)
                      {
        								if(category == "GenderProgram")
        								{
        										 $('#tbody1').html(data[0]);
        									 	 $('#tbody2').html(data[1]);
        									 	 $('#tbody3').html(data[2]);
        										 $('#YearProgram').hide();
        										 $('#GenderProgram').show();
        								}

        										else if(category == "YearProgram")
        								{
        										$('tbody1').html(data);
        										$('#GenderProgram').hide();
        										$('#YearProgram').show();

                 
       
        								}
                      }  
              }) 
            })

</script>     





				@endsection 