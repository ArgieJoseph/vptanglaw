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
                            <option value="GenderProgramChart">Enrollment in the Campuses by Program and Year Level (Chart)</option>
                            
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
                             $('#headertable').html(data[3]);
                             $('#tbody1').html(data[0]);
                             $('#tbody2').html(data[1]);
                             $('#tbody3').html(data[2]);



                            $('#GenderProgram').show();
                            $('#YearProgram').hide();
                            $('#GenderProgramChart').hide();


                        }
                            else if(category == "YearProgram")
                        {
                            $('tbody1').html(data);

                            $('#GenderProgram').hide();
                            $('#GenderProgramChart').hide();
                            $('#YearProgram').show();

                 
       
                        }
                            else if(category == "GenderProgramChart")
                        {
                          //pinasa niya sa variable result galing controller yung $result
       var result = data[0];

//convert para magamit sa chart
       for(var i = 0; i < result.length; i++)
       {
          var obj = result[i];

            for(var prop in obj)
            {
             if(obj.hasOwnProperty(prop) && !isNaN(obj[prop]))
            {
                  obj[prop] = +obj[prop];   
              }
            }
        }
//end ng pasa with convertion


//pinasa niya sa variable result_univ galing controller yung $result_univ
       var result_univ = data[1];


//convert para magamit sa chart
       for(var i = 0; i < result_univ.length; i++)
       {
          var obj = result_univ[i];
            for(var prop in obj)
            {
             if(obj.hasOwnProperty(prop) && !isNaN(obj[prop]))
            {
                  obj[prop] = +obj[prop];   
              }
            }
        }
//end ng pasa with convertion


//same process

       var result_major = data[2];

       for(var i = 0; i < result_major.length; i++)
       {
          var obj = result_major[i];
            for(var prop in obj)
            {
             if(obj.hasOwnProperty(prop) && !isNaN(obj[prop]))
            {
                  obj[prop] = +obj[prop];   
              }
            }
        }
          
//end

//gagamitin na dito sa baba yung mga cinonvert sa taas

//initialize array variable for storing data na gagamitin sa chart
    var user_data = [];//
    var drill_down_data = [];
    var drill_down_data_major = [];

    $.each(JSON.parse(JSON.stringify(result)), function(idx, obj) //foreach result ng data query Address(eg. QC, Sanjuan meaning = 2 loop) na nifetch galing sa result variable mag loloop yung process na nasa loob ng loop ng bracket which populates variable na gagamitin para sa chart
      {


        var user = {};//initialized variable

        user.name = obj.Address;//lalagyan ng laman yung var user / (user.name = user['name']) // ung obj.Adress = yung .Adress galing dun sa result yan yung sinelect sa query nung controller
        user.y = obj.total;
        user.drilldown = obj.Address;

        user_data.push(user);//ipasa or kopya sa user_data lahat nung data nung user for 1st level
        

        //eto preparing ng lalagyan for data nung icliclick gamit id. 
        var drilldown_user = {};
        drilldown_user.id = obj.Address;
        drilldown_user.data = [];

      $.each(JSON.parse(JSON.stringify(result_univ)), function(idx, obj1) 
      { // Same loop ulet pero pang second dimension na to ng query for drill down ng courses per Address(eg. BSIT, BBTE) 

        //eto preparing ng lalagyan for data nung icliclick gamit id. 
           var drilldown_major = {};
             drilldown_major.id = obj1.course;
             drilldown_major.data = [];
 
 
        if(user.drilldown == obj1.Address1)//so kung parehas 
        {
//pasa na nung mga data sa drilldown_user
          drilldown_user.data.push({name: obj1.course, y: obj1.total, drilldown: obj1.course},);
          
          
          drill_down_data.push(drilldown_user);//pinasa ulit ang data sa drilldown_user_data na variable for 2nd level na to




            $.each(JSON.parse(JSON.stringify(result_major)), function(idx, obj2) 
            {

              if(drilldown_major.id  == obj2.course)
              {
                drilldown_major.data.push({name: obj2.major, y: obj2.total},);
             
                drill_down_data_major.push(drilldown_major);//pinasa ulit ang data sa drilldown_user_data na variable for 3rd level na
              }

          });


        }
      
      });
         
    



    });
    // Create the chart
    $('#programgenderchart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Enrollment Summary'
        },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },

        series: [{
            name: 'Address',
            colorByPoint: true,
            data: user_data
        }],
        drilldown: {
                    series: drill_down_data.concat(drill_down_data_major),
                  
               
        }
    })


                            $('#GenderProgram').hide();
                            $('#YearProgram').hide();
                            $('#GenderProgramChart').show();

                 
       
                        }
                      }  
              }) 
            })

</script>     





        @endsection 