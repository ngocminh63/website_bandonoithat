@extends('welcome')
@section('content')
<style>
    .register-req{
        width: 85%;
    }
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
</style>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
                <li><a href="{{url('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="register-req">
				<p>Hãy đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-13 clearfix">
						<div class="bill-to">
							<p>Điền thông tin nhận hàng</p>
							<div class="form-one">
								<form>
                                    @csrf
									<div class="form-group">
										<label for="exampleInputPassword1">Chọn tỉnh/thành phố</label>
										<select name="city" id="city" class="form-control input-sm m-bot15 choose city">
											<option value="">--Chọn Tỉnh/Thành phố--</option>
												@foreach($city as $key => $ct)
													<option value="{{$ct->matp}}">{{$ct->name_tp}}</option>
												@endforeach
										</select>
									</div>

									<div class="form-group">
										<label for="exampleInputPassword1">Chọn quận/huyện</label>
										<select name="province" id="province" class="form-control input-sm m-bot15 choose province">
											<option value="">--Chọn Quận/Huyện--</option>
												
										</select>
									</div>

									<div class="form-group">
										<label for="exampleInputPassword1">Chọn xã/phường</label>
										<select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
											<option value="">--Chọn Xã/Phường--</option>
												
										</select>
									</div>
									<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                                </form>
								<form method="POST">
							        @csrf
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
									<textarea name="shipping_notes" class="shipping_notes"  placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
                                    
									<!-- nếu tồn tại phí -->
									@if(Session::get('fee'))
										<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else 
									<!-- nếu k có phí vận chuyển thì bắt buộc là 100k -->
										<input type="hidden" name="order_fee" class="order_fee" value="100000">
									@endif
									<!-- Nếu có mã giảm giá -->
									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else 
										<input type="hidden" name="order_coupon" class="order_coupon" value="Không có mã">
									@endif
									
									
									
									<div class="">
										 <div class="form-group">
		                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
		                                      <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
		                                            <option value="0">Qua chuyển khoản</option>
		                                            <option value="1">Tiền mặt</option>   
		                                    </select>
		                                </div>
									</div>
									<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>
								<!-- <form>
                                    @csrf
									<div class="form-group">
										<label for="exampleInputPassword1">Chọn tỉnh/thành phố</label>
										<select name="city" id="city" class="form-control input-sm m-bot15 choose city">
											<option value="">--Chọn Tỉnh/Thành phố--</option>
												@foreach($city as $key => $ct)
													<option value="{{$ct->matp}}">{{$ct->name_tp}}</option>
												@endforeach
										</select>
									</div>

									<div class="form-group">
										<label for="exampleInputPassword1">Chọn quận/huyện</label>
										<select name="province" id="province" class="form-control input-sm m-bot15 choose province">
											<option value="">--Chọn Quận/Huyện--</option>
												
										</select>
									</div>

									<div class="form-group">
										<label for="exampleInputPassword1">Chọn xã/phường</label>
										<select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
											<option value="">--Chọn Xã/Phường--</option>
												
										</select>
									</div>
									<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                                </form> -->
							</div>
						</div>
					</div>
					<div class="col-sm-13 clearfix">
					@if(session()->has('message'))
						<div class="alert alert-success">
							{{ session()->get('message') }}
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
										$subtotal = $cart['pro_price']*$cart['pro_qty'];
										$total+=$subtotal;
									@endphp
									<tr>
										<td class="cart_product">
											<a href=""><img src="{{asset('public/uploads/product/'.$cart['pro_image'])}}" width="80" alt=""></a>
										</td>
										<td class="cart_name">
											<h4><a href="#">{{$cart['pro_name']}}</a></h4>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['pro_price'],0,',','.')}} VNĐ</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												<input class="cart_quantity_input" name="cart_qty[{{$cart['session_id']}}]"  type="number" min="1" value="{{$cart['pro_qty']}}" />
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
																
																	@endphp
																</p>
																<p>
																@php 
																	$total_after_coupon = $total-$total_coupon;
																@endphp
																</p>
															@elseif($cou['coupon_condition']==2)
																Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
																<p>
																	@php 
																	$total_coupon = $total - $cou['coupon_number'];
																
																	@endphp
																</p>
																@php 
																	$total_after_coupon = $total_coupon;
																@endphp
															@endif
														@endforeach
													</li>
												@endif

												@if(Session::get('fee'))
													<li>	
														Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span></li>              
												@endif 

												<li>Tổng thanh toán:
													@php 
														if(Session::get('fee') && !Session::get('coupon')){
															$total_after = $total + Session::get('fee');;
															echo number_format($total_after,0,',','.').'VNĐ';
														}elseif(Session::get('fee') && Session::get('coupon')){
															$total_after = $total_after_coupon;
															$total_after = $total_after + Session::get('fee');
															echo number_format($total_after,0,',','.').'VNĐ';
														}

													@endphp
												</li>
													
												<!-- <li>Thuế:<span></span></li>
												<li>Phí vận chuyển:<span> Free</span></li> -->
												<!-- <li>Thành tiền:<span></span></li> -->
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
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection
