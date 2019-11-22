    @extends('layouts.masterstore');
    @section('noidung')
    <input type="hidden" id="hiddensize">
    <input type="hidden" id="hiddencolor">
    <input type="hidden" id="code" value={{$array['code']}}>
    <div class="showcase-grid">
        <div class="container">
            <div class="col-md-8 showcase">
                <div class="flexslider">
                  <ul class="slides">
                    @if(isset($array['images']) && count($array['images']) > 0)
                    @foreach ($array['images'] as $image)
                    <li data-thumb="{{ asset('') }}storage/{{$image}}">
                        <div class="thumb-image"> <img src="{{ asset('') }}storage/{{$image}}" data-imagezoom="true" class="img-responsive"> </div>
                    </li>
                    @endforeach
                    @endif



                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-4 showcase">
            <div class="showcase-rt-top">
                <div class="pull-left shoe-name">
                    <h3>{{$array['name']}}</h3>
                    <p>{{$array['manufacturer']}}</p>
                    <h4>&#36;{{$array['price']}}</h4>
                </div>
                <div class="pull-left rating-stars">
                    <ul>
                        <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
                        <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
                        <li><a href="#" class="active"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-star star-stn" aria-hidden="true"></span></a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <hr class="featurette-divider">
            <div class="shocase-rt-bot">
                <div class="float-qty-chart">
                    <h4>Mời bạn chọn màu(1), size(2) và số lượng(3)</h4>
                    <ul>
                        <li>
                           <h3>Color Chart(1)</h3>

                           @foreach ($array['color'] as $key =>$element)
                           <span class="getcolor" style="background: {{$element['color']}};padding-top:5px;padding-left: 10px;padding-right: 10px; margin-right: 10px;border-radius: 50%;" color_id="{{$element['color_id']}}" product_id="{{$element['product_id']}}"></span>

                           @endforeach
                       </li>
                       <li class="qty">
                        <h3>Size Chart(2)</h3>
                               
                                    <span class="size-desc">


                              </span>
                          </li>
                          <li class="qty">
                            <h4>KHO</h4>
                                
                               <span class="quantity-desc">


                              </span>



                              
                          </li>
                          <li class="qty">
                            <h4>QTY(3)</h4>
                              {{-- <select class="form-control qnty-chrt">

                                  <option>1</option>
                                  
                              </select> --}}
                              <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button"  class="quantity-left-minus btn"  data-type="minus" data-field="">
                                                    -
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                                    +
                                                </button>
                                            </span>
                                        </div>
                          </li>



                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <ul>
                    <li class="ad-2-crt simpleCart_shelfItem">
                        <a class="btn item_add btn-addtocart" href="#" role="button">Add To Cart</a>
                        <a class="btn" href="#" role="button">Buy Now</a>
                    </li>
                </ul>
            </div>
            <div class="showcase-last">
                <h3>product details</h3>
                <ul>
                    <li>{!!$array['description']!!}</li>

                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="specifications">
    <div class="container">
      <h3>Item Details</h3> 
      <div class="detai-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-pills tab-nike" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Highlights</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Description</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Terms & conditiona</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <p>{!!$array['description']!!}</p>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <p>{!!$array['description']!!}</p>    
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                {!!$array['description']!!}    
            </div>
        </div>
    </div>
</div>
</div>


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

    

    

    $(document).on('click', '.getcolor', function(event) {
        event.preventDefault();
        $('.size-desc').text('');

        $('.quantity-desc').text('');
        var url="{{ asset('') }}getsize";
        var formData = new FormData();
        formData.append('color_id',$(this).attr('color_id'));
        formData.append('product_id',$(this).attr('product_id'));
        $.ajax({
            url:url,
            type:'POST',
            processData: false,
            contentType: false,
            data:formData,
            success:function(response){

                for (var i = 0; i < response.size.length; i++) {
                    var html='<span class="size" size_id="'+response.size[i].size_id+'" color_id="'+response.color_id+'" product_id="'+response.product_id+'" style="border:1px solid #A5E126;padding:5px 10px;cursor:pointer">'+response.size[i].size_name+'</span>&nbsp;';
                    $('.size-desc').append(html);
                }

                


            }
        });
    });

    $(document).on('click', '.size', function(event) {
        event.preventDefault();
        $('.quantity-desc').text('');
        var url="{{ asset('') }}getquantity";
        var formData = new FormData();
        formData.append('color_id',$(this).attr('color_id'));
        formData.append('size_id',$(this).attr('size_id'));
        formData.append('product_id',$(this).attr('product_id'));
        $('#hiddensize').attr('size_id',$(this).attr('size_id'));
        $('#hiddencolor').attr('color_id',$(this).attr('color_id'));
        $.ajax({
            url:url,
            type:'POST',
            processData: false,
            contentType: false,
            data:formData,
            success:function(response){
                
                var html='<span class="quantityAA" size_id="'+response.size_id+'" color_id="'+response.color_id+'" style="border:1px solid #A5E126;padding:5px 10px;cursor:pointer" quantity="'+response.quantity+'">'+response.quantity+'</span>';
                $('.quantity-desc').append(html);

            }




            
        });
    });

    var quantitiy=0;
        $('.quantity-right-plus').click(function(e){

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                
                // If is not undefined

                $('#quantity').val(quantity + 1);
                var number= parseInt($('#quantity').val());
                var quantity=parseInt($('.quantityAA').attr('quantity'));
                if(number> quantity){
                    $('#quantity').val($('.quantityAA').attr('quantity'));
                }
                    // Increment

                });

        $('.quantity-left-minus').click(function(e){
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                
                // If is not undefined

                    // Increment
                    if(quantity>0){
                        $('#quantity').val(quantity - 1);
                    }
                });
        $(document).on('keyup','#quantity',function(){
        if(parseInt($(this).val())<0){
            $(this).val(1);
        }
    })

        $(document).on('click','.btn-addtocart',function(e){
        e.preventDefault();
        var url="{{ asset('') }}cart";
        var formData1=new FormData();
        formData1.append('color_id',$('#hiddencolor').attr('color_id'));
        formData1.append('size_id',$('#hiddensize').attr('size_id'));
        formData1.append('number',$('#quantity').val());
        formData1.append('code',$('#code').val());
        
        $.ajax({
            url:url,
            type:'POST',
            processData: false,
            contentType: false,
            data:formData1,
            success:function(response){
                swal("Thêm vào giỏ hàng thành công!", "Click vào giỏ hàng để xem chi tiết!", "success");
                
            }




            
        });
    })

});

</script>
@endsection    