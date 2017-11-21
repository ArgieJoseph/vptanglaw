@extends('layouts.login-layout')
@section('content')
    <div>


      <div class="login_wrapper">
<div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

              <h1>Reset Wassword</h1>
              <div>
             @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
            
              <div>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
              </div>
        
            <button class="btn btn-default" type="submit">Reset Password</button>
              <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="{{route('login')}}" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

@endsection
