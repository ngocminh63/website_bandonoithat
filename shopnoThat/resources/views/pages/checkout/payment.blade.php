@extends('welcome')
@section('content')
<style>
    .register-req{
        width: 85%;
    }
    .table {
    width: 95%;
    margin-bottom: 20px;
    }
    .table-responsive{
    width: 80%;
    margin-bottom: 20px;
	}
	.cart_quantity_input {
    width: 50px;
	}
	.btn.btn-primary {
    background: #FE980F;
    border: 0 none;
    border-radius: 0;
    margin-top: -190px;
	}
    /* table {
    max-width: 95%;
    background-color: transparent;
    } */
</style>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
                <li><a href="{{url('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>
            <div class="table-responsive cart_info">
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
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<h4 style="margin:40px 0;font-size: 20px;">Chọn hình thức thanh toán</h4>
			<form action="{{URL::to('/order-place')}}" method="POST">
				{{ csrf_field() }}
				<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="checkbox"> Thanh toán thẻ ghi nợ</label>
					</span>
				</div>
				<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm-9">
			</form>
		</div>
	</section> <!--/#cart_items-->
@endsection
