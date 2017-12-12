@extends('layouts.app')
@section('title','Guest')
@section('header','PUP - E D I S')
@section('sidebar')

<!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-table"></i> Import Files<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('rg_enroll')}}"><i class="fa fa-user"></i>Enrollment</a></li>
                      <li><a href="{{route('rg_faculty')}}"><i class="fa fa-user"></i>Faculty</a></li>
                      <li><a href="{{route('rg_admin')}}"><i class="fa fa-group"></i>Administrative</a></li>
                      <li><a href="{{route('rg_facility')}}"><i class="fa fa-bed"></i>Facilities</a></li>
                    </ul>
                  </li>
                </div>
            </div>
            <!-- /sidebar menu -->
@endsection
@section('body')



 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Registar Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
