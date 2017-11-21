@if($offered->count()>0)
<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Campus</th>
                          <th>Category</th>
                          <th>Program</th>
                           <th>Major</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                       @foreach($offered as $key =>$o)
                       <tr class="id{{$o->id}}">
                       <td>{{$o->code}}</td>
                       <td>{{$o->type}}</td>
                      <td>{{$o->course}}</td>
                      <td>{{$o->major}}</td>
            
             <td>
                            <button value="{{$o->id}}" class="btn btn-primary btn-xs btn-edit" ><i class="fa fa-pencil-square-o"></i>
                            </button>
                            

                  
                      <button value="{{$o->id}}" class="btn btn-danger btn-xs btn-dell"><i class="fa fa-trash"></i></button>
                          </td>
           
          </tr>

         @endforeach
                      </tbody>
                    </table>

                         <div  class="pull-right">
     <tfoot>
        <tr>
          <td colspan="9">{{$offered->links()}}</td>
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
