
                  <!--  <div class="input-group col-sm-3 pull-right"> 
                          <input type="text" name="search" id="search" placeholder="Not working search when pagination link is clicked!" class="form-control pull-right">
                            <span class="input-group-addon" id="alert_name_exist">

                              <i class="fa fa-search"></i>
                              </span>
                        </div>-->
                        
                
@if($univs->count()>0)
<table  id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
       <thead>
         <tr>
         <th class="hidden">Id</th>
         <th class="hidden">UID</th>
         <th>Code</th>
         <th>Type</th>
         <th>Name</th>
         <th>Address</th>
         <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         @foreach($univs as $key =>$u)
          <tr class="id{{$u->id}}">
            <td class="hidden">{{$u->id}}</td>
            <td>{{$u->code}}</td>
            <td>{{$u->type}}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->address}}</td>
             <td>
                            <button value="{{$u->id}}" class="btn btn-primary btn-xs btn-edit" ><i class="fa fa-pencil-square-o"></i>
                            </button>
                            

                  
                      <button value="{{$u->id}}" class="btn btn-danger btn-xs btn-dell"><i class="fa fa-trash"></i></button>
                          </td>
           
          </tr>

         @endforeach
       </tbody>

     </table>
     <div  class="pull-right">
     <tfoot>
        <tr>
          <td colspan="9">{{$univs->links()}}</td>
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

