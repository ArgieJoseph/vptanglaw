


           <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <title></title>


     <!--live search-->
     <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
     <script type="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Datatables -->
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
        <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" media="print" />
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" media="print" />
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet" media="print" />
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet" media="print" />
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet" media="print" />

</head>
<body class="nav-md" onload="window.print();">
           <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
          
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
    <th style="width: 10.5%; border:1px solid black; " ><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
    <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
                    
    </tr>
    <tr>
    <th colspan="7" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;" media="print" >HIGHER EDUCATION</th>             
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
          <td  style="width: 40%; border:1px solid black; padding-left:20em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
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
          <td style="width: 40%; border:1px solid black; padding-left:5em;  font-weight: bold; color:black; background-color:#ffff00; ">Sub Total, Higher Education</td>   
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
          <td  style="width: 40%; border:1px solid black; padding-left:20em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
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
          <td style="width: 40%; border:1px solid black; padding-left:5em;  font-weight: bold; color:black; background-color:#ffff00;">Sub Total, Technical Programs</td>   
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
</table>

                </div>
              </div>
                  

                  </div>
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Dropzone.js -->
    <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="../vendors/code/highcharts.js"></script>

    <script src="../vendors/code/modules/data.js"></script>
    
    <script src="../vendors/code/modules/drilldown.js"></script>

</body>
</html>

  


     
