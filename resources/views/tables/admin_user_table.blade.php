
                  <!--  <div class="input-group col-sm-3 pull-right"> 
                          <input type="text" name="search" id="search" placeholder="Not working search when pagination link is clicked!" class="form-control pull-right">
                            <span class="input-group-addon" id="alert_name_exist">

                              <i class="fa fa-search"></i>
                              </span>
                        </div>-->
                        
                
@if($admin->count()>0)
<table  id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
       <thead>
         <tr>
         <th class="hidden">Id</th>
         <th>Name</th>
         <th>Role</th>
         <th>Email</th>
         <th>Status</th>
         <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         @foreach($admin as $key =>$a)
          <tr class="id{{$a->id}}">
            <td class="hidden">{{$a->id}}</td>
            <td>{{$a->fname}}</td>
            <td>{{$a->rname}}</td>
            <td>{{$a->email}}</td>
                @if($a->status == '1')
            <td>Active</td>
              @else
              <td>Inactive</td>
              @endif
           

             <td>
                           @if($a->status == '1')
              <button value="{{$a->id}}" class="btn btn-warning btn-xs btn-editStatus"><i class="fa fa-ban"></i></button>
              @else
               <button value="{{$a->id}}" class="btn btn-success btn-xs btn-editStatus"><i class="fa fa-check"></i></button>
                @endif

                            <button value="{{$a->id}}" class="btn btn-primary btn-xs btn-edit" ><i class="fa fa-pencil-square-o"></i>
                            </button>
                            
                          </td>
           
          </tr>

         @endforeach
       </tbody>

     </table>
     <div  class="pull-right">
     <tfoot>
        <tr>
          <td colspan="9">{{$admin->links()}}</td>
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

