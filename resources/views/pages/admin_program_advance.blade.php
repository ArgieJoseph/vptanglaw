@extends('admin.home')
@section('title','System Administrator')
@section('header','PUP - E D I S')
  @section('body')


      <!-- page content -->

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Advanced Education</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
              
                <!--pupqc pupmnl-->
                {!!Form::open(['url'=>'addAdvanceProgram','method'=>'POST','id'=>'addAP'])!!}


                      <div class="form-group">
                        <label class="col-md-2 control-label">Campus</label>
                        {!!Form::select('univ_id',$univs,null,['id'=>'univ_id','class'=>'form-control','placeholder'=>''])!!}
                      </div>

                     <!--Doctoral Progarms Masters-->
                      <div class="form-group">
                        <label class="col-md-2 control-label">Colleges / Programs</label>
                        {!!Form::select('colleges_id',$colleges,null,['id'=>'colleges_id','class'=>'form-control','placeholder'=>''])!!}

                      </div>

                      <div class="form-group">
                        <label class="col-md-2 control-label">Program</label>
 
                          <input type="text" name="name" id="name" class="form-control">
                      
                      </div>

                <div class="ln_solid"></div>
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
                    <h2>List of Advanced Education Programs</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="table-responsive">
                    @include('tables.admin_advance_table')
                  </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
       
          @include('admin.modal.admin_update_advance')
          

     @endsection


           
    <!-- page content -->
         <!-- Scripts -->
         @section('script')
           
    <!-- page content -->
    
                     <br>
                     <br>
                     <br>
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

            $('#addAP').on('submit',function(e){
              e.preventDefault();
              var name = $('#name').val();
             var univ_id = $('#univ_id').val();
              var colleges_id=$('#colleges_id').val();

              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'name':name,'univ_id':univ_id,'colleges_id':colleges_id},

                      success:function(data){
                        alert(data.msg);
                        //   read();
                        data="";
                        getData(data);
                         $('#name').val("");
                         $('#univ_id').val("");
                        $('#colleges_id').val("");
                      }  
              }) 
            })


              $(document).on('click','.btn-dell',function(e){
                var id = $(this).val();
                $.ajax({
                  type:'post',
                  url: "{{url('/deleteAdvanced')}}",
                  data: {id:id},
                  dataType:'json',
                  success:function(data)
                  {
                    $('tbody tr.id'+id).remove();
                     data="";
                    getData(data);
                  }
                })
    
              });
//--------------------------------------------
$(document).on('click','.btn-edit', function(e){
    var id = $(this).val();
    $.ajax({
      type:'get',
      url:"{{url('editAdvanceProgram')}}",
      data: {id:id},
      success:function(data){

        var update = $('#ap-update');
        update.find('#id').val(data.id);
        update.find('#univ_id').val(data.univ_id);
        update.find('#colleges_id').val(data.colleges_id);
        update.find('#p_id').val(data.p_id);
        update.find('#cp_id').val(data.cp_id);
        update.find('#name').val(data.name);
        update.find('#c_id').val(data.c_id);
       $('#editModal').modal('show'); 
       //console.log($cat);  
      }
    })

})


$('#ap-update').on('submit',function(e){
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

