@extends('admin.home')
@section('title','System Administrator')
@section('header','PUP - E D I S')


  @section('body')


      <!-- page content -->

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Higher Education</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                      {!!Form::open(['url'=>'addHigherEducation','method'=>'POST','id'=>'addHE'])!!}
                      {!!Form::hidden('status',null,['id'=>'status','class'=>'form-control'])!!}

                      <div class="form-group">
                        <label class="col-md-2 control-label">Campus</label>
                        {!!Form::select('univ_id',$univs,null,['id'=>'univ_id','class'=>'form-control','placeholder'=>''])!!}
                      </div>

                     <!--Doctoral Progarms Masters-->

                      <div class="form-group">
                        <label class="col-md-2 control-label">Course</label>
                       
                          <input type="text" name="name" id="name" class="form-control">
                        
                      </div>

                      <div class="form-group">
                        <label class="col-md-2 control-label">Major</label>
                  
                          <input type="text" name="mname" id="mname" class="form-control">
                        
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
                    <h2>List of Higher Education Programs</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      @include('tables.admin_higher_table')
                      
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
      @include('admin.modal.admin_delete_higher')
          @include('admin.modal.admin_update_higher')
          

          


           
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

            $('#addHE').on('submit',function(e){
              e.preventDefault();
              var name = $('#name').val();
              var mname = $('#mname').val();
             var univ_id = $('#univ_id').val();


              var url =$(this).attr('action');
              var post = $(this).attr('method');
              //var data = $(this).serialize();
              //$.post('table',{'code':code,'name':name,'address':address,'_token':$('input[name=_token]').val()}, function(data){
                $.ajax({
                type : post,
                url : url,
                data : {'course':name,'u_id':univ_id,'major':mname},

                      success:function(data){
                        alert(data.msg);
                        //   read();
                        data="";
                        getData(data);
                         $('#name').val("");
                         $('#mname').val("");
                         $('#univ_id').val("");
                      
                      }  
              }) 
            })


               $(document).on('click','.btn-dell',function(e){
                var id = $(this).val();
                $.ajax({
                  type:'get',
                  url: "{{url('getidHigher')}}",
                  data: {id:id},
                  dataType:'json',
                  success:function(data)
                  {
                    var del = $('#higher-del');
                      del.find('#id').val(data.id);
                      $('#deleteStatus').modal('show'); 
                  }
                })
    
              });
               
 $('#higher-del').on('submit',function(e){
                e.preventDefault();
                var data= $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.post(url,data,function(data){
                  //console.log(data);
                   data="";
                  getData(data);
                  $('#deleteStatus').modal('hide'); 
                })
              })
//--------------------------------------------
$(document).on('click','.btn-edit', function(e){
    var id = $(this).val();
    $.ajax({
      type:'get',
      url:"{{url('editHigherEducation')}}",
      data: {id:id},
      success:function(data){

        var update = $('#he-update');
        update.find('#id').val(data.id);
        update.find('#univ_id').val(data.u_id);
        update.find('#mname').val(data.major);
        update.find('#name').val(data.course);
       $('#editModal').modal('show'); 
       //console.log($cat);  
      }
    })

})


$('#he-update').on('submit',function(e){
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
        
        @endsection

