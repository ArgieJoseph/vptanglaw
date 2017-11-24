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
                    <h2>List of Enrollee</h2>
                    <ul class="nav navbar-right panel_toolbox">
                   
                      <li>
                        <a href="{{route('vp_enrol_pdf')}}" target="_blank" class="dropdown-toggle" aria-expanded="false"><i class="fa fa-print"></i></a>
                    
                      </li>
                         <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                 <b><h2><center>Enrollment in the Branches by Program and Gender</center></h2></b>

                    </p>
                    <table id="datatable-buttons" class="table table table-bordered" style="margin: 0px 2px 0px 2px; width: 99%;border:1px solid black;table-layout:fixed;">
                           <col style="width: 35%;"/>
<!--header report-->
<thead>
<tr>
    <th rowspan="3" style="width: 35%; border:1px solid black;"><center><h3>PROGRAMS</h3> </center></th>
    <th colspan="6" style="width: 40%; border:1px solid black;"><center>GENDER </center></th>
</tr>
<tr>
    <th colspan="2" style="width: 21%; border:1px solid black;"><center>MALE</center></th>
    <th colspan="2" style="width: 21%; border:1px solid black;"><center>FEMALE</center></th>
    <th  colspan="2" style="width: 21%; border:1px solid black;"><center>TOTAL</center></th>
    </tr>
<tr>
    <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
                    
    </tr>
    <tr>
    <th colspan="7" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;">HIGHER EDUCATION</th>             
    </tr>
  </thead>


<tbody>
   @foreach($t_loc as $key =>$tl)
  <tr>
      @if ($tl->education == "Higher Education"  )
      <th colspan="7" style="width: 40%; border:1px solid black; padding-left:1.5em; font-weight: bold; color:black;">{{$tl->Address}}</th>
  </tr>

      @foreach($t_univ as $key =>$sp)

        @if ($sp->Address == $tl->Address && $sp->education == "Higher Education" )

        <tr>
          <td  style="width: 40%; border:1px solid black; padding-left:2.5em;color:black;">{{ $sp->course ."-". $sp->major}}</td>   
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Male}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->malepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Female}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->femalepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->total}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->totalpercent}}</td>              
        </tr>
          @endif
      @endforeach

      @foreach($t_total as $key =>$tt)

        @if ($tl->Address == $tt->Address && $tt->education == "Higher Education")

        <tr>
          <td  style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
            <td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">{{ $tt->Male}}</td>   
            <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->malepercent}}</td>  
           <td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">{{ $tt->Female}}</td>   
           <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->femalepercent}}</td>   
           <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->total}}</td>   
           <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->totalpercent}}</td>            
        </tr>
          @endif
      @endforeach
    @endif


  @endforeach


        @foreach($t_educ as $key =>$te)

        @if ($te->education == "Higher Education" )

        <tr>
          <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#ffff00; ">Sub Total, Higher Education</td>   
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->Male}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->malepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->Female}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->femalepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->total}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->totalpercent}}</td>              
        </tr>
          @endif
      @endforeach

  </tbody>

    <tr>
      <th colspan="7" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;">TECHNICAL PROGRAMS</th>             
    </tr>
   



   <!--TECHNICAL EDUC-->


<tbody>
   @foreach($t_loc as $key =>$tl)
  <tr>
      @if ($tl->education == "Technical Program"  )
      <th colspan="7" style="width: 40%; border:1px solid black; padding-left:1.5em; font-weight: bold; color:black;">{{ $tl->Address}}</th>
  </tr>
      @foreach($t_univ as $key =>$sp)

        @if ($sp->Address == $tl->Address && $sp->education == "Technical Program" )

       
        <tr>
          <td  style="width: 40%; border:1px solid black; padding-left:2.5em; color:black;">{{ $sp->course ."-". $sp->major}}</td>   
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Male}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->malepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Female}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->femalepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->total}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->totalpercent}}</td>              
        </tr>
          @endif
      @endforeach

      @foreach($t_total as $key =>$tt)

        @if ($tl->Address == $tt->Address && $tt->education == "Technical Program")
 <tr>
          <td  style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
            <td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">{{ $tt->Male}}</td>   
            <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->malepercent}}</td>  
           <td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">{{ $tt->Female}}</td>   
           <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->femalepercent}}</td>   
           <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->total}}</td>   
           <td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->totalpercent}}</td>            
        </tr>
          @endif
      @endforeach
    @endif
  @endforeach

        @foreach($t_educ as $key =>$te)

        @if ($te->education == "Technical Program" )

        <tr>
          <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#ffff00;">Sub Total, Technical Programs</td>   
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->Male}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->malepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->Female}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->femalepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->total}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->totalpercent}}</td>                        
        </tr>
          @endif
      @endforeach

       @foreach($t_grand_total as $key =>$tgt)


        <tr>
          <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:blue;">GRAND TOTAL</td>   
          <td  style="width: 40%; border:1px solid black;color:black; background-color:blue;">{{ $tgt->Male}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:blue;">{{ $tgt->malepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:blue;">{{ $tgt->Female}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:blue;">{{ $tgt->femalepercent}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:blue;">{{ $tgt->total}}</td>  
          <td  style="width: 40%; border:1px solid black;color:black; background-color:blue;">{{ $tgt->totalpercent}}</td>                        
        </tr>

      @endforeach

  </tbody>
</table>

                </div>
              </div>
                  

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