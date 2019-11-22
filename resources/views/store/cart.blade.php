@extends('layouts.masterstore')
@section('noidung')
<div class="check">
    <div class="container">	 
        <div class="col-md-3 cart-total">
            <a class="continue" href="#">Continue to basket</a>
            <div class="price-details">
                <h3>Price Details</h3>
                <span>Subtotal</span>
                <span class="total1">{{Cart::subtotal()}}</span>
                <span>Discount</span>
                <span class="total1">${{Cart::tax()}}</span>
                <span>Delivery Charges</span>
                <span class="total1">$0</span>
                <div class="clearfix"></div>				 
            </div>
            <hr class="featurette-divider">
            <ul class="total_price">
             <li class="last_price"> <h4>TOTAL</h4></li>	
             <li class="last_price"><span>${{Cart::total()}}</span></li>
             <div class="clearfix"> </div>
         </ul> 
         <div class="clearfix"></div>
         <a class="order" href="" class="button-submit btn" data-toggle="modal" data-target="#orderModal">Place Order</a>
     </div>
     <div class="col-md-9 cart-items">
        <h1>My Shopping Bag </h1>

        <div class="cart-header">
           @foreach (Cart::content() as $row)
           <div class="close1"><span rowId="{{$row->rowId}}" class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>

           <div class="cart-sec simpleCart_shelfItem" id="div_{{$row->rowId}}">
            <div class="cart-item cyc">
                <img src="{{ asset('') }}storage/{{$row->options->img}}" class="img-responsive" alt=""/>
            </div>
            <div class="cart-item-info">
                <ul class="qty">


                    <li> Color:<span class="color" style="background-color: {{$row->options->color}};padding: 3px 30px"></span></li>
                    <li><p>Size : {{$row->options->size}}</p></li>
                    <li><p>Qty : {{$row->qty}}</p></li>
                    <li><p>Price each : ${{$row->price}}</p></li>
                </ul>
                <div class="delivery">
                   <p>Total : ${{$row->price*$row->qty}}</p>

                   <div class="clearfix"></div>
               </div>	
           </div>
           <div class="clearfix"></div>

       </div>
       @endforeach
   </div>


</div>

<div class="clearfix"> </div>
</div>
</div>


 @if (Cart::count()!== 0)
<div class="modal fade" id="orderModal">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Payment</h4>
            </div>
            <div class="modal-body" > 
                @if (Auth::user()==null)
                {{-- <div class="infouser">
                    <div style="text-align: center;">
                        <h3>Thông tin người mua</h3>
                    </div>
                    
                    <br>
                    <div class="a">
                        <div class="form-group">
                            <label for="">Name(<span style="color: red">*</span>)</label>
                            <input type="text" class="form-control name" id="" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="">Email(<span style="color: red">*</span>)</label>
                            <input type="text" class="form-control email" id="" placeholder="Email">
                        </div>
                    </div>
                    <div class="a">
                        <div class="form-group">
                            <label for="">Address(<span style="color: red">*</span>)</label>
                            <input type="text" class="form-control address" id="" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="">Mobile(<span style="color: red">*</span>)</label>
                            <input type="numeric" class="form-control mobile" id="" placeholder="Mobile">
                        </div>
                    </div>
                    
                    
                </div> --}}
                <script type="text/javascript">
                    alert('Bạn cần đăng nhập để tiếp tục!');
                    setTimeout(function(){
                        window.location.href="{{ asset('') }}login"
                    });
                </script>
               
                @endif  
                @if (Auth::user() !==null)
                <div>
                    {{-- <legend>Adrress</legend>
                    @php
                    $address=\App\Address::where('user_id',Auth::user()->id)->get();
                    @endphp
                    @foreach ($address as $element)
                    <p class="addessInput"><input type="radio" name="uaddress" value="{{$element->address}}" checked>&nbsp;{{$element->address}}</p>
                    @endforeach --}}
                       <div style="text-align: center;">
                        <h3>Thông tin người mua</h3>
                    </div>
                    
                    <br>
                    <div class="a">
                        <div class="form-group">
                            <label for="">Name(<span style="color: red">*</span>)</label>
                            <input type="text" class="form-control name" id="" placeholder="Name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="">Email(<span style="color: red">*</span>)</label>
                            <input type="text" class="form-control email" id="" placeholder="Email" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="a">
                        <div class="form-group">
                            <label for="">Address(<span style="color: red">*</span>)</label>
                            <input type="text" class="form-control address" id="" placeholder="Address" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Mobile(<span style="color: red">*</span>)</label>
                            <input type="numeric" class="form-control mobile" id="" placeholder="Mobile" value="{{Auth::user()->mobile}}">
                        </div>
                    </div>

                </div>
                <hr>
                @endif

                <div class="listproduct">
                            <div class="col-md-3 cart-total">
            {{-- <a class="continue" href="#">Continue to basket</a> --}}
            <div class="price-details">
                <h3>Price Details</h3>
                <span>Subtotal</span>
                <span class="total1">{{Cart::subtotal()}}</span>
                <span>Discount</span>
                <span class="total1">${{Cart::tax()}}</span>
                <span>Delivery Charges</span>
                <span class="total1">$0</span>
                <div class="clearfix"></div>                 
            </div>
            <hr class="featurette-divider">
            <ul class="total_price">
             <li class="last_price"> <h4>TOTAL</h4></li>    
             <li class="last_price"><span>${{Cart::total()}}</span></li>
             <div class="clearfix"> </div>
         </ul> 
         <div class="clearfix"></div>
         
     </div>
     <div class="col-md-9 cart-items">
       {{--  <h1>My Shopping Bag </h1> --}}

        <div class="cart-header">
           @foreach (Cart::content() as $row)
        

           <div class="cart-sec simpleCart_shelfItem" id="div_{{$row->rowId}}">
            <div class="cart-item cyc">
                <img src="{{ asset('') }}storage/{{$row->options->img}}" class="img-responsive" alt=""/>
            </div>
            <div class="cart-item-info">
                <ul class="qty">


                    <li> Color:<span class="color" style="background-color: {{$row->options->color}};padding: 3px 30px"></span></li>
                    <li><p>Size : {{$row->options->size}}</p></li>
                    <li><p>Qty : {{$row->qty}}</p></li>
                    <li><p>Price each : ${{$row->price}}</p></li>
                </ul>
                <div class="delivery">
                   <p>Total : ${{$row->price*$row->qty}}</p>

                   <div class="clearfix"></div>
               </div>   
           </div>
           <div class="clearfix"></div>

       </div>
       @endforeach
   </div>


</div>

{{-- <div class="clearfix"> </div> --}}


                <button type="button" class="btn btn-order" style="background-color: orange; color: white;">Order</button>         
            </div>

        </div>
    </div>
</div>
@endif
 @endsection 

@section('foot')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });  

            $(document).on('click','.glyphicon-remove',function(){
        var id=$(this).attr('rowId');
        alert
        swal({
            title: "Bạn có muốn xóa sản phẩm khỏi giỏ hàng không?",
            text: "Sau khi xóa bạn sẽ không thể khôi phục được thông tin!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    url: "{{ asset('') }}cart/"+id,
                    success: function(response){
                        $('#div_'+id).remove();
                        $('#pro_'+id).remove();
                    }
                }); 
                swal("Tệp của bạn đã được xóa!", {
                    icon: "success",
                });
            } else {
                swal("Hủy xóa thành công!!");
            }
        });
    }) 

        $(document).on('click','.btn-order',function(){
        $('#orderModal').hide();
        var url='{{ asset('') }}cart/order';
        var formData= new FormData();
        formData.append('name',$('.name').val());
        formData.append('email',$('.email').val());
        formData.append('address',$('.address').val());
        formData.append('mobile',$('.mobile').val());
        formData.append('uaddress',$('input[name=uaddress]:checked').val());
        $.ajax({
            url:url,
            type:'POST',
            processData: false,
            contentType: false,
            data:formData,
            success:function(response){
                $('#orderModal').modal('hide');
                toastr.success('Đặt hàng thành công!');
                setTimeout(function(){
                    window.location.href="{{ asset('') }}cart"
                },800);

            },
            error:function(jqXHR,textStatus,errorThrown){
            toastr.error('Đặt hàng không thành công!');
            setTimeout(function(){
                    window.location.href="{{ asset('') }}cart"
                },800);

          }


        });
    })




    });        
    

</script>


@endsection       