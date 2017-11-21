@if($bump->count()>0)
<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Univ</th>
                          <th>College</th>
                          <th>Course</th>
                          <th>Major</th>
                          <th>No of male</th>
                          <th>No of female</th>
                        </tr>
                      </thead>

                      <tbody>
                       @foreach($bump as $key =>$o)
                       <tr class="id{{$o->id}}">
                        <td>{{$o->uname}}</td>
                       <td>{{$o->cname}}</td>
                       <td>{{$o->pname}}</td>
                        <td>{{$o->mname}}</td>

       
           
          </tr>

         @endforeach
                      </tbody>
                    </table>

                         <div  class="pull-right">
     <tfoot>
        <tr>
          <td colspan="9">{{$bump->links()}}</td>
        </tr>
      </tfoot>
      </div>
@else
<br>
<br>
<br>
<div>

<h1 style="text-align: center">Not Found!</h1>

 </div>                

@endif
