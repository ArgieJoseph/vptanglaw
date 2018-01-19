@extends('admin.home')
@section('title','System Administrator')
@section('header','PUP - E D I S')
  @section('body')


      <!-- page content -->
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Report Weight</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Report Value</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                <!--error catcher-->
                    <div class="alert alert-danger print-error-msg" style="display:none">
                      <ul></ul>
                   </div>
                   <div class="alert alert-success print-success-msg" style="display:none">
                      <ul><i class="fa fa-check"></i><b>&nbsp;Successfully Added!</b></ul>
                   </div>

                  <!--error catcher-->  
                   {!!Form::open(['class'=>'form-horizontal','url'=>'updateReportVal','method'=>'POST','id'=>'updateRep'])!!}
   
                     
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Report Category <span class="required">*</span>
                        </label>
                         <div class="col-sm-6 col-xs-12 col-xs-12">
                        {!!Form::select('id',$report,null,['id'=>'id','class'=>'form-control','placeholder'=>''])!!}
                      </div>
                      </div>
                      <br>

                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Report Value<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="reportvalue" max="100" min="1" name="reportvalue" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <br>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Due Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" id="duedate"  name="duedate" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div><br> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Report Deduction<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="deduction"  name="deduction" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div><br>  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Per No. of Days<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="day"  name="day" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div><br>  
                        

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="pull-right">
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>

                {!!Form::close()!!}
                  </div>

 <!--error catcher-->
                    <div class="alert alert-danger print-error-msg" style="display:none">
                      <ul></ul>
                   </div>
                   <div class="alert alert-success print-success-msg" style="display:none">
                      <ul><i class="fa fa-check"></i><b>&nbsp;Successfully Added!</b></ul>
                   </div>

                </div>
              </div>
            </div>
      
      
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Reports</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action ="{{url('/get_data_search_user')}}" method="get" id="frmsearch" class="form-horizontal">
                                   <div class="input-group col-sm-5 pull-right"> 
                          <input type="text" name="search" id="search" placeholder="Not working search when pagination link is clicked!" class="form-control pull-right">
                            <span class="input-group-btn">

                            <button class="btn btn-default" type ="submit"><i class="fa fa-search"></i></button>
                              </span>
                        </div>
                        </form>
                    <div class="table-responsive">
         

                      @include('tables.admin_points_table')
                    </div>
                  </div>
                </div>
              </div>
 
            </div>
          </div>
@include('admin.modal.admin_update_report')
                   



        
       
        <!-- /page content -->
     @endsection


           
    <!-- page content -->
         <!-- Scripts -->
         @section('script')

         <script type="text/javascript">

    


          $(document).ready(function(){

              $.ajaxSetup({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

              });

               $(document).on('click', '.pagination a',function()
    {
      
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();

        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];

        getData(page);
    });

            });
            $('input[name="iCheck"]').on('ifChecked',function(event){
              var value= $(this).val();
             alert(value);
            })


            $('#updateRep').on('submit',function(e){
                e.preventDefault();
                var data= $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.post(url,data,function(data){
                  console.log(data);
                   data="";
                  getData(data);
           $('#id').find('option:selected').remove();
              $('#reportvalue').val("");
               $('#duedate').val("");
                $('#deduction').val("");
                 $('#day').val("");
                })
              })



            $('#report').on('submit',function(e){
                e.preventDefault();
                var data= $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.post(url,data,function(data){
                  console.log(data);
                   data="";
                  getData(data);
                  $('#editModal').modal('hide'); 
                })
              })


              $(document).on('click','.btn-edit', function(e){
                  var id = $(this).val();
                  $.ajax({
                    type:'get',
                    url:"{{url('editReport')}}",
                    data: {id:id},
                    success:function(data){

                      var update = $('#report');
                      update.find('#id').val(data.id);
                      update.find('#reportcategory').val(data.name);
                      update.find('#reportvalue').val(data.value);
                      update.find('#duedate').val(data.due_date);
                      update.find('#deduction').val(data.deduction);
                      update.find('#day').val(data.dod);
                     $('#editModal').modal('show'); 
                     //console.log($cat);  
                    }
                  })

              })

function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: 'get',
            datatype: "html",
        })
        .done(function(data)
        {
            $('.table-responsive').empty().html(data);
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server');
        });
}


            
          </script>
    
        @endsection

