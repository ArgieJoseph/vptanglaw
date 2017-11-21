@extends('layouts.login-layout')
@section('content')

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <form method="POST" action="{{ route('admin.login') }}">
             {{ csrf_field() }}



              <h1>Admin Login</h1>
              <div>

                <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>


                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

              </div>
              <div>
                <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
              </div>
              <div>
                <button class="btn btn-default" type="submit">Log in</button>


                <!--a class="reset_pass" href="{{ route('admin.password.request') }}">Lost your password?</a-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
              

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-star"></i> Tanglaw System </h1>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

     
      </div>
    </div>




@endsection




