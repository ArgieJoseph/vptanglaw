@extends('admin.vp')
@section('title','VP Dashboard')
@section('header','PUP - E D I S')
@section('body')


      <!-- page content -->
 
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Administrative <small>(table and graphical representation)</small></h2>
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
                  <!--Dropdown-->            

                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" id="CategorySelect">
                            <option disabled selected>Choose Category</option>
                            <option value="ByDistribution">Distribution of Administrative Employees by Office </option>
                            <option value="ByOffice">Number of Administrative Employees by Office</option>
                            <option value="ByEmploymentStatus">Number of Administrative Employees by Employment Status</option>
                            <option value="ByGender">Number of Administrative Employees by Gender</option>
                            <option value="ByAge">Number of Administrative Employees by Age Group</option>
                            <option value="ByCivilStats">Number of Administrative Employees by Civil Status</option>
                            <option value="ByHEA">Number of Administrative Employees by Highest Educational Attainment</option>
                            <option value="ByEligibility">Number of  Administrative Employees by With and Without  Eligibility  </option>
                            <option value="ByEliEarned">Number of Administrative Employees by Eligibility/ies Earned/Passed</option>
                            <option value="ByServiceYears">Number of Administrative Employees by Years of Service in the University</option>
                            <option value="BySalaryGrade">Number of Administrative Employees by Salary Grade</option>
                            <option value="ByLastPromote">Number of Administrative Employees by Years of Last Promotion</option>
                            <option value="ByServiceGroup">Occupational Service Group</option>
                            <option value="ByRateEmployees">Number of Administrative Employees by Occupational Service Group</option>
                            <option value="ByTrend">Administrative Employees Trend by Campus, Year 2012 to Year 2015</option>
                          </select>
                        </div>
                      </div>
                    <!-- Selected -->

                      <!-- Select1 -->
                      <div id="ByDistribution" class="tago row" style="display:none">
                        <!--chart-->
                          <div class="col-md-12 col-sm-12  col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Chart</h2>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                              </div>
                            </div>
                          </div>
                        <!-- End of Chart -->

                        <!-- Table -->
                          <div class="col-md-12 col-sm-12  col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Table</h2>
                                
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                               <table id="datatable-buttons" class="table table-striped table-bordered">
                                                    <thead>
                                                      <tr>
                                                        <th style="border:1px solid black; color:black;  background-color:#bfbfbf;" width="80%">Offices</th>
                                                        <th style="border:1px solid black; color:black;  background-color:#bfbfbf;" colspan="2">Employees</th>
                                                      </tr>
                                                      <tr>
                                                        <th style="width: 40%; border:1px solid black; color:black; "></th>
                                                        <th style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">No.</th>
                                                        <th style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">%</th>
                                                      </tr>
                                                    </thead>


                                                    <tbody>
                                                      <!-- Title -->
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"><label>OFFICE OF THE PRESIDENT</label></td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"></td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"></td>
                                                      </tr>
                                                      <!-- End -->

                                                      <!-- Laman -->
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> &nbsp;&nbsp;&nbsp;&nbsp;University Board Secretary</td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">6 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">0.75</td>
                                                      </tr>
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> &nbsp;&nbsp;&nbsp;&nbsp;Communication Management Office </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">8 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">1.00</td>
                                                      </tr>
                                                      <!-- End n laman -->

                                                      <!-- Total -->
                                                      <tr>
                                                        <td  style="width: 40%; padding-left: 75em; border:1px solid black; color:black;  background-color:#fffc00;"> <label>Total </label> </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">14 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">9.77</td>
                                                      </tr>
                                                      <!-- end ng total -->

                                                      <!-- Title -->
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"><label>OFFICE OF THE EXECUTIVE VICE PRESIDENT</label> </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"></td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"></td>
                                                      </tr>
                                                      <!-- End -->

                                                      <!-- Laman -->
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> &nbsp;&nbsp;&nbsp;&nbsp;Open University </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">2 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">0.75</td>
                                                      </tr>
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> &nbsp;&nbsp;&nbsp;&nbsp;Office of the ETEEAP, Non-Traditional Studies  </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">10 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">1.00</td>
                                                      </tr>
                                                      <!-- End n laman -->

                                                      <!-- Total -->
                                                      <tr>
                                                        <td  style="width: 40%; padding-left: 75em; border:1px solid black; color:black;  background-color:#fffc00;"> <label>Total </label> </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">13 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">1.6</td>
                                                      </tr>
                                                      <!-- end ng total -->

                                                      <!-- Title -->
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"><label>OFFICE OF THE VICE PRESIDENT FOR FINANCE</label> </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"></td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"></td>
                                                      </tr>
                                                      <!-- End -->

                                                      <!-- Laman -->
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> &nbsp;&nbsp;&nbsp;&nbsp;Accounting Department </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">39 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">4.75</td>
                                                      </tr>
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> &nbsp;&nbsp;&nbsp;&nbsp;Budget Services Office  </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> 7  </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">0.88</td>
                                                      </tr>
                                                      <tr>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> &nbsp;&nbsp;&nbsp;&nbsp;Fund Management Office  </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;"> 18  </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">2.26</td>
                                                      </tr>
                                                      <!-- End n laman -->

                                                      <!-- Total -->
                                                      <tr>
                                                        <td  style="width: 40%; padding-left: 75em; border:1px solid black; color:black;  background-color:#fffc00;"> <label>Total </label> </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">13 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">1.6</td>
                                                      </tr>
                                                      <!-- end ng total -->

                                                      <!-- Grand Total -->
                                                      <tr>
                                                        <td  style="width: 40%; padding-left: 40em; border:1px solid black; color:black;  background-color:#0099ff;"> <label>GRAND TOTAL </label> </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#0099ff;">70 </td>
                                                        <td  style="width: 40%; border:1px solid black; color:black;  background-color:#0099ff;">52.6</td>
                                                      </tr>
                                                      <!-- end ng total -->

                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                        <!-- End of Table -->
                      </div>
                      <!-- End of Select1 -->

                    <!-- Select2 -->
                      <div id="ByOffice" class="tago row" style="display:none">
                        <!--chart-->
                          <div class="col-md-12 col-sm-12  col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Chart</h2>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                              </div>
                            </div>
                          </div>
                        <!-- End of Chart -->

                        <!-- Table -->
                          <div class="col-md-12 col-sm-12  col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Table</h2>
                                
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                               <table id="datatable-buttons" class="table table-striped table-bordered">
                                                    <thead>
                                                      <tr>
                                                        <th style="width: 90%; border:1px solid black; color:black;  background-color:#bfbfbf;">Offices</th>
                                                        <th style="border:1px solid black; color:black;  background-color:#bfbfbf;" width="20%">No. of Employees</th>
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">OFFICE OF THE PRESIDENT </td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">78</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">OFFICE OF THE EXECUTIVE VICE PRESIDENT </td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">13</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">OFFICE OF THE VICE PRESIDENT FOR ADMINISTRATION</td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">263</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">OFFICE OF THE VICE PRESIDENT FOR STUDENT SERVICES</td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">65</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">OFFICE OF THE VICE PRESIDENT FOR RESEARCH, EXTENSION, PLANNING AND DEVELOPMENT</td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">12</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">OFFICE OF THE VICE PRESIDENT FOR ACADEMIC AFFAIRS</td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">32</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">OFFICE OF THE VICE PRESIDENT FOR BRANCHES AND CAMPUSES</td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#ffffff;">23</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">Total Number of Employees</td>
                                                        <td style="width: 40%; border:1px solid black; color:black;  background-color:#fffc00;">432</td>
                                                      </tr>
                                                      
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                        <!-- End of Table -->
                      </div>
                      <!-- End of Select2 -->

                      <!-- Select3 -->
                      <div id="ByEmploymentStatus" class="tago row" style="display:none">
                        <!--chart-->
                          <div class="col-md-12 col-sm-12  col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Chart</h2>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <div id="EmploymentStats" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                              </div>
                            </div>
                          </div>
                        <!-- End of Chart -->
                      </div>
                      <!-- End of Select3 -->

                      <!-- End of selected -->
                  </div>
                </div>
              </div>

    

 <!--end appendices-->
   
        @endsection

@section('script')

<!-- For hiding and showing -->
<script type="text/javascript">
      $(function() {
        $('#CategorySelect').change(function(){
            $('.tago').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>     


<!-- For Chart -->

<script src="../../vendors/code/highcharts.js"></script>
<script src="../../vendors/code/highcharts-more.js"></script>
<script src="../../code/modules/exporting.js"></script>

<script type="text/javascript">

var chart = Highcharts.chart('container', {

    title: {
        text: 'Number of Administrative Employees by Office'
    },

    subtitle: {
        text: ''
    },

    xAxis: {
        categories: [
            'Office of the President',
            'Office of the Executive Vice President',
            'Office of the Vice President for Administration',
            'Office of the Vice President for Finance',
            'Office of the Vice President for Student Services',
            'Office of the Vice President for Research, Extension, Planning and Development',
            'Office of the Vice President for President for Academic Affairs',
            'Office of the Vice President for for Branches and Campuses']
    },

   series: [{
        name: 'Total',
        type: 'column',
        colorByPoint: true,
        data: [29, 71, 106, 129, 144, 176, 135, 148],
        showInLegend: false
    }]

});
    </script>

<script type="text/javascript">

// Create the chart
Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Number of Administrative Employees by Office'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Number of Administrative Employees'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Employees<br/>'
    },

    series: [{
        name: 'Office',
        colorByPoint: true,
        data: [{
            name: 'Office of the President',
            y: 78,
            drilldown: 'Office of the President'
        }, {
            name: 'Office of the Executive Vice President',
            y: 13,
            drilldown: 'Office of the Executive Vice President'
        }, {
            name: 'Office of the Vice President for Administration',
            y: 263,
            drilldown: 'Office of the Vice President for Administration'
        }, {
            name: 'Office of the Vice President for Finance',
            y: 78,
            drilldown: 'Office of the Vice President for Finance'
        }, {
            name: 'Office of the Vice President for Research, Extension, Planning and Development',
            y: 49,
            drilldown: 'Office of the Vice President for Research, Extension, Planning and Development'
        }, {
            name: 'Office of the Vice President for President for Academic Affairs',
            y: 105,
            drilldown: 'Office of the Vice President for President for Academic Affairs'
        }]
    }],
    drilldown: {
        series: [{
            name: 'Position',
            id: 'Office of the President',
            data: [
                [
                    'University Board Secretary',
                    6
                ],
                [
                    'Communication Management Office',
                    8
                ],
                [
                    'Internal Audit Office',
                    5
                ],
                [
                    'University Legal Counsel Office',
                    5
                ],
                [
                    'Information & Communications Technology Office',
                    22
                ]
            ]
        }, {
            name: 'Position',
            id: 'Office of the Executive Vice President',
            data: [
                [
                    'Open University',
                    5
                ],
                [
                    'Office of the ETEEAP, Non-Traditional Studies',
                    3
                ]
            ]
        }, {
            name: 'Office of the Vice President for Administration',
            id: 'Office of the Vice President for Administration',
            data: [
                [
                    'Human Resource Management Department',
                    37
                ],
                [
                    'General Services Office',
                    39
                ],
                [
                    'Medical Services Department',
                    37
                ],
                [
                    'Safety and Security Services',
                    58
                ]
            ]
        }, {
            name: 'Position',
            id: 'Office of the Vice President for Finance',
            data: [
                [
                    'Accounting Department ',
                    39
                ],
                [
                    'Budget Services Office ',
                    10
                ],
                [
                    'Fund Management Office ',
                    18
                ],
                [
                    'Resource Generation Office ',
                    4
                ]
            ]
        }, {
            name: 'Position',
            id: 'Office of the Vice President for Research, Extension, Planning and Development',
            data: [
                [
                    'Research and Extension Management Department',
                    6
                ],
                [
                    'Institute of Cultural Studies',
                    3
                ]
            ]
        }]
    }
});
</script>

<!-- Employment Status -->
<script type="text/javascript">

Highcharts.chart('EmploymentStats', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Number of Administrative Employees by Employment Status'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'Office of the President',
            'Office of the Executive Vice President',
            'Office of the Vice President for Administration',
            'Office of the Vice President for Finance',
            'Office of the Vice President for Student Services',
            'Office of the Vice President for Research, Extension, Planning and Development',
            'Office of the Vice President for President for Academic Affairs',
            'Office of the Vice President for for Branches and Campuses'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Number of Administrative Employees'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Casual',
        data: [49, 71, 106, 129, 144, 176, 135, 148]

    }, {
        name: 'Permanent',
        data: [83, 788, 98, 934, 10, 84, 0, 104]

    }, {
        name: 'Part-time',
        data: [4, 38, 39, 41, 47, 4, 5, 59]

    }]
});
    </script>

@endsection

         

         