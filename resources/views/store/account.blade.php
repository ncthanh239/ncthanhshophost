@extends('layouts.masterstore')
@section('noidung')
<input type="hidden" id="hiddenuser" user_id="{{Auth::user()->id}}">
<div class="contact">
	<div class="container">
		<h3>Your Profile</h3>
		<div class="contact-content">
			<form>
				<input type="text" class="textbox" value="{{Auth::user()->name}}"><br>
				<input type="text" class="textbox" value="{{Auth::user()->email}}" ><br>
				<input type="text" class="textbox" value="{{Auth::user()->mobile}}" ><br>
				<div class="clear"> </div>

                       {{-- <div class="submit"> 
                            <input class="btn btn-default cont-btn" type="submit" value="SEND " />
                        </div> --}}
                    </form>
                    <br>
                    <div class="hide-address">
                    	<div>
                    		
                    			<h3>My Address</h3>

                    	
                    		
                    	</div>
                    
                    	<div class="caddress">
                    		@foreach ($add as $element)
                    		<div>

                    			<p>Address: </p>
                    			<input type="text" class="textbox" value="{{$element->address}}"><br>

                    			
                    			
                    		</div>
                    		@endforeach
                    		<br>
                    		<div>
                    			<button type=""><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Adress</button>
                    		</div>
                    	</div>
                    </div>
                    <div style="text-align: center;padding: 50px;">
                    				<h4>Thông tin đơn hàng</h4>
                    			</div>

                    <div class="hide-purchase">
                    	<div class="row row-pb-md">
                    		<div class="col-md-10 col-md-offset-1">
                    			<div class="process-wrap">
                    				<div class="process text-center active">
                    					<p class="confirm"><span>01</span></p>
                    					<h3>Confirm</h3>
                    				</div>
                    				<div class="process text-center">
                    					<p class="waiting"><span>02</span></p>
                    					<h3>waiting for delivery</h3>
                    				</div>
                    				<div class="process text-center">
                    					<p class="delivering"><span>03</span></p>
                    					<h3>Delivering</h3>
                    				</div>
                    				<div class="process text-center">
                    					<p class="complete"><span>04</span></p>
                    					<h3>Order Complete</h3>
                    				</div>
                    				<div class="process text-center">
                    					<p class="delete"><span>05</span></p>
                    					<h3>Deleted</h3>
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="list_order">
                    		<div class="hide-confirm aaaaa">
                    			@if (count($confirm) == 0)
                    			{{-- <div>
                    				<img src="https://cdngarenanow-a.akamaihd.net/shopee/shopee-pcmall-live-vn/assets/50ae7a4bf7cca69985b40dfea02eddb3.png" alt="">
                    				<p>no orders</p>
                    			</div> --}}
                    			@endif
                    			@if (count($confirm) >0)
                    			<div>
                    				<table class="table table-hover">
                    					<thead>
                    						<tr>
                    							<th>Code</th>
                    							<th>Date</th>
                    							<th>Action</th>
                    						</tr>
                    					</thead>
                    					<tbody>
                    						@foreach ($confirm as $con)
                    						<tr id="tr_{{$con->id}}">
                    							<td>{{$con->code}}</td>
                    							<td>{{$con->created_at}}</td>
                    							<td>
                    								<button type="" class="btn btn-info detail" data-toggle="modal" data-target="#orderDetail" order_id="{{$con->id}}"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                    								<button type="" class="btn btn-danger deleteOrder" order_id="{{$con->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    							</td>
                    						</tr>
                    						@endforeach
                    					</tbody>
                    				</table>
                    			</div>
                    			@endif
                    		</div>
                    		<div class="hide-waiting aaaaa">
                    			@if(count ($waiting) == 0)
                    			{{-- <div>
                    				<img src="https://cdngarenanow-a.akamaihd.net/shopee/shopee-pcmall-live-vn/assets/50ae7a4bf7cca69985b40dfea02eddb3.png" alt="">
                    				<p>no orders</p>
                    			</div> --}}
                    			@endif
                    			@if (count($waiting) >0)
                    			<div>
                    				<table class="table table-hover">
                    					<thead>
                    						<tr>
                    							<th>Code</th>
                    							<th>Date</th>
                    							<th>Action</th>
                    						</tr>
                    					</thead>
                    					<tbody>
                    						@foreach ($waiting as $con)
                    						<tr>
                    							<td>{{$con->code}}</td>
                    							<td>{{$con->created_at}}</td>
                    							<td>
                    								<button type="" class="btn btn-info detail" data-toggle="modal" data-target="#orderDetail" order_id="{{$con->id}}"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                    							</td>
                    						</tr>
                    						@endforeach
                    					</tbody>
                    				</table>
                    			</div>
                    			@endif
                    		</div>
                    		<div class="hide-delivering aaaaa">
                    			@if(count ($delivering) == 0)
                    			{{-- <div>
                    				<img src="https://cdngarenanow-a.akamaihd.net/shopee/shopee-pcmall-live-vn/assets/50ae7a4bf7cca69985b40dfea02eddb3.png" alt="">
                    				<p>no orders</p>
                    			</div> --}}
                    			@endif
                    			@if (count($delivering) >0)
                    			<div>
                    				<table class="table table-hover">
                    					<thead>
                    						<tr>
                    							<th>Code</th>
                    							<th>Date</th>
                    							<th>Action</th>
                    						</tr>
                    					</thead>
                    					<tbody>
                    						@foreach ($delivering as $con)
                    						<tr>
                    							<td>{{$con->code}}</td>
                    							<td>{{$con->created_at}}</td>
                    							<td>
                    								<button type="" class="btn btn-info detail" data-toggle="modal" data-target="#orderDetail" order_id="{{$con->id}}"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                    							</td>
                    						</tr>
                    						@endforeach
                    					</tbody>
                    				</table>
                    			</div>
                    			@endif
                    		</div>
                    		<div class="hide-complete aaaaa">
                    			@if(count ($complete) == 0)
                    			{{-- <div>
                    				<img src="https://cdngarenanow-a.akamaihd.net/shopee/shopee-pcmall-live-vn/assets/50ae7a4bf7cca69985b40dfea02eddb3.png" alt="">
                    				<p>no orders</p>
                    			</div> --}}
                    			@endif
                    			@if (count($complete) >0)
                    			<div>
                    				<table class="table table-hover">
                    					<thead>
                    						<tr>
                    							<th>Code</th>
                    							<th>Date</th>
                    							<th>Action</th>
                    						</tr>
                    					</thead>
                    					<tbody>
                    						@foreach ($complete as $con)
                    						<tr>
                    							<td>{{$con->code}}</td>
                    							<td>{{$con->created_at}}</td>
                    							<td>
                    								<button type="" class="btn btn-info detail" data-toggle="modal" data-target="#orderDetail" order_id="{{$con->id}}"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                    							</td>
                    						</tr>
                    						@endforeach
                    					</tbody>
                    				</table>
                    			</div>
                    			@endif
                    		</div>
                    		<div class="hide-delete aaaaa">
                    			@if(count ($delete) == 0)
                    			{{-- <div>
                    				<img src="https://cdngarenanow-a.akamaihd.net/shopee/shopee-pcmall-live-vn/assets/50ae7a4bf7cca69985b40dfea02eddb3.png" alt="">
                    				<p>no orders</p>
                    			</div> --}}
                    			@endif
                    			@if (count($delete) >0)
                    			<div>
                    				<table class="table table-hover">
                    					<thead>
                    						<tr>
                    							<th>Code</th>
                    							<th>Date</th>
                    							<th>Action</th>
                    						</tr>
                    					</thead>
                    					<tbody>
                    						@foreach ($delete as $con)
                    						<tr>
                    							<td>{{$con->code}}</td>
                    							<td>{{$con->created_at}}</td>
                    							<td>
                    								<button type="" class="btn btn-info detail" data-toggle="modal" data-target="#orderDetail" order_id="{{$con->id}}"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                    							</td>
                    						</tr>
                    						@endforeach
                    					</tbody>
                    				</table>
                    			</div>
                    			@endif
                    		</div>
                    	</div>
                    </div>

 <div class="modal fade" id="orderDetail">
	<div class="modal-dialog" style="width: 75%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Oder Detail</h4>
			</div>
			<div class="modal-body">
				<table>
					<thead>
						<tr>
							<th>Order_id</th>
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


                   {{--  <div class="map">
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1578265.0941403757!2d-98.9828708842255!3d39.41170802696131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1407515822047"> </iframe>
                    </div> --}}
                </div>
            </div>
        </div>
        @endsection

        @section('css')
        <style type="text/css">
        .list_order{
        	text-align: center;

        }
	/*.list_order{
		height: 400px;
		}*/
		.aaaaa{
			padding-top: 10%;
		}
		.aaaaa img{
			width: 10%;
		}

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
										<script>
											$(document).ready(function(){
												$.ajaxSetup({
													headers:{
														'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
													}
												});

												$('.hide-delete').hide();
												$('.hide-complete').hide();
												$('.hide-delivering').hide();
												$('.hide-waiting').hide();
												$(document).on('click', '.delete', function(event) {
													event.preventDefault();
													$('.hide-delete').show();
													$('.hide-complete').hide();
													$('.hide-delivering').hide();
													$('.hide-waiting').hide();
													$('.hide-confirm').hide();
													$('.process').removeClass('active');
													$(this).parent().addClass('active');
												});
												$(document).on('click', '.complete', function(event) {
													event.preventDefault();
													$('.hide-delete').hide();
													$('.hide-complete').show();
													$('.hide-delivering').hide();
													$('.hide-waiting').hide();
													$('.hide-confirm').hide();
													$('.process').removeClass('active');
													$(this).parent().addClass('active');
												});
												$(document).on('click', '.delivering', function(event) {
													event.preventDefault();
													$('.hide-delete').hide();
													$('.hide-complete').hide();
													$('.hide-delivering').show();
													$('.hide-waiting').hide();
													$('.hide-confirm').hide();
													$('.process').removeClass('active');
													$(this).parent().addClass('active');
												});
												$(document).on('click', '.waiting', function(event) {
													event.preventDefault();
													$('.hide-delete').hide();
													$('.hide-complete').hide();
													$('.hide-delivering').hide();
													$('.hide-waiting').show();
													$('.hide-confirm').hide();
													$('.process').removeClass('active');
													$(this).parent().addClass('active');
												});
												$(document).on('click', '.confirm', function(event) {
													event.preventDefault();
													$('.hide-delete').hide();
													$('.hide-complete').hide();
													$('.hide-delivering').hide();
													$('.hide-waiting').hide();
													$('.hide-confirm').show();
													$('.process').removeClass('active');
													$(this).parent().addClass('active');
												});

												$(document).on('click','.detail',function(e){
													e.preventDefault();
													$('.orderTbody').text('');
													var url="{{ asset('') }}orderDetail/"+$(this).attr('order_id');
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
												})

// $('.hide-purchase').hide();
// $('.hide-address').hide();
$(document).on('click', '.address', function(event) {
	event.preventDefault();
	$('.hide-profile').hide();
	$('.hide-purchase').hide();
	$('.hide-address').show();
});
$(document).on('click', '.purchase', function(event) {
	event.preventDefault();
	$('.hide-profile').hide();
	$('.hide-purchase').show();
	$('.hide-address').hide();
});
$(document).on('click', '.profile', function(event) {
	event.preventDefault();
	$('.hide-profile').show();
	$('.hide-purchase').hide();
	$('.hide-address').hide();
});


$(document).on('click','.btn-update',function(){
	var id= $('#hiddenuser').attr('user_id');
	var url4="{{ asset('') }}users/"+id;
	var formData4 = new FormData();
	formData4.append('name',$('.ename').val());
	formData4.append('email',$('.eemail').val());
	formData4.append('mobile',$('.emobile').val());
	formData4.append('sex',$('input[name=gender]:checked').val());
	formData4.append('birthday',$('.ebirthday').val());
	$.ajax({
		url:url4,
		type:'POST',
		processData: false,
		contentType: false,
		data:formData4,
		success:function(response){
			toastr.success('Sửa thành công');

			setTimeout(function(){
				$('#editUser').modal('hide');
			}, 1000);


		}
	});
});
$(document).on('click','.deleteOrder',function(e){
	e.preventDefault();
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
				type: 'post',

				url: "{{ asset('') }}deleteOrder/"+$(this).attr('order_id'),
				success: function(response){
					setTimeout(function(){
						window.location.href="{{ asset('') }}myaccount"
					},800);
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