@extends('welcome')
@section('content')

<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm mới nhất</h2>
						@foreach($all_product as $key => $pro)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
												@csrf
												<!-- gửi dữ liệu sang welcome từ hidden -->
												<input type="hidden" value="{{$pro->pro_id}}" class="cart_product_id_{{$pro->pro_id}}">
												<input type="hidden" id="wishlist_productname{{$pro->pro_id}}" value="{{$pro->pro_name}}" class="cart_product_name_{{$pro->pro_id}}">
												<input type="hidden" value="{{$pro->pro_img}}" class="cart_product_image_{{$pro->pro_id}}">
												<input type="hidden" value="{{$pro->pro_qty}}" class="cart_product_quantity_{{$pro->pro_id}}">
												<input type="hidden" id="wishlist_productsize{{$pro->pro_id}}" value="{{$pro->pro_size}}" class="cart_product_size_{{$pro->pro_id}}">
												<input type="hidden" id="wishlist_productprice{{$pro->pro_id}}" value="{{$pro->pro_price}}" class="cart_product_price_{{$pro->pro_id}}">
												<input type="hidden" value="1" class="cart_product_qty_{{$pro->pro_id}}">

												<a id="wishlist_producturl{{$pro->pro_id}}" href="{{URL::to('/chi-tiet-sp/'.$pro->pro_slug)}}">
													<img id="wishlist_productimg{{$pro->pro_id}}" src="{{URL::to('public/uploads/product/'.$pro->pro_img)}}" height="200" width="100" />
													<h2>{{number_format($pro->pro_price,0,',','.').' '.'VNĐ'}}</h2>
													<p>{{$pro->pro_name}}</p>
												</a>
												<input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$pro->pro_id}}" name="add-to-cart">
												
											</form>
											
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
												<li><a style= "cursor: pointer;" onclick="add_compare({{$pro->pro_id}})"><i class="fa fa-plus-square"></i>So sánh</a></li>
												<div class="container" >
													<!-- Modal -->
													<div class="modal fade" id="compare" role="dialog">
														<div class="modal-dialog">
														
														<!-- Modal content-->
															<div class="modal-content" style="width: 800px">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title"><span id="title-compare"></span></h4>
																</div>
																<div class="modal-body">
																	<table class="table table-hover" id="row_compare">
																		<thead>
																			<tr>
																				<th>Tên sản phẩm</th>
																				<th>Giá</th>
																				<th>Hình ảnh</th>
																				<th>Kích thước</th>
																				<th>Xem sản phẩm</th>
																				<th>Xóa</th>
																			</tr>
																		</thead>
																		<tbody></tbody>
																	</table>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</div>
															</div>
														
														</div>
													</div>
													
													</div>
											</ul>
										</div>
								</div>
							</div>	
						</div>	
						@endforeach
					</div><!--features_items-->
					<ul class="pagination pagination-sm m-t-none m-b-none">
						<span>{!!$all_product->links("pagination::bootstrap-4")!!}</span>
					</ul>

@endsection
