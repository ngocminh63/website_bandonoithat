@extends('welcome')
@section('content')
<style>
	#cart_items .cart_info {
    border: 1px solid #E6E4DF;
    margin-bottom: 50px;
    width: 85%;
	}
	.table-responsive{
    width: 80%;
    margin-bottom: 20px;
	}
	.cart_quantity_input {
    width: 50px;
	}
	#do_action .chose_area {
	width: 80%;
    margin-bottom: 20px;
	}
	#do_action .total_area {
	width: 80%;
    margin-bottom: 20px;
	}
	.form-control {
    width: 80%;
	}
</style>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{url('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
				@if(session()->has('message'))
                    <div class="alert alert-success">
						{!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
			<div class="table-responsive cart_info">
				<form action="{{url('/update-cart')}}" method="POST">
					@csrf
					<table class="table table-condensed">

						<thead>
							<tr class="cart_menu">
								<td class="image">Ảnh</td>
								<td class="name">Tên sản phẩm</td>
								<td class="price">Giá</td>
								<td class="quantity">Số lượng</td>
								<td class="total">Tổng tiền</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<!-- nếu tồn tại -->
						@if(Session::get('cart')==true)
						@php
								$total = 0;
						@endphp
						@foreach(Session::get('cart') as $key => $cart)
							@php
								$subtotal = $cart['pro_price']* $cart['pro_qty'];
								$total+=$subtotal;
							@endphp
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{asset('public/uploads/product/'.$cart['pro_image'])}}" width="80" alt=""></a>
								</td>
								<td class="cart_name">
									<h4><a href="#">{{$cart['pro_name']}}</a></h4>
								</td>
								<td class="cart_name">
									<h4><a href="#">{{$cart['pro_quantity']}}</a></h4>
								</td>
								<td class="cart_price">
									<p>{{number_format($cart['pro_price'],0,',','.')}} VNĐ</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<input class="cart_quantity_input" name="cart_qty[{{$cart['session_id']}}]"  type="number" min ="1" value="{{$cart['pro_qty']}}" />
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">
										{{number_format($subtotal,0,',','.')}} VNĐ
									</p>
								</td>
								<td class="cart_delete">
									<a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
							<tr>
								<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out"></td>
								<td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
								<td>
									@if(Session::get('coupon'))
										<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
									@endif
								</td>
								<td colspan="2">
										<li>Tổng :<span> {{number_format($total,0,',','.')}} VNĐ</span></li>
										@if(Session::get('coupon'))
											<li>
												@foreach(Session::get('coupon') as $key => $cou)
													@if($cou['coupon_condition']==1)
														Mã giảm : {{$cou['coupon_number']}} %
														<p>
															@php 
															$total_coupon = ($total*$cou['coupon_number'])/100;
															echo '<p><li>Tổng giảm : '.number_format($total_coupon,0,',','.').' VNĐ</li></p>';
															@endphp
														</p>
														<p><li>Tổng thanh toán : {{number_format($total-$total_coupon,0,',','.')}} VNĐ</li></p>
													@elseif($cou['coupon_condition']==2)
														Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
														<p>
															@php 
															$total_coupon = $total - $cou['coupon_number'];
															@endphp
														</p>
														<p><li>Tổng thanh toán : {{number_format($total_coupon,0,',','.')}} VNĐ</li></p>
													@endif
												@endforeach
											</li>
										@endif
										<!-- <li>Thuế:<span></span></li>
										<li>Phí vận chuyển:<span> Free</span></li> -->
										<!-- <li>Thành tiền:<span></span></li> -->
								</td>
								<td>
								<?php
                                   $customer_id = Session::get('cus_id');;
                                   if($customer_id!=NULL){ 
                                 ?>
                                  
                                <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt hàng</a>
                                <?php
                            }else{
                                 ?>
                                 
                                 <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a>
                                 <?php 
                             }
                                 ?>
								</td>
							</tr>
							@else 
								<tr>
									<td colspan="5"><center>
									@php 
									echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
									@endphp
									</center></td>
								</tr>
							@endif
						</tbody>
						</form>
						<tr>
							<td>
								<!-- nếu tồn tại giỏ hàng mới xuất hiện, mới cho nhập mã gaimr giá -->
								@if(Session::get('cart'))
									<form method="POST" action="{{url('/check-coupon')}}">
									@csrf
										<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
										<input type="submit" class="btn btn-warning check_coupon" name="check_coupon" value="Áp dụng">
											
									</form>
								@endif
							</td>
						</tr>
					</table>
			</div>
		</div>
	</section> 

@endsection
