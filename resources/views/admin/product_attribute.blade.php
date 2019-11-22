@extends('layouts.master')
@section('noidung')
<main class="app-content">

  <button style="margin: 15px;" type="submit" class="btn btn-success" data-toggle="modal" data-target="#addPro"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>


  {{-- <div class="row"> --}}

   {{-- <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
          <table class="table table-hover" id="products-table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            
          </table>
          </div>
            </div>
          </div>
        
        </div> --}}


        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover" id="products-table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Price</th>
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
    {{-- </div> --}}
    <input type="hidden" name="" value="" placeholder=""> 
  </div>
  

</main>



<input type="hidden" id="hiddenquan">
<input type="hidden" id="hiddendetail">
<input type="hidden" id="hiddenupdate">
<input type="hidden"  id="hiddenup">
<input type="hidden"  id="hiddenadd1">
<input type="hidden" id="hiddenedit">
<input type="hidden" id="hiddeneditscolor">

<div class="modal fade" id="addPro">
  <div class="modal-dialog" >
    <div class="modal-content" style="width: 600px;">
      <div class="modal-header">


        <h4 class="modal-title">Thêm mới sản phẩm</h4>
      </div>
      {{csrf_field()}}
      <div class="modal-body" style="display: inherit;">
        <div style="width: 60%;vertical-align: top;" class="p">
          <div class="form-group">
            <label>Name(<span style="color: red">*</span>)</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            {{-- <input type="hidden" name="" value="" id="add_id"> --}}
          </div>
          <div class="form-group">
            <label>Price(<span style="color: red">*</span>)</label>
            <input  type="numeric" name="price" id="price" class="form-control"  placeholder="Price" class="priceAdd"></input>
          </div>
          <div class="form-group">
            <label>Description(<span style="color: red">*</span>)</label>
            <textarea name="content" id="editor1" rows="10" cols="80"  class="form-control">

            </textarea>
          </div>
          <div class="form-group">
            <label>Manufacturer(<span style="color: red">*</span>)</label>
            <textarea  type="text" name="manufacturer" id="manufacturer" class="form-control"  rows="4" placeholder="Manufacturer"></textarea>
          </div>
        </div>
        <div  style="width: 40%; vertical-align: top; margin-left: 50px;" class="p">
          <div class="post-profile">
            <div class="caption">
              <span style="font-weight: bold">Categories</span>  
            </div>
            <div class="post-categories">

              @if(count($categories)>0) @foreach ($categories as $category)
              <button type="" class="btn btn-primary category" value="{{$category->id}}" name='{{$category->name}}'  data-toggle="modal" data-target="#subbtn" >{{$category->name}}</button>
              @endforeach @endif        
              
            </div>
          </div>
          <div class="post-profile subcategories">
            <div class="caption">
              <span style="font-weight: bold">SubCategories</span>  
            </div>
            <div class="post-categories">
              <button type="" class="btn btn-primary btn-hidden"></button>    
            </div>
          </div>
          <div class="post-profile">
            <div class="caption">
              <span style="font-weight: bold">Action</span>  
            </div>
            <div class="post-action">
              <button type="submit" class="btn btn-success addPost" id="formAddPost" >Lưu</button>
              <button type="reset" class="btn btn-warning">Nhập lại</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadProduct">
  <div class="modal-dialog" style="width: 75%">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> --}}
        <h4 class="modal-title">Upload</h4>
      </div>
      <div class="modal-body">
        <div class="file-loading">
          <input id="file-1" type="file" name="file" multiple  data-overwrite-initial="false" data-min-file-count="2">
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addDetail">
  <div class="modal-dialog" style="width: 75%">
    <div class="modal-content" style="width: 650px;">
      <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> --}}
        <h4 class="modal-title">Add Detail</h4>
      </div>
      <div class="modal-body">
        <div style="width: 75%;vertical-align: top;" class="addDe">

          <table class="table-bordered table table-hover" id="scolors-table">
            <thead>
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>action</th>
              </tr>
            </thead>
          </table>
        </div>
        <div style="width: 20%;vertical-align: top;margin-left: 4%" class="addDe">
          <div class="form-group">
            <label>Size(<span style="color: red">*</span>)</label>
            <select name="size" id="size" class="form-control" required="required">
              @if(count($sizes)>0) @foreach ($sizes as $size)
              <option value="{{$size->id}}" name="size_id">{{$size->name}}</option>
              @endforeach @endif 
              
            </select>
            <br>
          </div>
          <div class="form-group abc">
            <label>Color(<span style="color: red">*</span>)</label>
            <input type="color" name="" class="form-control colorDetail">
          </div>
          <div class="form-group">
            <label>Quantity(<span style="color: red">*</span>)</label>
            <input type="numeric" name="" value="" class="form-control" id="quantity">
          </div>
          <div>
            <div class="caption">
              <span style="font-weight: bold">Action</span>  
            </div>
            <div class="post-action">
              <button type="submit" class="btn btn-success addthem" id="formAddDetail" >Lưu</button>
              <button type="reset" class="btn btn-warning">Nhập lại</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="showProduct">
  <div class="modal-dialog" style="width: 75%">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> --}}
        <h4 class="modal-title">Show</h4>
      </div>
      <div class="modal-body">
        <div class="s" style="width: 65%;vertical-align: top">
          <p style="font-weight: bold;">Code(<span style="color: red">*</span>) :</p>
          <p class="scode"></p>
          <hr width="75%">
          <p style="font-weight: bold;">Name(<span style="color: red">*</span>) :</p>
          <p class="sname"></p>
          <hr width="75%">
          <p style="font-weight: bold;">Price(<span style="color: red">*</span>) :</p>
          <p class="sprice"></p>
          <hr width="75%">
          <p style="font-weight: bold;">Description(<span style="color: red">*</span>) :</p>
          <p class="sdescription"></p>
          <hr width="75%">
          <p style="font-weight: bold;">Manufacturer(<span style="color: red">*</span>) :</p>
          <p class="smanufacturer"></p>
          <hr width="75%">
          <p style="font-weight: bold;">Size(<span style="color: red">*</span>) :</p>
          <p class="ssize"></p>
          <hr width="75%">
          <p style="font-weight: bold;">Color(<span style="color: red">*</span>) :</p>
          <p class="scolor"></p>
        </div>
        <div class="s" style="width: 34%;vertical-align: top">
          <p style="font-weight: bold;">Categories(<span style="color: red">*</span>) :</p>
          <button type="" class="btn btn-primary scategories"></button>
          <hr width="75%">
          <p style="font-weight: bold;">SubCategories(<span style="color: red">*</span>) :</p>
          <button type="" class="btn btn-primary ssubcategories"></button>
          <hr width="75%">
          
          <div id="carousel-id" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">

            </div>

          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="editProduct">
  @csrf
  <div class="modal-dialog"  style="width: 75%">
    <div class="modal-content" style="width: 600px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body" style="display: inherit;">
        <form  method="POST" role="form">
          <div style="width: 65%;vertical-align: top;" class="p">
            <div class="form-group">
              <label>Code(<span style="color: red">*</span>)</label>
              <input type="text" name="code" id="ecode" class="form-control" disabled >
              {{-- <input type="hidden" name="" value="" id="add_id"> --}}
            </div>
            <div class="form-group">
              <label>Name(<span style="color: red">*</span>)</label>
              <input type="text" name="name" id="ename" class="form-control" >
              {{-- <input type="hidden" name="" value="" id="add_id"> --}}
            </div>
            <div class="form-group">
              <label>Price(<span style="color: red">*</span>)</label>
              <input  type="text" name="price" id="eprice" class="form-control" ></input>
            </div>
            <div class="form-group">
              <label>Description(<span style="color: red">*</span>)</label>
              <textarea name="content" id="editor2" rows="10" cols="80"  class="form-control">

              </textarea>
            </div>
            <div class="form-group">
              <label>Manufacturer(<span style="color: red">*</span>)</label>
              <textarea  type="text" name="manufacturer" id="emanufacturer" class="form-control"  rows="4" ></textarea>
            </div>

            
          </div>
          <div  style="width: 34%;vertical-align: top;" class="p">
            <div class="post-profile">
              <div class="caption">
                <span style="font-weight: bold">Categories</span>  
              </div>
              <div class="post-categories">
                @if(count($categories)>0) @foreach ($categories as $category)
                <button type="" class="btn btn-primary ecategory" value="{{$category->id}}" name='{{$category->name}}'  data-toggle="modal" data-target="#subbtn" >{{$category->name}}</button>
                @endforeach @endif        
              </div>
            </div>
            <div class="post-profile esubcategories">
              <div class="caption">
                <span style="font-weight: bold">SubCategories</span>  
              </div>
              <div class="post-categories">
                <button type="" class="btn btn-primary ebtn-hidden"></button>
              </div>
            </div>


            <div class="post-profile">
              <div class="caption">
                <span style="font-weight: bold">Action</span>  
              </div>
              <div class="post-action">
                <button type="submit" class="btn btn-success ePost" id="formEditPost" >Lưu</button>
                <button type="reset" class="btn btn-warning">Nhập lại</button>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="editDetail">
  <div class="modal-dialog" style="width: 25%">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> --}}
        <h4 class="modal-title">Edit Detail</h4>
      </div>
      <div class="modal-body">
        <div>
          <div class="form-group">
            <label>Size(<span style="color: red">*</span>)</label>
            <select name="size" id="esize" class="form-control" required="required">
              @if(count($sizes)>0) @foreach ($sizes as $size)
              <option value="{{$size->id}}" name="size_id">{{$size->name}}</option>
              @endforeach @endif 
              
            </select>
            <br>
          </div>
          <div class="form-group abc">
            <label>Color(<span style="color: red">*</span>)</label>
            <input type="color" name="" class="form-control ecolorDetail">

          </div>
          <div class="form-group">
            <label>Quantity(<span style="color: red">*</span>)</label>
            <input type="numeric" name="" value="" class="form-control" id="equantity">
          </div>
          <div>
            <div class="caption">
              <span style="font-weight: bold">Action</span>  
            </div>
            <div class="post-action">
              <button type="submit" class="btn btn-success " id="formEditDetail" >Lưu</button>
              <button type="reset" class="btn btn-warning">Nhập lại</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="subbtn">
  <div class="modal-dialog" style="width: 25%">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">SubCategories</h4>
      </div>
      <div class="modal-body submodal">

      </div>

    </div>
  </div>
</div>  



@endsection
@section('foot')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('.subcategories').hide();
  $(function(){
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    $('#products-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ asset('') }}admin/products/list',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'image', name: 'image' },
      { data: 'price', name: 'price' },
      { data: 'action', name: 'action' }
      ]
    });
    $(document).on('click', '.DetailAdd', function(e){
      e.preventDefault();
      var id = $(this).attr('product_id');
      $('.addthem').attr('product_id', id);

    });

    $('#formAddPost').click(function(){

      var url1="{{ asset('') }}admin/products";
      var formData1 = new FormData();
      formData1.append('name',$('#name').val());
      formData1.append('price',$('#price').val());
      formData1.append('manufacturer',$('#manufacturer').val());
      formData1.append('description',CKEDITOR.instances['editor1'].getData());
      formData1.append('_token',$('input[name="_token"]').val());
      formData1.append('subcate_id',$('.btn-hidden').attr('subcate_id'));
       // console.log(formData1);

       $.ajax({
        url:url1,
        type:'POST',
        processData: false,
        contentType: false,
        data:formData1,
        success:function(response){
          toastr.success('Thêm mới thành công');
          setTimeout(function(){
            $('#products-table').DataTable().ajax.reload(null, false);
            $('#addPro').modal('hide');
          }, 1000);       
        },
        error:function(jqXHR,textStatus,errorThrown){
          if (jqXHR.responseJSON.errors.name!==undefined){
            toastr.error(jqXHR.responseJSON.errors.name[0]);
          }
          if (jqXHR.responseJSON.errors.description!==undefined){
            toastr.error(jqXHR.responseJSON.errors.description[0]);
          }
          if (jqXHR.responseJSON.errors.price!==undefined){
            toastr.error(jqXHR.responseJSON.errors.price[0]);
          }
          if (jqXHR.responseJSON.errors.manufacturer!==undefined){
            toastr.error(jqXHR.responseJSON.errors.manufacturer[0]);
          }
          if (jqXHR.responseJSON.errors.subcate_id!==undefined){
            toastr.error(jqXHR.responseJSON.errors.subcate_id[0]);
          }

        }
      });

     });
    $(document).on('click', '.category', function(e){
      $('.submodal').text(' ');
      e.preventDefault();
      var id=$(this).val();
      $('.btn-hidden').attr('title',$(this).attr('name'));
      $.ajax({
        type: 'get',
        url:" {{ asset('') }}admin/subcategory/"+id,
        success: function(response){

          $.each( response.data, function( ) {
            var html='<button type="" class="btn btn-primary addsubcate" value=" '+$(this)[0].name+'" subcate_id='+$(this)[0].id+'>'+$(this)[0].name+'</button>&nbsp;'
            $('.submodal').append(html);
          });

        }
      })      
    });
    $(document).on('click', '.addsubcate', function(e){
      $('.btn-hidden').text($(this).val());
      $('.btn-hidden').attr('subcate_id',$(this).attr('subcate_id'));
      $('.subcategories').show();
    });

    $(document).on('click', '.addthem', function(e){
      e.preventDefault();
      var id=$('.addthem').attr('product_id');
      var url2="{{ asset('') }}admin/adddetail";
      var formData2 = new FormData();
      formData2.append('size',$('#size').val());
      formData2.append('color',$('.colorDetail').val());
      formData2.append('quantity',$('#quantity').val());
      formData2.append('id',id);
      $.ajax({
        url:url2,
        type:'POST',
        processData: false,
        contentType: false,
        data:formData2,
        success:function(response){
          toastr.success('Thêm mới thành công');
          setTimeout(function(){
            $('#scolors-table').DataTable().ajax.reload(null, false);
          // $('#addDetail').modal('hide');
        }, 800);

        }
      });
    });

    $(document).on('click', '.DetailAdd', function(e){
      e.preventDefault();
      var id=$(this).attr('product_id');
    // alert(id);
    var color_table = $('#scolors-table').DataTable();
    color_table.destroy();
    $('#hiddenadd').attr('product_id',id);
    

    $('#scolors-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ asset('') }}admin/products/addlist/'+id,
      columns: [
      { data: 'code', name: 'code' },
      { data: 'name', name: 'name' },
      { data: 'size_id', name: 'size_id' },
      { data: 'color_id', name: 'color_id' },
      { data: 'quantity', name: 'quantity' },
      { data: 'action', name: 'action' }
      ]
    });
  });


    $("#file-1").fileinput({
      theme: 'fa',
      uploadUrl: "{{ asset('') }}admin/products/upload",
      uploadExtraData: function() {
        return {
          product_id: $('#hiddenup').attr('product_id'),
          _token: $("input[name='_token']").val()
        };
      },
      allowedFileExtensions: ['jpg', 'png', 'gif'],
      overwriteInitial: false,
      maxFileSize:2000,
      maxFilesNum: 10,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      },

    });
    $('#file-1').on('fileuploaded', function() {

      $('#products-table').DataTable().ajax.reload(null, false);
    });

    $(document).on('click', '.uploadImg', function(e){
      e.preventDefault();
      var id=$(this).attr('product_id');

      $('#uploadProduct').modal('show');
      $('#hiddenup').attr('product_id',id);

    });

    $(document).on('click','#showDetail',function(e){
      $('.carousel-inner').text('');
      $('.ssize').text('');
      $('.scolor').text('');
      e.preventDefault();
      var id= $(this).attr("product_id");
      var url5="{{ asset('') }}admin/products/"+id;
      $.ajax({
        type: 'get',
        url: url5,
        success: function(response){
          $('.scode').text(response.array.code) ;
          $('.sname').text(response.array.name) ;
          $('.sprice').text(response.array.price) ;
          $('.sdescription').html(response.array.description) ;
          $('.smanufacturer').text(response.array.manufacturer) ;

          $.each(response.data,function(){
            console.log($(this));
            var html='<button type="" class="btn btn-primary" value=" '+$(this)[0]+'">'+$(this)[0]+'</button>&nbsp;'
            $('.ssize').append(html);
          })

          for (var i = response.color.length - 1; i >= 0; i--) {

            var html='<div style="height:30px;width:30px;border-radius:50%;margin-right:10px;background:'+response.color[i] +'" class="showcolor"> </div>';
            $('.scolor').append(html);  
          }
          $('.scategories').text(response.array.cate);
          $('.ssubcategories').text(response.array.namecate);
          console.log(response.image);
          $.each(response.image,function(key, value){
          // console.log(value.thumbnail); 
          var html='<div class="item " ><img class="anha"   src="{{ asset('') }}storage/'+(this).thumbnail+'" style="max-width:100%;height:400px"></div>';
          $('.carousel-inner').append(html);
          
        })
          document.getElementsByClassName('item')[0].className='item active';
        }
      })  
    })


    $(document).on("click",".editProduct",function(){
      var id= $(this).attr("product_id");
      $('#hiddenedit').attr('product_id',id);
      var url="{{ asset('') }}admin/products/"+id+"/edit";
      $.ajax({
        type: 'get',
        url: url,
        success: function(response){
          $('#ecode').val(response.code);
          $('#ename').val(response.name);
          $('#eprice').val(response.price);
          $('#emanufacturer').val(response.manufacturer);
          CKEDITOR.instances['editor2'].setData(response.description);
          $('#btn-updateUser').attr('data-id',id);
          $('.ebtn-hidden').attr('subcate_id',response.subcate_id);
          $('.ebtn-hidden').text(response.namecate);
        }
      })      
    });

    $(document).on('click', '.eaddsubcate', function(e){
      $('.ebtn-hidden').text($(this).val());
      $('.ebtn-hidden').attr('subcate_id',$(this).attr('subcate_id'));

    });

    $(document).on('click', '.ecategory', function(e){
      $('.submodal').text(' ');
      e.preventDefault();
      var id=$(this).val();
      $('.ebtn-hidden').attr('title',$(this).attr('name'));
      $.ajax({
        type: 'get',
        url:" {{ asset('') }}admin/subcategory/"+id,
        success: function(response){

          $.each( response.data, function( ) {
            var html='<button type="" class="btn btn-primary eaddsubcate" value=" '+$(this)[0].name+'" subcate_id='+$(this)[0].id+'>'+$(this)[0].name+'</button>&nbsp;'
            $('.submodal').append(html);
          });

        }
      })      
    });

    $('#formEditPost').on('click', function(e){
      e.preventDefault();
      var id= $('#hiddenedit').attr('product_id');
      var url3="{{ asset('') }}admin/products/"+id;

      var formData3 = new FormData();
      formData3.append('code',$('#ecode').val());
      formData3.append('name',$('#ename').val());
      formData3.append('price',$('#eprice').val());
      formData3.append('manufacturer',$('#emanufacturer').val());
      formData3.append('description',CKEDITOR.instances['editor2'].getData());
      formData3.append('subcate_id',$('.ebtn-hidden').attr('subcate_id'));
      formData3.append('_token',$('input[name="_token"]').val());
      $.ajax({
        url:url3,
        type:'POST',
        processData: false,
        contentType: false,
        data:formData3,
        success:function(response){
          toastr.success('Sửa thành công');

          setTimeout(function(){
            $('#products-table').DataTable().ajax.reload(null, false);
            $('#editProduct').modal('hide');
          }, 1000);
        },
        error:function(jqXHR,textStatus,errorThrown){
          if (jqXHR.responseJSON.errors.name!==undefined){
            toastr.error(jqXHR.responseJSON.errors.name[0]);
          }
          if (jqXHR.responseJSON.errors.description!==undefined){
            toastr.error(jqXHR.responseJSON.errors.description[0]);
          }
          if (jqXHR.responseJSON.errors.price!==undefined){
            toastr.error(jqXHR.responseJSON.errors.price[0]);
          }
          if (jqXHR.responseJSON.errors.manufacturer!==undefined){
            toastr.error(jqXHR.responseJSON.errors.manufacturer[0]);
          }
          if (jqXHR.responseJSON.errors.subcate_id!==undefined){
            toastr.error(jqXHR.responseJSON.errors.subcate_id[0]);
          }

        }
      });
    });

    $(document).on("click",".editDetail",function(){
      var id= $(this).attr("product_id");
      $('#hiddenupdate').attr('product_id',id);
      $('#hiddendetail').attr('pro_id',$(this).val());
      $('#hiddenquan').attr('quantity_id',$(this).attr('quantity_id'));
      var url="{{ asset('')}}admin/addDetail/"+id+"/edit";
      $.ajax({
        type: 'get',
        url: url,
        success: function(response){
          $('#esize').append('<option>'+response.size+'</option>');
          $('.ecolorDetail').val(response.color);
          $('#equantity').val(response.quantity);

          $('#btn-updateUser').attr('data-id',id);
        }
      })      
    });

    $('#formEditDetail').on('click',function(e){
    var id= $('#hiddenupdate').attr('product_id');
    var url4="{{ asset('') }}admin/addDetail/"+id;
    var formData4 = new FormData();
    formData4.append('size',$('#esize').val());
    formData4.append('color',$('.ecolorDetail').val());
    formData4.append('quantity',$('#equantity').val());
    formData4.append('product_id',$('#hiddendetail').attr('pro_id'));
    formData4.append('quantity_id',$('#hiddenquan').attr('quantity_id'));
    $.ajax({
      url:url4,
      type:'POST',
      processData: false,
      contentType: false,
      data:formData4,
      success:function(response){
        toastr.success('Sửa thành công');

        setTimeout(function(){
          $('#scolors-table').DataTable().ajax.reload(null, false);
          $('#editDetail').modal('hide');
        }, 1000);
        

      }
    });

  });
    $(document).on('click','.deletePro',function(){
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
          url: "{{ asset('')}}admin/products/"+id,
          success: function(response){

            $('#products-table').DataTable().ajax.reload(null, false);
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

    $(document).on('click','.deleteDe',function(){
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
          url: "{{ asset('') }}admin/addDetail/"+id,
          success: function(response){
            $('#scolors-table').DataTable().ajax.reload(null, false);
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

    $(document).on('keyup','#price',function(){
    if(parseInt($('#price').val())<0){
      setTimeout(function(){
        $('#price').val('');
      }, 1000);

      toastr.error('Negative integer is not allowed!');
    }
  })

    $(document).on('keyup','#eprice',function(){
    if(parseInt($('#price').val())<0){
      setTimeout(function(){
        $('#eprice').val('');
      }, 1000);

      toastr.error('Negative integer is not allowed!');
    }
  })




  });

</script>

@endsection