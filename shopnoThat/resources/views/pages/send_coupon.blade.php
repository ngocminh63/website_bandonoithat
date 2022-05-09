<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content ="width=device-width, initial-scale=1">
	<style>
		body{
			font-family: Arial;
		}
		.coupon{
			border: 5px dotted #bbb;
			width: 80%;
			border-radius: 15px;
			margin: 0 auto;
			max-width: 600px;
		}
		.container{
			padding: 2px 16px;
			background-color: #f1f1f1;
		}
		.promo{
			background: #ccc;
			padding: 3px;
		}
		.expire{
			color: red;
		}
		p.code{
			text-align: center;
			font-size: 20px;
		}
		p.expire{
			text-align: center;
		}
		h2.note{
			text-align: center;
			font-size: large;
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<div class="coupon">
		<div class="container">
			<h3>Mã khuyến mãi từ shop: MIN:FULLHOUSE</h3>
		</div>
		<div class="container" style="background-color: white">
			<h2 class="note"><b><i>
				@if($coupon['coupon_condition']==1)
					Giảm {{$coupon['coupon_number']}}%
				@else
					Giảm {{number_format($coupon['coupon_number'],0,',','.')}} VNĐ
				@endif
			cho tổng đơn hàng trên 20 triệu</i></b></h2>
			<b>Quý khách đã từng mua hàng tại shop MIN:FULLHOUSE</b>
			<b>Hãy ghé tham shop để mua nhiều mặt hàng với giá ưu đãi</b>
		</div>
		<div class="container">
			<p class="code">Sử dụng mã Code sau: <span class="promo">{{$coupon['coupon_code']}}</span></p>
			<p class="expire">Ngày bắt đầu: {{$coupon['start_date']}} / Ngày hết hạn code: {{$coupon['end_date']}}</p>
		</div>
	</div>
</body>
</html>