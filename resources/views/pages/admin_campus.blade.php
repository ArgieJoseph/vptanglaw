@extends('admin.home')
@section('title','System Administrator')
@section('header','PUP - E D I S')
  @section('body')


      <!-- page content -->
 
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Campus</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                  {!!Form::open(['url'=>'table','method'=>'POST','id'=>'addUniv'])!!}
                 
                
        <div class="form-group">
                      <div class="col-md-2">
                              <div class="form-group"">

                       <label class="control-label">Type of University</label>
                        {!!Form::select('category_id',$categorys,null,['id'=>'category_id','class'=>'form-control','placeholder'=>''])!!}
                        </div>
                      
                          
                          </div>
                 
                         

                      <div class="col-md-2" id="check_name_exist">
                        <label class="control-label">Code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" required="" id="code">
                            <span class="input-group-addon" id="alert_name_exist">
                              <i class="fa fa-edit"></i>
                              </span>
                        </div>
                      </div>

                      <div class="col-sm-4" id="check_name_exist">
                        <label class="control-label">Name</label>
                        <div class="input-group">
                          <input type="text" class="form-control" required=""  id="name">
                            <span class="input-group-addon" id="alert_name_exist">
                              <i class="fa fa-edit"></i>
                              </span>
                        </div>
                      </div>

                      <div class="col-sm-4" id="check_name_exist">
                        <label class="control-label">Address</label>
                        <div class="input-group">
                          <input type="text" class="form-control" required="" id="address">
                            <span class="input-group-addon" id="alert_name_exist">
                              <i class="fa fa-edit"></i>
                              </span>
                        </div>
                      </div>
 
                 </div>
        
                   
                        <div class="pull-right">
                           
                          {!!Form::submit('Save',['class'=>'btn btn-success'])!!}
                        </div>
                    
       {!!Form::close()!!}
                 
                  
                    </div>
          </div>
          </div>
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Branches and Campuses</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <form action ="{{url('/get_data_search')}}" method="get" id="frmsearch" class="form-horizontal">
                                   <div class="input-group col-sm-5 pull-right"> 
                          <input type="text" name="search" id="search" placeholder="Not working search when pagination link is clicked!" class="form-control pull-right">
                            <span class="input-group-btn">

                            <button class="btn btn-default" type ="submit"><i class="fa fa-search"></i></button>
                              </span>
                        </div>
                        </form>
                     
                      <div class="input-group pull-right">
              
                       </div>
                     
                        <div class="table-responsive">
                            @include('tables.admin_campus_table')
                        </div>
                  </div>
               </div>
            </div>
          </div>


          </div>


                @include('admin.admin_update_campus')
                @include('admin.modal.admin_delete_campus')
   

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

            $('#addUniv').on('submit',function(e){
              e.preventDefault();
              var code = $('#code').val();
              var name = $('#name').val();
             var address = $('#address').val();
              // var type=$('#type').val();
              var category_id=$('#category_id').val();

              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'code':code,'name':name,'address':address,'category_id':category_id},

                      success:function(data){
                        alert(data.msg);
                        //   read();
                        data="";
                        getData(data);
                         $('#code').val("");
                         $('#name').val("");
                          $('#category_id').val("");
                        $('#address').val("");
                      }  
              }) 
            })


              $(document).on('click','.btn-dell',function(e){
                var id = $(this).val();
                $.ajax({
                  type:'get',
                  url: "{{url('getidCampus')}}",
                  data: {id:id},
                  dataType:'json',
                  success:function(data)
                  {
                    var del = $('#campus-delete');
                      del.find('#id').val(data.id);
                      $('#deleteCampus').modal('show'); 
                  }
                })
    
              });

 $('#campus-delete').on('submit',function(e){
                e.preventDefault();
                var data= $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.post(url,data,function(data){
                  alert(data.msg);
                   data="";
                  getData(data);
                  $('#deleteCampus').modal('hide'); 
                })
              })
//--------------------------------------------
$(document).on('click','.btn-edit', function(e){
    var id = $(this).val();
    $.ajax({
      type:'get',
      url:"{{url('edit')}}",
      data: {id:id},
      success:function(data){

        var update = $('#univ-update');
        update.find('#id').val(data.id);
        update.find('#code').val(data.code);
        update.find('#name').val(data.name);
        update.find('#address').val(data.address);
        update.find('#category_id').val(data.category_id);
       $('#editModal').modal('show'); 
       //console.log($cat);  
      }
    })

})


$('#univ-update').on('submit',function(e){
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

          </script>
    
           
    <!-- page content -->
    
                     <br>
                     <br>
                     <br>


        
        @endsection

