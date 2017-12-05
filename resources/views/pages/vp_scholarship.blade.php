@extends('admin.vp')
@section('title','VP Dashboard')
@section('header','PUP - E D I S')
@section('body')

<!-- page content -->
 
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Scholarship <small>(table and graphical representation)</small></h2>
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

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" id="CategorySelect">
                            <option selected disabled>Choose category</option>
                            <!-- Scholarship grants -->
                            <option value="1">Scholarship Grants in Branch and Campuses by Program</option>
                            <option value="2">Scholarship Grants in Higher Education in the Branches</option>
                            <option value="3">Scholarship Grants in Technical Programs in the Branches</option>
                            <option value="4">Scholarship Grants in Higher Education in the Campuses</option>
                            <option value="5">Scholarship Grants in Technical Programs in the Campus</option>
                            <!-- Scholars -->
                            <option value="6">Scholars in Branches and Campuses by Program and Year Level</option>
                            <option value="7">Scholars in Higher Education in the Branches by Year Level</option>
                            <option value="8">Scholars in Technical Programs in the Branches by Year Level</option>
                            <option value="9">Scholars in Higher Education in the Campuses by Year Level</option>
                            <option value="10">Scholars in Technical Programs in the Campus by Year Level</option>
                            <option value="11">Scholars in Branches and Campuses by Program and Gender</option>
                            <option value="12">Scholars in Higher Education in the Branches by Gender</option>
                            <option value="13">Scholars in Technical Programs in the Branch by Gender</option>
                            <option value="14">Scholars in Higher Education in the Campuses by Gender</option>
                            <option value="15">Scholars in Technical Programs in the Campus</option>
                            <!-- Entrance scholars -->
                            <option value="16">Entrance Scholars in the Branches</option>
                            <option value="17">Entrance Scholars in Branches by Program</option>
                            <option value="18">Entrance Scholars in Branches by Program and Gender</option>
                            <option value="19">Entrance Scholars in Higher Education in the Branches by Gender</option>
                            <!-- Resident/Academic scholars -->
                            <option value="20">Resident/Academic Scholars in the Branches</option>
                            <option value="21">Resident/Academic Scholars in the Campuses</option>
                            <option value="22">Resident/Academic Scholars in Branches and Campuses by Program</option>
                            <option value="23">Resident/Academic Scholars in Branches and Campuses  by Program and Gender</option>
                            <option value="24">Resident/Academic Scholars in the Branches by Gender</option>
                            <option value="25">Resident/Academic Scholars in the Campuses by Gender</option>
                            <!-- Special grant scholars -->
                            <option value="26">Special Grant Scholars in Branches and Campuses by Program and Gender</option>
                            <option value="27">Special Grant Scholars in Higher Education in the Branches by Gender</option>
                            <option value="28">Special Grant Scholars in Technical Programs in the Branches by Gender</option>
                            <option value="29">Special Grant Scholars in Higher Education in the Campuses by Gender</option>
                            <option value="30">Special Grant Scholars in Technical Programs in the Campus by Gender</option>
                            <!-- Financial grant scholars -->
                            <option value="31">Financial Aid Grant Scholars in the Branches</option>
                            <option value="32">Financial Grant Scholars in the Branches by Program</option>
                            <option value="33">Financial Grant Scholars in the Branches by Program and Gender</option>
                            <option value="34">Financial Aid Grant Scholars in the Branches by Gender</option>
                          </select>
                        </div>
                      </div>

<br>
<br>
<br>
<br>
              <!-- Select Category -->
              <!-- Select1 -->
              <div id="1" class="tago row" style="display:none;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>List of Scholarship Grants</h2>
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
                        <b><h2><center>Scholarship Grants in Branches and Campuses by Program</center></h2></b>
                      </p>
                      <table id="datatable-buttons" class="table table table-bordered" style="margin: 0px 2px 0px 2px; width: 99%;border:1px solid black;table-layout:fixed;">
                             <col style="width: 35%;"/>
                        <!--header report-->
                        <thead>
                        <tr>
                          <th rowspan="3" style="width: 35%; border:1px solid black;"><center><h3>PROGRAMS</h3> </center></th>
                          <th colspan="10" style="width: 40%; border:1px solid black;"><center>GENDER </center></th>
                        </tr>
                        <tr>
                            <th colspan="2" style="width: 21%; border:1px solid black;"><center>Entrance</center></th>
                            <th colspan="2" style="width: 21%; border:1px solid black;"><center>Resident/ Academic</center></th>
                            <th colspan="2" style="width: 21%; border:1px solid black;"><center>Special Grant Aid</center></th>
                            <th colspan="2" style="width: 21%; border:1px solid black;"><center>Financial Aid</center></th>
                            <th colspan="2" style="width: 21%; border:1px solid black;"><center>Total</center></th>
                        </tr>
                        <tr>
                            <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
                            <th style="width: 10.5%; border:1px solid black;"><center>%</center></th>   
                        </tr>
                        <tr>
                            <th colspan="11" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold;">BRANCHES</th>             
                        </tr>
                        <tr>
                            <th colspan="11" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;"><i>HIGHER EDUCATION</i></th>             
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th colspan="11" style="width: 40%; border:1px solid black; padding-left:2em; font-weight: bold; color:black;">BANSUD, ORIENTAL MINDORO</th>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">Bachelor in Secondary Education<br>&nbsp;&nbsp; - Major in English</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">&nbsp;&nbsp; - Major in Mathematics</td>
                            <td style="width: 40%; border:1px solid black;color:black;">4</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.09</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">4</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.09</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">Bachelor of Science in Information Technology</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">4</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.09</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">3</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.07</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">7</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.16</td>
                          </tr>
                          <tr>
                            <th colspan="11" style="width: 40%; border:1px solid black; padding-left:2em; font-weight: bold; color:black;">MALUNAY, QUEZON</th>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">Bachelor in Elementary Education</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">19</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.42</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">21</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.47</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">Bachelor of Science in Agri-Business Management</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">Bachelor of Science in Office Administration</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">7</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.16</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">7</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.16</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">26</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.58</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">3</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.07</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">29</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.64</td>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#ffff00; ">Total, Higher Education</td>   
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">30</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.67</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">140</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">3.11</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">89</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">1.98</td>
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">32</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.71</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">172</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">6.04</td>  
                          </tr>
                          <tr>
                            <th colspan="11" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;"><i>TECHNICAL PROGRAMS</i></th>             
                          </tr>
                          <tr>
                            <th colspan="11" style="width: 40%; border:1px solid black; padding-left:2.5em; font-weight: bold; color:black;">QUEZON CITY</th>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em; color:black;">Diploma in Office Management</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>               
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em; color:black;">Diploma in Information Communication Technology</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">19</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.42</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">21</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.47</td>               
                          </tr>

                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">4</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.09</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">3</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.07</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">7</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.16</td>
                          </tr>
                          <tr>
                            <th colspan="11" style="width: 40%; border:1px solid black; padding-left:2.5em; font-weight: bold; color:black;">STO. TOMAS, BATANGAS</th>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em; color:black;">Diploma in Office Management</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">1</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.02</td>                 
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em; color:black;">Diploma in Information Communication Technology</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">19</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.42</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">21</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.47</td>                 
                          </tr>

                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">4</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.09</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">3</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.07</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">7</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.16</td>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#ffff00;">Total, Technical Programs</td>   
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">30</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.67</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">140</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">3.11</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">89</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">1.98</td>
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">32</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.71</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">172</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">6.04</td>  
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#00cc66;">SUB-TOTAL, BRANCHES</td>   
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">39</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">0.87</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">690</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">15.33</td>
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">729</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">16.19</td>
                          </tr>
                          <tr>
                            <th colspan="11" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold;">CAMPUSES</th>             
                        </tr>
                        <tr>
                            <th colspan="11" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;"><i>HIGHER EDUCATION</i></th>             
                        </tr>
                        <tr>
                            <th colspan="11" style="width: 40%; border:1px solid black; padding-left:2em; font-weight: bold; color:black;">SAN JUAN</th>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">Bachelor in Public Administration</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em;color:black;">Bachelor in Secondary Education</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">19</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.42</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">2</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.04</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">21</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.47</td>              
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">4</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.09</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">3</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.07</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">7</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.16</td>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#ffff00; ">Total, Higher Education</td>   
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">30</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.67</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">140</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">3.11</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">89</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">1.98</td>
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">32</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.71</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">172</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">6.04</td>  
                          </tr>
                        <tr>
                            <th colspan="11" style="width: 40%; border:1px solid black; padding-left:2.5em; font-weight: bold; color:black;">BIÑAN, LAGUNA</th>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em; color:black;">Diploma in Office Management</td>
                            <td style="width: 40%; border:1px solid black;color:black;">4</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.09</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">4</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.09</td>                 
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:3.5em; color:black;">Diploma in Information Communication Technology</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">9</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.20</td>
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">9</td>  
                            <td style="width: 40%; border:1px solid black;color:black;">0.20</td>               
                          </tr>

                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:29em; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">22</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.49</td>
                            <td style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">-</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">22</td>
                            <td style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">0.49</td>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#ffff00;">Total, Technical Programs</td>   
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">22</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.49</td>
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">22</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">0.49</td>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#00cc66;">SUB-TOTAL, CAMPUSES</td>   
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">39</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">0.87</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">690</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">15.33</td>
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">-</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">729</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#00cc66;">16.19</td>
                          </tr>
                          <tr>
                            <td style="width: 40%; border:1px solid black; padding-left:10em;  font-weight: bold; color:black; background-color:#0099ff;">GRAND TOTAL</td>   
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">243</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">5.40</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">2058</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">45.56</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">2169</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">48.18</td>
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">32</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">0.71</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">4,052</td>  
                            <td style="width: 40%; border:1px solid black;color:black; background-color:#0099ff;">100.00</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Select2 -->
              <div id="2" class="tago row" style="display:none;">
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

                      <div id="chart1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- Select3 -->
              <div id="3" class="tago row" style="display:none;">
                <div class="col-md-12 col-sm-12  col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Chart</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div id="chart2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- End of select category -->
<br>
<br>
              
                  

                  </div>
                </div>
              </div>

           
    <!-- page content -->
    
                     <br>
                     <br>
                     <br>
 <!--end appendices-->

        
        @endsection

@section('script')
<script src="../../vendors/code/highcharts.js"></script>
<script src="../../vendors/code/modules/exporting.js"></script>

<script type="text/javascript">
  $(function(){
    $('#CategorySelect').change(function() {
        $('.tago').hide();
        $('#' + $(this).val()).show();
    })
  } )
</script>

<script type="text/javascript">

Highcharts.chart('chart1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Scholarship Grant in Higher Education in the Branches'
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        categories: [
            'Bunsud, Oriental Mindoro',
            'Lopez, Quezon',
            'Maragondon, Cavite',
            'Malunay, Quezon',
            'Quezon City',
            'Sto. Tomas, Batangas',
            'Taguig'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Number of Scholars'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
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
        name: 'Entrance Scholars',
        data: [4, 9, 0 , 0, 2, 17, 0]

    }, {
        name: 'Resident/Academic Scholars',
        data: [3, 76, 18, 26, 0, 0, 15]

    }, {
        name: 'Special Grant Scholars',
        data: [0, 0, 0, 0, 78, 11, 0]

    }, {
        name: 'Financial Aid',
        data: [0, 26, 0, 3, 0, 0, 3]

    }]
});
    </script>

<script src="../../vendors/code/highcharts.js"></script>
<script src="../../vendors/code/highcharts-more.js"></script>
<script src="../../code/modules/exporting.js"></script>

<script type="text/javascript">

var chart = Highcharts.chart('chart2', {

    title: {
        text: 'Scholarship Grants in Technical Program in the Branches'
    },

    subtitle: {
        text: ' '
    },

    xAxis: {
        categories: ['Quezon City', 'Sto. Tomas, Batangas']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: [45, 2],
        showInLegend: false
    }]

});

    </script>

@endsection
         

         