<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MIN: FULLHOUSE</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0392907386</a></li>
								<li><a href="{{URL::to('/send-mail')}}"><i class="fa fa-envelope"></i> ltnminh12ahla@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{asset('public/frontend/images/logo.jpg')}}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php
									$customer_id = Session::get('cus_id');
									$name = Session::get('cus_name');
									if($customer_id!=NULL && $name==NULL){ 
									?>
									<li><a href=""><i class="fa fa-lock"></i>L?? Minh</a></li>
									
									<?php
									}
                                 ?>
								<?php
                                   $customer_id = Session::get('cus_id');
                                   $shipping_id = Session::get('ship_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                 <?php 
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                <?php
                                 }
                                ?>
								<?php
                                   $customer_id = Session::get('cus_id');
                                   if($customer_id!=NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/history')}}"><i class="fa fa-bell"></i> L???ch s??? ????n h??ng</a></li>
                                
                                <?php
								   }
                                 ?>
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li>
								<?php
                                   $customer_id = Session::get('cus_id');
                                   if($customer_id!=NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> ????ng xu???t</a></li>
                                
                                <?php
									}else{
										?>
										<li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> ????ng nh???p</a></li>
										<?php 
									}
                                 ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/trang-chu')}}" class="active">Trang ch???</a></li>
								<li class="dropdown"><a href="#">S???n ph???m<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach($category as $key => $cate1)
                                        <li><a href="{{URL::to('/danh-muc/'.$cate1->cate_slug)}}">{{$cate1->cate_name}}</a></li>
									@endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Thi???t k??? c??c ph??ng<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach($catepo as $key => $capo)
                                    	<li><a href="{{URL::to('/danh-muc-bai-viet/'.$capo->cate_post_slug)}}">{{$capo->cate_post_name}}</a></li>
                                    @endforeach
                                    </ul>
                                </li>
								<li><a href="{{URL::to('/videos')}}">Phong c??ch thi???t k???</a></li>
								<li><a href="{{URL::to('/lien-he')}}">Li??n h???</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/tim-kiem')}}" method="post">
							{{ csrf_field() }}
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="T??m ki???m s???n ph???m"/>
								<input type="submit" name="search_item" style="margin-top:0; color:#000; width: 80px" class="btn btn-primary btn-sm" value="T??m ki???m"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
						@php 
                            $i = 0;
                        @endphp
						@foreach($slider as $key => $slider)
							@php 
								$i++;
							@endphp
							<div class="item {{$i==1 ? 'active' : '' }}">
								<div class="col-sm-6">
									<h1><span>MIN</span>:FULLHOUSE</h1>
									<h2>Chuy??n ????? n???i th???t</h2>
									<button type="button" class="btn btn-default get">Mua ngay</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/uploads/slider/'.$slider->slider_img)}}" height="300" width="400">
								</div>
							</div>
						@endforeach	
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh m???c s???n ph???m</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                          @foreach($category as $key => $cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc/'.$cate->cate_slug)}}">{{$cate->cate_name}}</a></h4>
                                </div>
                            </div>
                        @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Th????ng hi???u s???n ph???m</h2>
							<div class="panel-group category-products" id="accordian"><!--category-productsr-->
								@foreach($brand as $key => $brand)
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title"><a href="{{URL::to('/thuong-hieu/'.$brand->brand_slug)}}">{{$brand->brand_name}}</a></h4>
										</div>
									</div>
								@endforeach
                            </div>
                        </div>

						<div class="room_products"><!--room_products-->
                            <h2>Ph??ng</h2>
							<div class="panel-group category-products" id="accordian"><!--category-productsr-->
								@foreach($room as $key => $room)
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title"><a href="{{URL::to('/phong/'.$room->room_slug)}}">{{$room->room_name}}</a></h4>
										</div>
									</div>
								@endforeach
                            </div>
                        </div>
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<!-- m??? r???ng ph???n welcome, n???i dung c???a home s??? ?????t trong section content  -->
					@yield('content')
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/mina.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/h.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/mina.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/h.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Th????ng hi???u</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ???s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright ?? 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
	<script src="{{asset('public/frontend/js/prettify.js')}}"></script>

	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('id_product');            //data-id_product, l???y t??n l?? id_product, l???y ra id d???a theo button
				// alert(id);
				var cart_product_id = $('.cart_product_id_' + id).val();                      // l???y t??n b??n class home
                var cart_product_name = $('.cart_product_name_' + id).val();
				// alert(cart_product_name);
                var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();    //v?? d??ng form n??n c?? th??m token
				if(parseInt(cart_product_qty) > parseInt(cart_product_quantity)){
					alert('Vui l??ng ?????t nh??? h??n' + cart_product_quantity );
				}else{
					$.ajax({
                    	url: '{{url('/add-cart-ajax')}}',
                    	method: 'POST',
                    	data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
                    	success:function(data){
							swal({
									title: "???? th??m s???n ph???m v??o gi??? h??ng",
									text: "B???n c?? th??? mua h??ng ti???p ho???c t???i gi??? h??ng ????? ti???n h??nh thanh to??n",
									showCancelButton: true,
									cancelButtonText: "Xem ti???p",
									confirmButtonClass: "btn-success",
									confirmButtonText: "??i ?????n gi??? h??ng",
									closeOnConfirm: false
								},
								function() {
									window.location.href = "{{url('/gio-hang')}}";
							});

                    	}

                	});
				}
			});
        });
		
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.choose').on('change',function(){
				var action = $(this).attr('id');
				var ma_id = $(this).val();
				var _token = $('input[name="_token"]').val();
				var $result = '';
				// alert(action);
				//  alert(matp);
				//   alert(_token);
				if(action == 'city'){
					result = 'province';
				}else{
					result = 'wards';
				}
				$.ajax({
					url : '{{url('/select-delivery')}}',
					method: 'POST',
					data:{action:action,ma_id:ma_id,_token:_token},
					success:function(data){
						$('#'+result).html(data);        //n???u th??nh c??ng th?? sau khi ch???n city, th?? id province s??? nh???n gi?? tr??? t????ng t??? v???i wards
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.calculate_delivery').click(function(){
				var matp = $('.city').val();              //l???y matp,qh,xp d??? b??n giao ??i???n 
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){           //n???u k ch???n gi?? tr???
                    alert('L??m ??n ch???n ????? t??nh ph?? v???n chuy???n');
                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
						// $('#'+result).html(data); 
						location.reload(); 
                    }
                    });
				}
			});
        });
		
	</script>
    <script type="text/javascript">
		$(document).ready(function(){
			$('.send_order').click(function(){
				swal({
                  title: "X??c nh???n ????n h??ng",
                  text: "????n h??ng s??? kh??ng ???????c ho??n tr??? khi ?????t,b???n c?? mu???n ?????t kh??ng?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "C???m ??n, Mua h??ng",

                    cancelButtonText: "????ng,ch??a mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
				function(isConfirm){
                    if (isConfirm){
						var shipping_email = $('.shipping_email').val();                      // t??n b??n ph???i l???y t??n b??n class checkout
						var shipping_name = $('.shipping_name').val();
						var shipping_address = $('.shipping_address').val();
						var shipping_phone = $('.shipping_phone').val();
						var shipping_notes = $('.shipping_notes').val();
						var shipping_method = $('.payment_select').val();
						var order_fee = $('.order_fee').val();
						var order_coupon = $('.order_coupon').val();                             
						var _token = $('input[name="_token"]').val();    //v?? d??ng form n??n c?? th??m token

						$.ajax({
							url: '{{url('/confirm-order')}}',
							method: 'POST',
							data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
							success:function(){
								swal("????n h??ng", "????n h??ng c???a b???n ???? ???????c g???i th??nh c??ng", "success");
							}

						});
						window.setTimeout(function(){ 
                            location.reload();                                  //reset l???i
                        } ,3000);

                    } else {
                        swal("????ng", "????n h??ng ch??a ???????c g???i, l??m ??n ho??n t???t ????n h??ng", "error");
					}
				});
			});
        });
		
	</script> 
	<script type="text/javascript">
		$(document).ready(function() {
			$('#imageGallery').lightSlider({
				gallery:true,                       //ch???y nh??u h??nh ???nh
				item:1,
				loop:true,
				thumbItem:3,                        //hi???n th??? 3 c??i
				slideMargin:0,
				enableDrag: false,
				currentPagerPosition:'left',
				onSliderLoad: function(el) {
					el.lightGallery({
						selector: '#imageGallery .lslide'
					});
				}   
			});  
		});
	</script>
	<script type="text/javascript">
		$(document).on('click','.watch-video',function(){
			var video_id = $(this).attr('id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url : '{{url('/watch-video')}}',
                method: 'POST',
				dataType:"JSON",
				data:{video_id:video_id,_token:_token},
				success:function(data){
					$('#video_title').html(data.video_title);
					$('#video_link').html(data.video_link);
					$('#video_desc').html(data.video_desc);
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			load_comment();
			// alert(product_id);
			function load_comment(){
				var product_id = $('.comment_product_id').val(); 
				var _token = $('input[name="_token"]').val();
				$.ajax({
                    url : '{{url('/load-cmt')}}',
                    method: 'POST',
                    data:{product_id:product_id,_token:_token},
                    success:function(data){
						$('#comment_show').html(data); 
                    }
                });
			}
			$('.send-comment').click(function(){
				var product_id = $('.comment_product_id').val();
				var comment_name = $('.comment_name').val();
				var comment_content = $('.comment_content').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
                    url : '{{url('/send-cmt')}}',
                    method: 'POST',
                    data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
                    success:function(data){
						$('#notify-comment').html('<span class="text text-success">Th??m b??nh lu???n th??nh c??ng</span>'); 
						load_comment();
						$('#notify-comment').fadeOut(2000);
						$('.comment_name').val('');
						$('.comment_content').val('');
                    }
                });
			});
		});
	</script>
	<script type="text/javascript">
		//Th??m s???n ph???m v??o so s??nh
		function add_compare(pro_id) {
			// alert(pro_id);
			document.getElementById('title-compare').innerText = 'Ch??? cho ph??p so s??nh 3 s???n ph???m';

			var id = pro_id;
			var name = document.getElementById('wishlist_productname'+ id).value;
			var size = document.getElementById('wishlist_productsize'+ id).value;
			var price = document.getElementById('wishlist_productprice'+ id).value;
			var image = document.getElementById('wishlist_productimg'+ id).src;
			var url = document.getElementById('wishlist_producturl'+ id).href;

			var newItem = {
				'url':url,
				'id':id,
				'name':name,
				'price':price,
				'image': image,
				'size': size
			}
			if(localStorage.getItem('compare')==null){
				localStorage.setItem('compare', '[]');
			}

			var old_data = JSON.parse(localStorage.getItem('compare'));

			var matches = $.grep(old_data, function(obj){
				return obj.id == id;
			})
			if(matches.length){
				$('#notify').innerText = 'S???n ph???m ???? th??m v??o so s??nh';
				$('#compare').modal();

			}else{
				if(old_data.length <=2){
					old_data.push(newItem);   //l???y d??? li???u m???i ?????y v??o d??? li???u c??
					$('#row_compare').find('tbody').append(`
						<tr id="row_compare`+id+`">
							<td>`+newItem.name+`</td>
							<td>`+newItem.price+`</td>
							<td><img width="200px" src="`+newItem.image+`"></td>
							<td>`+newItem.size+`</td>
							<td><a href="`+newItem.url+`">Xem s???n ph???m</a></td>
							<td><a style="cursor:pointer;" onclick="delete_compare(`+id+`)">X??a</a></td>
						</tr>
					`);
				}
			}
			localStorage.setItem('compare', JSON.stringify(old_data));
			$('#compare').modal();
		}

		//G???i t???t c??? sp ss ???? th??m
		view_compare();
		function view_compare() {
			if (localStorage.getItem('compare')!=null) {
				var data = JSON.parse(localStorage.getItem('compare'));

				for(i=0;i<data.length;i++){
					var name = data[i].name;
					var price = data[i].price;
					var image = data[i].image;
					var size = data[i].size;
					var url = data[i].url;
					var id = data[i].id;

					$('#row_compare').find('tbody').append(`
						<tr id="row_compare`+id+`">
							<td>`+name+`</td>
							<td>`+price+`</td>
							<td><img width="200px" src="`+image+`"></td>
							<td>`+size+`</td>
							<td><a href="`+url+`">Xem s???n ph???m</a></td>
							<td><a style="cursor:pointer;" onclick="delete_compare(`+id+`)">X??a</a></td>
						</tr>
					`);
				}
			}
		}

		//X??a sp ra kh???i so s??nh
		function delete_compare(id) {
			if (localStorage.getItem('compare')!=null) {
				var data = JSON.parse(localStorage.getItem('compare')); //l???y d??? li???u compare s??n data
				var index = data.findIndex(item => item.id === id);     //Js findIdex ????? t??m sp, ss nghi??m ng???t l?? 3 d???u =, t??m v??? tr?? r???i so s??nh id truy???n v??o
				data.splice(index,1);                                   //x??a id trong JS, c???t v??? tr?? ??i 1
				localStorage.setItem('compare', JSON.stringify(data));
				document.getElementById('row_compare'+id).remove();
			}
		}

		
	</script>
</body>
</html>