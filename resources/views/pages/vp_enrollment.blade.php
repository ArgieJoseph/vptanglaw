@extends('admin.vp')
@section('title','VP Dashboard')
@section('body')

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
 
<!--chart-->
<div class="col-md-12 col-sm-12  col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Chart</h2>
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

                   <div id="sampledrill" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                  </div>
                </div>
              </div>
<br>
<br>
           
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Enrollee<small>Users</small></h2>
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
                    <p class="text-muted font-13 m-b-30">
                 <b><h2><center>Enrollment in the Branches by Program and Gender</center></h2></b>

                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="margin: 0px 2px 0px 2px; width: 99%;border:1px solid grey;table-layout:fixed;">
                           <col style="width: 35%;"/>
<!--header report-->
<thead>
<tr>
    <th rowspan="3" style="width: 35%; border:1px solid grey;"><center><h3>PROGRAMS</h3> </center></th>
    <th colspan="6" style="width: 40%; border:1px solid grey;"><center>GENDER </center></th>
</tr>
<tr>
    <th colspan="2" style="width: 21%; border:1px solid grey;"><center>MALE</center></th>
    <th colspan="2" style="width: 21%; border:1px solid grey;"><center>FEMALE</center></th>
    <th  colspan="2" style="width: 21%; border:1px solid grey;"><center>TOTAL</center></th>
    </tr>
<tr>
    <th style="width: 10.5%; border:1px solid grey;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid grey;"><center>%</center></th>
    <th style="width: 10.5%; border:1px solid grey;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid grey;"><center>%</center></th>
    <th style="width: 10.5%; border:1px solid grey;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid grey;"><center>%</center></th>
                    
    </tr>
    <tr>
    <th colspan="7" style="width: 10.5%; border:1px solid grey;">HIGHER EDUCATION</th>             
    </tr>
    <thead>
    </thead>


<tbody>
   @foreach($t_loc as $key =>$t_loc)
  <tr>

    <th colspan="7" style="width: 40%; border:1px solid grey;">{{ $tl->Address}}</th>
  </tr>
  </tr>
      @foreach($t_univ as $key =>$tu)

        @if ($tl->Address == $tu->Address)

        <tr>
          <td>{{ $tu->course ."-". $tu->major}}</td>   
          <td>{{ $tu->Male}}</td>  
          <td>{{ $tu->malepercent}}</td>  
          <td>{{ $tu->Female}}</td>  
          <td>{{ $tu->femalepercent}}</td>  
          <td>{{ $tu->total}}</td>  
          <td>{{ $tu->Male}}</td>              
        </tr>
          @endif
        @endforeach

      @foreach($t_total as $key =>$tt)

        @if ($tl->Address == $tt->Address)

        <tr>
          <td>Total</td>
          <td>{{ $tt->Male}}</td>   
          <td>{{ $tt->Male}}</td>  
          <td>{{ $tt->Female}}</td>   
          <td>{{ $tt->Female}}</td>   
          <td>{{ $tt->Total}}</td>   
          <td>{{ $tt->Total}}</td>            
        </tr>
          @endif
        @endforeach

      @endforeach

                      </tbody>
</table>

                </div>
              </div>
                  

                  </div>
                </div>
              </div>

           
    <!-- page content -->
    
                     <br>
                     <br>
                     <br>
          @endsection 

         @section('script')
<!--Drilldown-->
  <script src="../../vendors/code/highcharts.js"></script>
    <script src="../../vendors/code/modules/data.js"></script>
    <script src="../../vendors/code/modules/drilldown.js"></script>

    <script type="text/javascript">
      $(function () {
//pinasa niya sa variable result galing controller yung $result
       var result = <?php echo json_encode($result); ?>;

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
       var result_univ = <?php echo json_encode($result_univ); ?>;


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

       var result_major = <?php echo json_encode($result_major); ?>;

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

    $.each(JSON.parse(JSON.stringify(result)), function(idx, obj) //parang foreach daw then convert something ewan haha 
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
      {
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
    $('#sampledrill').highcharts({
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
});


</script>





        @endsection 