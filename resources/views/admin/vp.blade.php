@extends('layouts.app')
@section('title','Vice President')
@section('header','PUP - E D I S')
@section('sidebar')

  <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{route('vp_index')}}"><i class="fa fa-home"></i> Dashboard </a>
                    
                  </li>
                  <li><a href="javascript:void(0) "><i class="fa fa-graduation-cap"></i> Students <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('vp_enrol')}}">Enrollment</a></li>
                      <li><a href="{{route('vp_grad')}} ">Graduates</a></li>
                      <li><a href="{{route('vp_scho')}} ">Scholarships</a></li>
                      <li><a href=" {{route('vp_lin')}}">Licensure</a></li>
                      </ul>
                      </li>

                  <li><a href="{{route('vp_facu')}}"><i class="fa fa-user"></i> Faculty </a>

                  </li>

                  <li><a href="{{route('vp_admin')}}"><i class="fa fa-group"></i> Administrative </a>

                  </li>
                  <li><a href="{{route('vp_fin')}}"><i class="fa fa-money"></i> School Finance </a>

                  </li>
                  <li><a href="{{route('vp_faci')}}"><i class="fa fa-bed"></i> Facilities </a>

                  </li>
                  <li><a href="{{route('vp_app')}}"><i class="fa fa-archive"></i> Appendices </a>

                  </li>
                    </ul>
              </div>
            </div>    

            <!-- /sidebar menu -->
@endsection

@section('body')



 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> VP Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
