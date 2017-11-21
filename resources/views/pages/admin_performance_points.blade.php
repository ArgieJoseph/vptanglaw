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
                    <h2>Add Report</h2>
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
                    <form class="form-horizontal" method="POST" id="addAU" action="{{ url('addUser') }}">
                     {{csrf_field()}}

                     
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Report Category <span class="required">*</span>
                        </label>
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                        <select class="form-control col-md-7 col-xs-12" name="">
                          <option value="1">Students</option>
                          <option value="2">Faculties</option>
                          <option value="3">Administrative Employees</option>
                          <option value="4">Facilities</option>
                        </select>
                        </div>
                        </div>
                      </div>

                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Report Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Enrollment in the Branches by Program" type="text" value="{{old('fname')}}" id="report_name"  name="report_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div><br>
                        

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="pull-right">
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>

               </form>
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
  @include('admin.modal.admin_update_userstatus')
            </div>
          </div>

          @include('admin.modal.admin_update_user')



        
       
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

      /*      $('#addAU').on('submit',function(e){
              e.preventDefault();
              var fname = $('#fname').val();
              var mname = $('#mname').val();
              var lname = $('#lname').val();
              var email = $('#email').val();
              var password = $('#inputPassword').val();
              var role_id=$('#role_id').val();

              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'fname':fname,'mname':mname,'lname':lname,'email':email,'password':password,'role_id':role_id},
                      success:function(data){
                        console.log(data);
                        data="";
                        getData(data);
                         $('#code').val("");
                         $('#name').val("");
                        $('#address').val("");
                      },
                       error: function(data){
                           var errors = data.responseJSON;
                           alert(data.errors);
        // Render the errors with js ...
                          }
           });
        
          });*/
           $(document).on('click','.btn-editStatus', function(e){

                 var id = $(this).val();
                 $.ajax({
                   type:'get',
                   url:"{{url('editUserStatus')}}",
                   data: {id:id},
                  success:function(data){
                     var update = $('#user-updatestatus');
                     update.find('#id').val(data.id);
                     update.find('#uid').val(data.uid);
                     update.find('#status').val(data.status);
                     $('#editStatus').modal('show'); 
                    }
                 })
                 })    

            $('#addAU').on('submit',function(e){
              e.preventDefault();
              var fname = $('#fname').val();
              var mname = $('#mname').val();
              var lname = $('#lname').val();
              var email = $('#email').val();
              var password = $('#inputPassword').val();
              var role_id=$('#role_id').val();

              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'fname':fname,'mname':mname,'lname':lname,'email':email,'password':password,'role_id':role_id},
                      success: function(data) {
                       
                  if($.isEmptyObject(data.error)){
                        data="";
                        getData(data);
                         $('#fname').val("");
                         $('#mname').val("");
                         $('#lname').val("");
                        $('#email').val("");
                        $('#inputPassword').val("");
                        $('#role_id').val("");
                    $(".print-error-msg").remove();
                    $(".print-success-msg").show();
                  }else{
                    printErrorMsg(data.error);
                  }
                }
           });
        
          });


      function printErrorMsg (msg) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });
    }




                 $('#user-updatestatus').on('submit',function(e){
                e.preventDefault();
                var data= $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.post(url,data,function(data){
                  console.log(data);
                   data="";
                  getData(data);
                  $('#editStatus').modal('hide'); 
                })
              })
//--------------------------------------------
$(document).on('click','.btn-edit', function(e){
    var id = $(this).val();
    $.ajax({
      type:'get',
      url:"{{url('editUser')}}",
      data: {id:id},
      success:function(data){
        var update = $('#user-update');
        update.find('#id').val(data.id);
        update.find('#admin_id').val(data.admin_id);
        update.find('#fname').val(data.fname);
        update.find('#mname').val(data.mname);
        update.find('#lname').val(data.lname);
        update.find('#email').val(data.email);
         update.find('#inputPassword').val(data.inputPassword);
        update.find('#role_id').val(data.role_id);

       $('#editModal').modal('show'); 
       //console.log($cat);  
      }
    })

})


$('#user-update').on('submit',function(e){
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

//--------------------------------------------

//--------------------------------------------
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


$('#frmsearch').on('submit',function(e){
  e.preventDefault();
  var url=$(this).attr('action');
  var data=$(this).serializeArray();
  var get=$(this).attr('method');

  $.ajax({
    type:get,
    url:url,
    data:data
  }).done(function(data){
    $('.table-responsive').html(data);
  })

})

 
/*
$('#search').on('keyup',function(){
    $value=$(this).val();
    $.ajax({
      type:'get',
      url:"{{url('search')}}",
      data:{'search':$value},
      success:function(data)
      {
        $('tbody').html(data);

      }

    })

})*/

       /*   function read()
            {
              $.ajax({
                type:'get',
                url: "{{url('table')}}",
                dataType: 'html',
                success:function(data)
                {
                      console.log(data);
                   //$('#datatable-responsive').DataTable(data);
                 $('.table-responsive').html(data);
  
                }
              })

            }  */        
          </script>
    
        @endsection

