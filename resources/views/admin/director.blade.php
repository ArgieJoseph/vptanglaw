@extends('layouts.app')
@section('title','Guest')
@section('header','PUP - E D I S')
@section('sidebar')

<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <!--<li><a href="{{route('admin_sy')}} "><i class="fa fa-calendar"></i> School Year </a></li>
                          <li><a href="{{route('admin_sem')}}"><i class="fa fa-calendar-o"></i> Semester </a></li>
                          <li><a href="{{route('admin_camp')}}"><i class="fa fa-institution"></i> Campus </span></a></li>
                          <li><a href="#"><i class="fa fa-laptop"></i> Program <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin_adv')}}">Advanced Education</a></li>
                      <li><a href="{{route('admin_high')}}">Higher Education</a></li>
                      <li><a href="{{route('admin_tech')}}">Technical Programs</a></li>
                    </ul>
                  </li>
                  <li><a href="{{route('admin_um')}}"><i class="fa fa-group"></i> User Management</a></li>
                  -->
                </div>
            </div>
            <!-- /sidebar menu -->
@endsection
@section('body')



 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Director Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
