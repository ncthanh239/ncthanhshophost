@extends('layouts.master')
@section('noidung')
<input type="hidden" id="hiddenuser">
<input type="hidden" id="hiddenupdate">
<main class="app-content">

  <div class="col-md-4">

    <h3>Profile User</h3>
    <button type="submit" class="btn btn-success " data-toggle="modal" data-target="#addUser"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>
  </div>

  {{-- <div class="row"> --}}
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover" id="users-table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Action</th>
                </tr>
              </thead>

            </table>
          </div>
        </div>
      </div>
    {{-- </div> --}}
    <input type="hidden" name="" value="" placeholder=""> 
  </div>
</main>

<div class="modal fade" id="addUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Thêm mới user</h4>
      </div>
      <div class="modal-body">
       <label>Name</label>
       <input type="text" name=""  class="aname form-control">
       <label>Email</label>
       <input type="email" class="aemail form-control"  ">
       <label>Password</label>
       <input type="password" name="password" value="" class="password form-control">
       <label>Confirm password</label>
       <input type="password" name="cpassword" value="" class="cpassword form-control">
       <label>Mobile</label>
       <input type="numeric" class="amobile form-control" >
       
       <label>Address</label>
       <input type="text" name="" value="" class="aaddress form-control">
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-success userAdd">Add</button>
    </div>
  </div>
</div>
</div>





@endsection
@section('foot')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'users/list',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'mobile', name: 'mobile' },
      { data: 'action', name: 'action' }
      ]
    });

    $(document).on('click','.userAdd',function(e){
     e.preventDefault();
     var url2="{{ asset('') }}admin/users";
     var formData = new FormData();
     formData.append('name',$('.aname').val());
     formData.append('email',$('.aemail').val());
     formData.append('mobile',$('.amobile').val());
     formData.append('password',$('.password').val());
     formData.append('address',$('.aaddress').val());

     $.ajax({
      url:url2,
      type:'POST',
      processData: false,
      contentType: false,
      data:formData,
      success:function(response){
        toastr.success('Thêm mới thành công');
        setTimeout(function(){
          $('#addUser').modal('hide');
          $('#users-table').DataTable().ajax.reload(null, false);
        }, 1000);    
      },
      error:function(jqXHR,textStatus,errorThrown){
       if (jqXHR.responseJSON.errors.name!==undefined){
        toastr.error(jqXHR.responseJSON.errors.name[0]);
      }
      if (jqXHR.responseJSON.errors.email!==undefined){
        toastr.error(jqXHR.responseJSON.errors.email[0]);
      }
      if (jqXHR.responseJSON.errors.mobile!==undefined){
        toastr.error(jqXHR.responseJSON.errors.mobile[0]);
      }
      if (jqXHR.responseJSON.errors.password!==undefined){
        toastr.error(jqXHR.responseJSON.errors.password[0]);
      }
      if (jqXHR.responseJSON.errors.address!==undefined){
        toastr.error(jqXHR.responseJSON.errors.address[0]);
      }
    }
  });
   })

    $(document).on('click','.btn-danger',function(){
      var id=$(this).data('id');
      alert
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: 'delete',
            url: "{{ asset('') }}admin/users/"+id,
            success: function(response){
              $('#users-table').DataTable().ajax.reload(null, false);
              toastr.success('Bạn đã xóa thành công');
            }
          }); 
          swal("Poof! Your file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Cancel product deletion!!");
        }
      });
    });

    

  }); 
</script>
@endsection