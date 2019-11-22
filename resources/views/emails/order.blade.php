<!-- Latest compiled and minified CSS & JS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<h1>Thông tin đơn hàng</h1>
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Size</th>
				<th>Img</th>
				<th>Color</th>
				<th>Number</th>
			</tr>
		</thead>
		@foreach($orderdetail as $order)
		<tbody>
			<tr>
				<td>{{$order->name}}</td>
				<td>{{$order->size}}</td>
				<td><img style="width: 50px; height: 50px;" src="http://ncthanhshoes.com/storage/{{$order->image}}"></td>
				<td><span style="background-color: {{$order->color}};padding: 3px 30px"></span></td>
				<td>{{$order->number}}</td>
			</tr>
		</tbody>
		@endforeach
	</table>
</div>