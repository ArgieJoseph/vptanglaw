
                  <!--  <div class="input-group col-sm-3 pull-right"> 
                          <input type="text" name="search" id="search" placeholder="Not working search when pagination link is clicked!" class="form-control pull-right">
                            <span class="input-group-addon" id="alert_name_exist">

                              <i class="fa fa-search"></i>
                              </span>
                        </div>-->
                        
                
@if($reports->count()>0)
<table  id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
       <thead>
         <tr>
         <th class="hidden">Id</th>
         <th>Name</th>
         <th>Points</th>
         <th>Due Date</th>
         <th>Deduction</th>
         <th>per Day</th>
         <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         @foreach($reports as $key =>$r)
          <tr class="id{{$r->id}}">
            <td class="hidden">{{$r->id}}</td>
            <td>{{$r->name}}</td>
            <td>{{$r->value}}</td>
            <td>{{$r->due_date}}</td>
            <td>{{$r->deduction}}</td>
            <td>{{$r->dayofdeduction}}</td>
             
             <td>
              <button value="{{$r->id}}" class="btn btn-warning btn-xs btn-edit"><i class="fa fa-pencil"></i></button>
                            
                            
                          </td>
           
          </tr>

         @endforeach
       </tbody>

     </table>
     <div  class="pull-right">
     <tfoot>
        <tr>
          <td colspan="9">{{$reports->links()}}</td>
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

