@extends('layouts.app')
@section('title','IPO')
@section('sidebar')

<!-- sidebar menu -->
           <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General //put good icons</h3>
                <ul class="nav side-menu">
                      <li><a href="{{route('ipo_enroll')}}"><i class="fa fa-user"></i>Enrollments</a></li>
                      <li><a href="{{route('ipo_licen')}}"><i class="fa fa-user"></i>Licensures</a></li>
                      <li><a href="{{route('ipo_grad')}}"><i class="fa fa-user"></i>Graduates</a></li>
                      <li><a href="{{route('ipo_faculty')}}"><i class="fa fa-user"></i>Faculties</a></li>
                      <li><a href="{{route('ipo_admin')}}"><i class="fa fa-group"></i>Administratives</a></li>
                      <li><a href="{{route('ipo_facility')}}"><i class="fa fa-bed"></i>Facilities</a></li>
                      <li><a href="{{route('ipo_scho')}}"><i class="fa fa-bed"></i>Scholarship</a></li>
                  
                 
                </div>
            </div>


            <!-- /sidebar menu -->
@endsection
@section('body')



 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> IPO Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    //I should put the reports he she must see after uploading or on the uploading section like the ajax tables?

                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
