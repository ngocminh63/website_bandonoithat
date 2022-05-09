@extends('welcome')
@section('content')
@foreach($product_details as $key => $value)
<style>
	.style_cmt{
		border: 1px solid #ddd;
		border-radius: 10px;
		background: #F0F0E9;
	}
</style>
<div class="product-details"><!--product-details-->
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb" style="background: none;">
								<li class="breadcrumb-item"><a href="{{url('/trang-chu')}}">Trang chủ</a></li>
								<li class="breadcrumb-item"><a href="{{url('/danh-muc/'.$category_slug)}}">{{$product_cate}}</a></li>
								<li class="breadcrumb-item"><a href="{{url('/thuong-hieu/'.$bra_slug)}}">{{$product_brand}}</a></li>
								<li class="breadcrumb-item"><a href="{{url('/phong/'.$ro_slug)}}">{{$product_room}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{$product_name}}</li>
							</ol>
						</nav>
						<div class="col-sm-5">
							<ul id="imageGallery">
								@foreach($gallery as $key => $gal)
									<li height = 140px width = 100% data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_img)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_img)}}">
										<img height = 350px width = 100% src="{{asset('public/uploads/gallery/'.$gal->gallery_img)}}" />
									</li>
								@endforeach
							</ul>
							<!-- data-thumb là hình ảnh nhỏ, data-src là khi ấn vào hình ảnh lớn sẽ chuyển sang trang khác, img là hình ảnh lớn -->
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->pro_name}}</h2>
								<p>ID sản phẩm: {{$value->pro_id}}</p>
								<img src="" alt="" />
								<!-- dùng khi sử dùng bumbummen -->
								<!-- xử lý thêm giỏ hàng: khi nào bạn tạo mộ HTML form trong ứng dụng của bạn, bạn nên thêm một hidden field CSRF token vào 
								trong form để bảo mật CSRF middleware có thể xác nhận request. -->
								<!-- <form action="{{URL::to('/gio-hang')}}" method="POST">
									{{ csrf_field() }}
									<span>
										<span>Giá: {{number_format($value->pro_price).' '.'VNĐ'}}</span>
										<label>Số lượng:</label>
										<input name="qty" type="number" max="1" value="1" />
										<input name="productid_hidden" type="hidden" min="1" value="{{$value->pro_id}}" />
										<button type="submit" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
									</span>
								</from> -->
								<!-- dùng ajax -->
								<form>
									@csrf
										<!-- gửi dữ liệu sang welcome từ hidden -->
										<input type="hidden" value="{{$value->pro_id}}" class="cart_product_id_{{$value->pro_id}}">
										<input type="hidden" value="{{$value->pro_name}}" class="cart_product_name_{{$value->pro_id}}">
										<input type="hidden" value="{{$value->pro_img}}" class="cart_product_image_{{$value->pro_id}}">
										<input type="hidden" value="{{$value->pro_qty}}" class="cart_product_quantity_{{$value->pro_id}}">
										<input type="hidden" value="{{$value->pro_price}}" class="cart_product_price_{{$value->pro_id}}">
										<!-- <input type="hidden" value="1" class="cart_product_qty_{{$value->pro_id}}"> -->
									<span>
										<span>Giá: {{number_format($value->pro_price).' '.'VNĐ'}}</span>
										<label>Số lượng:</label>
										<input name="qty" type="number" max="1" class="cart_product_qty_{{$value->pro_id}}"  value="1" />
										<input name="productid_hidden" type="hidden"  value="{{$value->pro_id}}" />
										<!-- <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$value->pro_id}}" name="add-to-cart"> -->
									</span>
									<input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$value->pro_id}}" name="add-to-cart">
								</from>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
								<p><b>Danh mục:</b> {{$value->cate_name}}</p>
								<p><b>Phù hợp với:</b> {{$value->room_name}}</p>
								<a href=""><img src="" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value->pro_desc!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p><b>Kích thước:</b> {!!$value->pro_size!!}</p>
								<p><b>Màu sắc:</b> {!!$value->pro_color!!}</p>
								<p><b>Chất liệu:</b> {!!$value->pro_material!!}</p>
							</div>
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>Admin</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 MAR 2022</a></li>
									</ul>
									<form>
										@csrf
											<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->pro_id}}">
											<div id="comment_show"></div>
									</form>
									<p><b>Viết đánh giá</b></p>
									
									<form>
										<span>
											<input style="width:100%; margin-left: 0;" type="text" class="comment_name" placeholder="Tên bình luận"/>
										</span>
										<textarea name="comment" class="comment_content" placeholder="Nội dung bình luận" ></textarea>
										<div id="notify-comment"></div>
										<b>Đánh giá sao:</b> <img src="" alt="" />
										<button type="button" class="btn btn-default pull-right send-comment">
											Gửi
										</button>
									</form>
								</div>
							</div> 
						</div>
					</div><!--/category-tab-->
@endforeach
                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm gợi ý</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($relate_product as $key => $values)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('public/uploads/product/'.$values->pro_img)}}" height="200" width="100" />
													<h2>{{number_format($values->pro_price).' '.'VNĐ'}}</h2>
													<p>{{$values->pro_name}}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>		
						</div>
					</div><!--/recommended_items-->
					{{--   <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$related_product->links("pagination::bootstrap-4")!!}
                      </ul> --}}
@endsection