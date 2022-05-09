@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						@foreach($category_name as $key => $category_name)
						<h2 class="title text-center">Sản phẩm của {{$category_name->cate_name}} </h2>
						@endforeach
						@foreach($category_by_id as $key => $pro)
                        <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
												@csrf
												<!-- gửi dữ liệu sang welcome từ hidden -->
												<input type="hidden" value="{{$pro->pro_id}}" class="cart_product_id_{{$pro->pro_id}}">
												<input type="hidden" value="{{$pro->pro_name}}" class="cart_product_name_{{$pro->pro_id}}">
												<input type="hidden" value="{{$pro->pro_img}}" class="cart_product_image_{{$pro->pro_id}}">
												<input type="hidden" value="{{$pro->pro_qty}}" class="cart_product_quantity_{{$pro->pro_id}}">
												<input type="hidden" value="{{$pro->pro_price}}" class="cart_product_price_{{$pro->pro_id}}">
												<input type="hidden" value="1" class="cart_product_qty_{{$pro->pro_id}}">

												<a href="{{URL::to('/chi-tiet-sp/'.$pro->pro_slug)}}">
													<img src="{{URL::to('public/uploads/product/'.$pro->pro_img)}}" height="200" width="100" />
													<h2>{{number_format($pro->pro_price,0,',','.').' '.'VNĐ'}}</h2>
													<p>{{$pro->pro_name}}</p>
												</a>
												<input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$pro->pro_id}}" name="add-to-cart">
											</form>
											
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
												<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
											</ul>
										</div>
								</div>
							</div>	
						</div>
						@endforeach
					</div>
					<ul class="pagination pagination-sm m-t-none m-b-none">
						<span>{!!$category_by_id->links("pagination::bootstrap-4")!!}</span>
					</ul>
					<!--features_items-->

@endsection
