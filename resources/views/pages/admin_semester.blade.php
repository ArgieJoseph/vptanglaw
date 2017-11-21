@extends('admin.home')
@section('title','System Administrator')
@section('header','PUP - E D I S')

  @section('body')


      <!-- page content -->

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Semester</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                 
                    {!!Form::open(['url'=>'addSemester','method'=>'POST','id'=>'addSem'])!!}
                      
                        <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Semester</label>
                            <input type="text" class="form-control" id="name" placeholder="nth Semester">
                        </div>
                     
                     
                       </div>
                   
                        <div class="pull-right">
                          <button type="submit" class="btn btn-success">Save</button>
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
                     <div class="table-responsive">
@include('tables.admin_semester_table')
                        </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
 @include('admin.modal.admin_update_semester')
 @include('admin.modal.admin_update_semesterstatus')
  @include('admin.modal.admin_delete_sem')
         
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

            $('#addSem').on('submit',function(e){
              e.preventDefault();
              var name = $('#name').val();
             var status = 0;
              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'name':name,'status':status},

                      success:function(data){
                        alert(data.msg);
                        //   read();
                       data="";
                       getData(data);
                  
                         $('#name').val("");
       
                      }  
              }) 
            })


           /*   $(document).on('click','.btn-dell',function(e){
                var id = $(this).val();
                $.ajax({
                  type:'post',
                  url: "{{url('deleteSemester')}}",
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
                    url:"{{url('editSemester')}}",
                    data: {id:id},
                    success:function(data){

                      var update = $('#sem-update');
                      update.find('#id').val(data.id);
                      update.find('#name').val(data.name);
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
                    url:"{{url('editSemesterStatus')}}",
                    data: {id:id},
                    success:function(data){
                      var update = $('#sem-updatestatus');
                      update.find('#id').val(data.id);
                      update.find('#name').val(data.name);
                      update.find('#statusText').val(data.statusText);
                      update.find('#status').val(data.status);
                     $('#editStatus').modal('show'); 

                     //console.log($cat);  
                    }
                  })
                 })            

                


                 $('#sem-updatestatus').on('submit',function(e){
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

              $('#sem-update').on('submit',function(e){
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
$(document).on('click','.btn-dell',function(e){
                var id = $(this).val();
                $.ajax({
                  type:'get',
                  url: "{{url('getidSem')}}",
                  data: {id:id},
                  dataType:'json',
                  success:function(data)
                  {
                    var del = $('#sem-delete');
                      del.find('#id').val(data.id);
                      $('#deleteStatus').modal('show'); 
                  }
                })
    
              });
 $('#sem-delete').on('submit',function(e){
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

/*
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
*/
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

})

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
    
           
    <!-- page content -->
    
                     <br>
                     <br>
                     <br>


        
          
        
        @endsection

