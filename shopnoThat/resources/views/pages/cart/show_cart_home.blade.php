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
	span.text-alert {
    color: blue;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
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
			<div class="table-responsive cart_info">
			<?php
    			$message = Session::get('message');
    			if($message){
        		echo '<span class="text-alert">'.$message.'</span>';
        		Session::put('message',null);
    			}
    		?>
			<?php
    			$error = Session::get('error');
    			if($error){
        		echo '<span class="alert alert-danger">'.$error.'</span>';
        		Session::put('error',null);
    			}
    		?>
			<?php
			$content = Cart::content();
			?>
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
						<!-- v_content: giá trị của content -->
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="80" alt=""></a>
							</td>
                            <td class="cart_name">
								<h4><a href="">{{$v_content->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-qty')}}" method="POST">
									{{ csrf_field() }}
									<input class="cart_quantity_input" name="cart_quantity" type="number" min="1" value="{{$v_content->qty}}" />
									<input class="form-control" name="rowId_cart" type="hidden" min="1" value="{{$v_content->rowId}}" />
									<!-- <input class="cart_quantity_input " type="text" name="cart_quantity" value="{{$v_content->qty}}"  >
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control"> -->
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
									<?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).' '.'vnđ';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<div class="chose_area">
						<form action="{{URL::to('/check-coupon')}}" method="POST">
						{{ csrf_field() }}
							<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
							<input type="submit" class="btn btn-warning check_coupon" name="check_coupon" value="Áp dụng">
						</form>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::priceTotal(0,',','.').' '.'VNĐ'}}</span></li>
							<li>Thuế <span>{{Cart::tax(0,',','.').' '.'VNĐ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total(0,',','.').' '.'VNĐ'}}</span></li>
						</ul>
						{{-- 	<a class="btn btn-default update" href="">Update</a> --}}
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
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection
