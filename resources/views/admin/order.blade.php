@extends('layouts.master')
@section('noidung')
<main class="app-content">


        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover" id="orders-table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Code</th>
                      <th>Status</th>
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
<input type="hidden" id="hiddenOrder">
<input type="hidden" id="hiddenvalue">

</main>
<div class="modal fade" id="ChangingStatus">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title">ChangingStatus</h4>
      </div>
      <div class="modal-body">
        <div class="row row-pb-md">
          <div class="col-md-10 col-md-offset-1">
            <div class="process-wrap">
              <div class="process text-center active" >
                <p class="confirm aaaa" status="0"><span>01</span></p>
                <h3>Confirm</h3>
              </div>
              <div class="process text-center">
                <p class="waiting aaaa"  status="1"><span>02</span></p>
                <h3>waiting for delivery</h3>
              </div>
              <div class="process text-center">
                <p class="delivering aaaa"  status="2"><span>03</span></p>
                <h3>Delivering</h3>
              </div>
              <div class="process text-center">
                <p class="complete aaaa"  status="3"><span>04</span></p>
                <h3>Order Complete</h3>
              </div>
              <div class="process text-center">
                <p class="delete aaaa"  status="4"><span>05</span></p>
                <h3>Deleted</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success saveStatus">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="orderDetail">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 120%;">
      <div class="modal-header">
        
        <h4 class="modal-title">Oder Detail</h4>
      </div>
      <div class="modal-body">
        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Image</th>
              <th>Number</th>
              <th>Price</th>
              <th>Size</th>
              <th>Color</th>
            </tr>
          </thead>
          <tbody class="orderTbody">
            
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="UserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">User</h4>
      </div>
      <div class="modal-body">
        
        <div class="userShow">
          <p> Tên: <span class="name" style="color: red; font-weight: bold;font-size: 40px"></span></p>
          <p>Email: <span class="email"></span></p>
          <p> Mobile: <span class="mobile"></span></p>
          <p>Address: <span class="address"></span></p>
        </div>

      </div>
    </div>
  </div>
</div>







@endsection
@section('style')
<style>
.process-wrap {
  width: 100%;
  display: block;
  float: left; }

  .process {
    position: relative;
    float: left;
    width: 33.333%;
    z-index: 0; }
    .process:after {
      position: absolute;
      top: 35%;
      right: -37%;
      content: '';
      width: 100%;
      height: 1px;
      background: #f0f0f0;
      z-index: -1; }
      .process:last-child:after {
        display: none; }
        .process p {
          position: relative;
          width: 80px;
          height: 80px;
          display: table;
          border: 2px solid #fafafa;
          margin: 0 auto;
          margin-bottom: 20px;
          background: #fff;
          z-index: 1;
          font-weight: 400;
          -webkit-border-radius: 50%;
          -moz-border-radius: 50%;
          -ms-border-radius: 50%;
          border-radius: 50%; }
          .process p span {
            display: table-cell;
            vertical-align: middle; }
            .process h3 {
              margin-bottom: 0;
              font-size: 12px;
              text-transform: uppercase;
              letter-spacing: 1px; }
              .process.active p {
                border: 2px solid #f0f0f0; }
                .process.active p span {
                  color: #FFC300; }
                </style>
                @endsection
@section('foot')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#orders-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ asset('') }}admin/order/list',
    columns: [
    { data: 'id', name: 'id' },
    { data: 'code', name: 'code' },
    { data: 'status', name: 'status' },
    { data: 'action', name: 'action' }
    ]
  });

    $(document).on('click','.change',function(){
    $('#hiddenOrder').attr('order_id',$(this).attr('order_id'));
    var url="{{ asset('') }}admin/status/"+$(this).attr('order_id');
    $.ajax({
      type: 'get',
      url: url,
      success: function(response){
        $('.process').removeClass('active');
        $('.aaaa').eq(response).parent().addClass('active');
        for (var i = 0; i <response; i++) {
          if($('.aaaa').eq(i).attr('status')==i){

            $('.aaaa').eq(i).click(function(){
               toastr.error('Disabled!');
              return false;
            } );
          }
          
          
        }
      }
    });
  });
    $(document).on('click','.aaaa',function(){
    $('.process').removeClass('active');
    $(this).parent().addClass('active');
    $('#hiddenvalue').attr('value',$(this).attr('status'));
  })
      $(document).on('click','.saveStatus',function(){
    var formData= new FormData();
    formData.append('status',$('#hiddenvalue').attr('value'));
    formData.append('order_id',$('#hiddenOrder').attr('order_id'));
    var url= "{{ asset('') }}admin/order/update";
    $.ajax({
      url:url,
      type:'POST',
      processData: false,
      contentType: false,
      data:formData,
      success:function(response){

        $('#orders-table').DataTable().ajax.reload(null, false);
        setTimeout(function(){
          $('#ChangingStatus').modal('hide');
        },800);
      }
    });
  });
      $(document).on('click','.detailOrder',function(e){
    e.preventDefault();
    $('.orderTbody').text('');
    var url="{{ asset('') }}admin/order/"+$(this).attr('order_id');
    $.ajax({
      type: 'get',
      url: url,
      success: function(response){
        for (var i = 0; i < response.length; i++) {
          var html='<tr><td>'+response[i].order_id+'</td><td>'+response[i].name+'</td><td style="width:20%"><img src="{{ asset('') }}storage/'+response[i].image+'" alt="" style="max-width:80%"></td><td style="width:15%">'+response[i].number+'</td><td>$'+response[i].price+'</td><td style="width:15%">'+response[i].size+'</td><td><span style="background-color:'+response[i].color+';padding:5px 40px"></span></td></tr>';
          $('.orderTbody').append(html);
        }
        
      }
    });
  });

 
  




</script>

@endsection