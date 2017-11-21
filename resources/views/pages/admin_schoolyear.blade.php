@extends('admin.home')
@section('title','System Administrator')
@section('header','PUP - E D I S')
  @section('body')


      <!-- page content -->

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>School Year</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    {!!Form::open(['url'=>'addSchoolYear','method'=>'POST','id'=>'addYear'])!!}
          <div class="form-group">
                 <div>
                          <label class="control-label">Start Year</label>
                              <input type="number" id="startYear" required=""  class="form-control" min="2000" max="2200" step="1" placeholder="2017">
             </div>
             <div>
                          <label class="control-label">End Year</label>
                          <input type="number" id="endYear" required="" class="form-control" min="2000" max="2200" step="1" placeholder="2018">
                </div>    
                  </div>
     
                      <div class="form-group">
                        <div class="pull-right">
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>
       
            {!!Form::close()!!}
                  </div>
          </div>
          </div>
          </div>
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>School Year</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <form action ="{{url('/get_data_search_sy')}}" method="get" id="frmsearch" class="form-horizontal">
                                   <div class="input-group col-sm-5 pull-right"> 
                          <input type="text" name="search" id="search" placeholder="Not working search when pagination link is clicked!" class="form-control pull-right">
                            <span class="input-group-btn">

                            <button class="btn btn-default" type ="submit"><i class="fa fa-search"></i></button>
                              </span>
                        </div>
                        </form>
                   <div class="table-responsive">
                     @include('tables.admin_sy_table')
                   </div>
                  </div>
                </div>
              </div>

            </div>
          
                </div>
              

          @include('admin.modal.admin_update_sy')
          @include('admin.modal.admin_update_systatus')
          @include('admin.modal.admin_delete_sy')


           
    <!-- page content -->
    
                     <br>
                     <br>
                     <br>
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

            $('#addYear').on('submit',function(e){
              e.preventDefault();
              var start = $('#startYear').val();
             var end = $('#endYear').val();
             var status = 0;
              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'start_date':start,'end_date':end,'status':status},

                      success:function(data){
                        alert(data.msg);
                        //   read();
                       data="";
                       getData(data);
       
                      }  
              }) 
            })

$(document).on('click','.btn-dell',function(e){
                var id = $(this).val();
                $.ajax({
                  type:'get',
                  url: "{{url('getidYear')}}",
                  data: {id:id},
                  dataType:'json',
                  success:function(data)
                  {
                    var del = $('#sy-delete');
                      del.find('#id').val(data.id);
                      $('#deleteStatus').modal('show'); 
                  }
                })
    
              });
 $('#sy-delete').on('submit',function(e){
                e.preventDefault();
                var data= $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.post(url,data,function(data){
                  alert(data.msg);
                   data="";
                  getData(data);
                  $('#deleteStatus').modal('hide'); 
                })
              })
//-------------------

          /*    $(document).on('click','.btn-dell',function(e){
                var id = $(this).val();
                $.ajax({
                  type:'post',
                  url: "{{url('deleteYear')}}",
                  data: {id:id},
                  dataType:'json',
                  success:function(data)
                  {
                    $('tbody tr.id'+id).remove();
                     data="";
                    getData(data);
                  }
                })
    
              });*/
//--------------------------------------------
              $(document).on('click','.btn-edit', function(e){
                  var id = $(this).val();
                  $.ajax({
                    type:'get',
                    url:"{{url('editSchoolYear')}}",
                    data: {id:id},
                    success:function(data){

                      var update = $('#sy-update');
                      update.find('#id').val(data.id);
                      update.find('#startYear').val(data.start_date);
                      update.find('#endYear').val(data.end_date);
                      update.find('#status').val(data.status);
                     $('#editModal').modal('show'); 
                     //console.log($cat);  
                    }
                  })

              })

               $(document).on('click','.btn-editStatus', function(e){
                  var id = $(this).val();
                  $.ajax({
                    type:'get',
                    url:"{{url('editSchoolYearStatus')}}",
                    data: {id:id},
                    success:function(data){
                      var update = $('#sy-updatestatus');
                      update.find('#id').val(data.id);
                      update.find('#startYear').val(data.start_date);
                      update.find('#endYear').val(data.end_date);
                      update.find('#status').val(data.status);
                     $('#editStatus').modal('show'); 

                     //console.log($cat);  
                    }
                  })
                 })            

                


                 $('#sy-updatestatus').on('submit',function(e){
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



              $('#sy-update').on('submit',function(e){
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
      url:"{{url('searchsem')}}",

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

