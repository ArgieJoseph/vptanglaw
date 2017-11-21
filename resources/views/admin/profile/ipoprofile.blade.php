@extends('admin.ipo')
@section('title','System Administrator')
@section('header','PUP - E D I S')

@section('body')
 
 <div class="container">
        <div class="col-md-8 col-md-offset-1">
          <img src="/uploads/avatars/{{$user->avatar}}" style="width: 150px; height:150px; float:left; border-radius:50%; margin-right: 25px;">
            <h2><b>{{$user->fname}} {{$user->mname}} {{$user->lname}}</b></h2>
            <p><b>Email: </b>{{$user->email}} </p>
                 <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                </div>
  </div>


           <div class ="container">
          
           <div class="pull-right">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                          <button type="submit" class="btn btn-primary">Save changes</button>
                          </form>
                          </div>
        </div>
    
@endsection 
