@extends('layouts.master')
@section('noidung')
    <main class="app-content">
      
      <div class="col-md-4">
      <h3>Add SubCategory</h3>
      <input type="text" name="newatt" class="newatt form-control">
      <label for="">Category(<span style="color: red">*</span>)</label>
      <select name="add_subPost" class="form-control" id="add_subPost">
        @if(count($categories)>0) @foreach ($categories as $category)
        <option value="{{$category->id}}" class="subcategory" name="subcategory_id">{{$category->name}}</option>
        @endforeach @endif 
      </select>
      <button type="submit" class="btn btn-success addNew"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>
    </div>
    <br>
      
      {{-- <div class="row"> --}}
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover" id="subcats-table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Category</th>
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



@endsection
@section('foot')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  $(function(){
    $('#subcats-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ asset('') }}admin/subcategory/list',
        columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'slug', name: 'slug' },
          { data: 'subcategory_id', name: 'subcategory_id' },
          { data: 'action', name: 'action' }
          ]
      });


    $('.addNew').on('click', function(e){
          e.preventDefault();
          var link="{{ asset('') }}admin/subcategory";
          
          $.ajax({
            url:link,
            type:'POST',
            data:{
              name:$('.newatt').val(),
              subcategory_id:$('#add_subPost').val(),
            },
            success:function(){
              toastr.success('Thêm mới thành công');
              $('#subcats-table').DataTable().ajax.reload(null, false);       
            },
            
            error:function(jqXHR,textStatus,errorThrown){
              if (jqXHR.responseJSON.errors.name!==undefined){
                toastr.error(jqXHR.responseJSON.errors.name[0]);
              }

            }
          });
        });

    $(document).on('click','.btn-danger',function(){
        var id=$(this).data('id');
        alert
        swal({
          title: "Bạn có muốn xóa không?",
          text: "Sau khi xóa bạn sẽ không thể khôi phục được tệp!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: 'delete',
              url: "{{ asset('') }}admin/subcategory/"+id,
              success: function(response){
                $('#subcats-table').DataTable().ajax.reload(null, false);
              }
            }); 
            swal("Tệp của bạn đã được xóa!", {
              icon: "success",
            });
          } else {
            swal("Hủy xóa thành công!!");
          }
        });
      });


  });
</script>

@endsection