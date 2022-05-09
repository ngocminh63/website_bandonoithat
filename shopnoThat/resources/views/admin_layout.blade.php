<!DOCTYPE html>
<head>
<title>Trang quản trị</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<meta name="csrf-token" content="{{csrf_token()}}">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/1.png')}}">
                <span class="username">
				<?php
				$name = Session::get('admin_name');
				if($name){
					echo $name;
				}
				?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Hồ sơ</a></li>
                <!-- <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> -->
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-university"></i>
                        <span>Phòng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-room-product')}}">Liệt kê phòng</a></li>
						<li><a href="{{URL::to('/add-room-product')}}">Thêm phòng</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-server"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
						<li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-pencil-square-o"></i>
                        <span>Quản lý bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
						<li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="{{URL::to('/manager-order')}}">
                        <i class="fa fa-folder"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-barcode"></i>
                        <span>Quản lý mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-coupon')}}">Liệt kê mã giảm giá</a></li>
						<li><a href="{{URL::to('/add-coupon')}}">Thêm mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/delivery')}}">
                        <i class="fa fa-car"></i>
                        <span>Quản lý phí vận chuyển</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-clone"></i>
                        <span>Quản lý slide</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-slider')}}">Liệt kê slide</a></li>
						<li><a href="{{URL::to('/add-slider')}}">Thêm slide</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/video')}}">
                        <i class="fa fa-caret-square-o-right"></i>
                        <span>Quản lý video</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/comment')}}">
                        <i class="fa fa-caret-square-o-right"></i>
                        <span>Quản lý bình luận</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>Quản lý nhân viên</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/users')}}">Liệt kê nhân viên</a></li>
						<li><a href="{{URL::to('/add-users')}}">Thêm nhân viên</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
	</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- //dùng ajax, thì khi chọn tỉnh thành phố, thì nó sẽ lọc theo tỉnh thành phố đã chọn để ra quận huyển rồi tương tự ra xã -->

<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
<script>
  $( function() {
    $( "#start_coupon" ).datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6", "Thứ 7","Chủ nhật"],
        duration: "slow"
    });
    $( "#end_coupon" ).datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6", "Thứ 7","Chủ nhật"],
        duration: "slow"
    });
  });
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6", "Thứ 7","Chủ nhật"],
        duration: "slow"
    });
    $( "#datepicker1" ).datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6", "Thứ 7","Chủ nhật"],
        duration: "slow"
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        fetch_delivery();  
                                          //khi load thì phải lấy function
        function fetch_delivery(){                          //lấy dữ liệu ra bằng ajax
            var _token = $('input[name="_token"]').val();   //bắt buộc pahir có token
             $.ajax({
                url : '{{url('/select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                   $('#load_delivery').html(data);             //id nên dùng #, class dùng .
                }
            });
        }

        $(document).on('blur','.fee_feeship_edit',function(){         //blur: sau khi sửa xong ấn bất cứ vị trí nào thì cũng đều được cập nhật giá trị

            var feeship_id = $(this).data('feeship_id');             //feeship_id bên deliverycontrol, post phải có token
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            // alert(feeship_id);
            // alert(fee_value);
            $.ajax({
                url : '{{url('/update-feeship')}}',
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                    alert('Sửa phí vận chuyển thành công') 
                    fetch_delivery();                             //để load trang
                }
            });

        });

        $('.add_delivery').click(function(){
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();

        //     alert(city);
        //    alert(province);
        //    alert(wards);
        //    alert(fee_ship);
            $.ajax({
                url : '{{url('/insert-delivery')}}',
                method: 'POST',
                data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                success:function(data){
                    alert('Thêm phí vận chuyển thành công')   
                    fetch_delivery();    
                }
            });
        });

        //chọn phần hiển thị
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
                   $('#'+result).html(data);        //nếu thành công thì sau khi chọn city, thì id province sẽ nhận giá trị tương tự với wards
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");                //lấy id bên view
        var _token = $('input[name="_token"]').val();

        //lay ra so luong
        quantity = [];                                                          //lấy theo chuỗi, thì sẽ lặp lại tất cả các sản phẩm trong giỏ hàng
        $("input[name='product_sales_quantity']").each(function(){             //lấy số lượng dữ theo tên
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){
          
                $.ajax({
                        url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                location.reload();
                            }
                });
            
        }

    });
</script>
<!-- thư viện ảnh -->
<script type="text/javascript">
    $(document).ready(function() {
        load_gallery();

        function load_gallery(){
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url : '{{url('/all-gallery')}}',
                method: 'POST',
                data:{pro_id:pro_id,_token:_token},
                success:function(data){
					// $('#'+result).html(data); 
					$('#gallery_load').html(data);        //trả về kết quả bên all ra
                }
            });
        }
        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;                 
            
            if(files.length>5){
                error+='<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
            }else if(files.length==''){
                error+='<p>Bạn không được bỏ trống trường này</p>';
            }else if(files.size> 2000000){
                error+='<p>File ảnh không được lớn hơn 2MB</p>';
            }
            if(error==''){

            }else{
                $('#file').val('');
                $('#error_gallery').htnml('<span class="text-danger">'+error+'</span>');
                return false;
            }
        });
        $(document).on('blur','.edit_galname',function(){         //blur: sau khi sửa xong ấn bất cứ vị trí nào thì cũng đều được cập nhật giá trị
            // alert('ok');
            var gal_id = $(this).data('gal_id');             //gal_id bên deliverycontrol, post phải có token
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            // alert(gal_id);
            // alert(gal_text);
            $.ajax({
                url : '{{url('/update-galname')}}',
                method: 'POST',
                data:{gal_id:gal_id, gal_text:gal_text, _token:_token},
                success:function(data){
                    alert('Sửa tên gallery thành công') 
                    load_gallery();                             //để load trang
                }
            });

        });
        $(document).on('click','.delete-gallery',function(){         //blur: sau khi sửa xong ấn bất cứ vị trí nào thì cũng đều được cập nhật giá trị
            // alert('ok');
            var gal_id = $(this).data('gal_id');             //gal_id bên deliverycontrol, post phải có token
            var _token = $('input[name="_token"]').val();
            // alert(gal_id);
            // alert(gal_text);
            if(confirm('Bạn có muốn xóa hình ảnh này không?')){
                $.ajax({
                    url : '{{url('/delete-gallery')}}',
                    method: 'POST',
                    data:{gal_id:gal_id, _token:_token},
                    success:function(data){
                        load_gallery();                             //để load trang
                    }
                });
            }
        });
    });
</script>
<!-- video -->
<script type="text/javascript">
    $(document).ready(function() {
        load_video();
        function load_video(){
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url : '{{url('/all-video')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
					// $('#'+result).html(data); 
					$('#video_load').html(data);        //trả về kết quả bên all ra
                }
            });
        }
        $(document).on('click','.btn-add-video',function(){         //blur: sau khi sửa xong ấn bất cứ vị trí nào thì cũng đều được cập nhật giá trị
            // alert('ok');
            var video_title = $('.video_title').val();             //gal_id bên deliverycontrol, post phải có token
            var video_slug = $('.video_slug').val(); 
            var video_link = $('.video_link').val(); 
            var video_desc = $('.video_desc').val(); 
            var form_data = new FormData();

            form_data.append("file", document.getElementById("file_imgvideo").files[0]);
            form_data.append("video_title",video_title);
            form_data.append("video_slug",video_slug);
            form_data.append("video_link",video_link);
            form_data.append("video_desc",video_desc);
            // alert(video_title);
            // alert(video_slug);
            // alert(video_link);
            // alert(video_desc);
            $.ajax({
                url : '{{url('/insert-video')}}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,

                contentType:false,
                cache:false,
                processData:false,

                success:function(data){
                    load_video();    
                    $('#notify').html('<span class="text text-success">Thêm video thành công</span>');                   
                }
            });
        });
        $(document).on('blur','.video_edit',function(){         //blur: sau khi sửa xong ấn bất cứ vị trí nào thì cũng đều được cập nhật giá trị
            var video_type = $(this).data('video_type');
            var video_id = $(this).data('video_id');
            var _token = $('input[name="_token"]').val();
            // alert(video_type);
            if(video_type == 'video_title'){
                var video_edit = $('#'+ video_type +'_'+ video_id).text();
                var video_check = video_type;                     //ktra dữ liệu
            }else if(video_type == 'video_slug'){
                var video_edit = $('#'+ video_type +'_'+ video_id).text();
                var video_check = video_type;
            }else if(video_type == 'video_link'){
                var video_edit = $('#'+ video_type +'_'+ video_id).text();
                var video_check = video_type;
            }else{
                var video_edit = $('#'+ video_type +'_'+ video_id).text();
                var video_check = video_type;
            }
            $.ajax({
                url : '{{url('/update-video')}}',
                method: 'POST',
                data:{video_edit:video_edit, video_id:video_id, video_check:video_check, _token:_token},
                success:function(data){
                    load_video();    
                    $('#notify').html('<span class="text text-success">Cập nhật video thành công</span>');                   
                }
            });
        });
        $(document).on('click','.btn-delete-video',function(){         //blur: sau khi sửa xong ấn bất cứ vị trí nào thì cũng đều được cập nhật giá trị
            // alert('ok');
            var video_id = $(this).data('video_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn có muốn xóa video này không?')){
                $.ajax({
                    url : '{{url('/delete-video')}}',
                    method: 'POST',
                    data:{video_id:video_id, _token:_token},
                    success:function(data){
                        load_video();    
                        $('#notify').html('<span class="text text-success">Xóa video thành công</span>');                   
                    }
                });
            }
        });
    });
</script>
<!-- bình luận -->
<script type="text/javascript">
    $('.comment_status_btn').click(function(){
        var comment_status = $(this).data('comment_status');
        var comment_id = $(this).data('comment_id');
        var comment_pro_id = $(this).attr('id');
        if(comment_status==0){
            var alert = 'Duyệt bình luận thành công';
        }else{
            var alert = 'Bỏ duyệt bình luận thành công';
        }
        $.ajax({
            url : '{{url('/allow-cmt')}}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{comment_status:comment_status, comment_id:comment_id, comment_pro_id:comment_pro_id},
            success:function(data){
                location.reload();
                $('#notify_comment').html('<span class="text text-success">'+alert+'</span>');

            }
        });
    });
    $('.btn-reply-cmt').click(function(){
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+ comment_id).val();
        var comment_pro_id = $(this).data('product_id');
        $.ajax({
            url : '{{url('/reply-cmt')}}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{comment:comment, comment_id:comment_id, comment_pro_id:comment_pro_id},
            success:function(data){
                $('.reply_cmt').val('');
                location.reload();
                $('#notify_comment').html('<span class="text text-success">Trả lời bình luận thành công</span>');


            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        chart19daysorder();
        var chart = new Morris.Bar({
            element: 'myfirstchart',
            //option chart(màu tương ứng)
            lineColor: ['#819C79','#fc8710','#FF6541','#A4ADD3','#766856'],
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                parseTime: false,//hiển thị ngày giờ
            // The name of the data record attribute that contains x-values.
            xkey: 'period',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['order','sales','profit','quantity'],
            behaveLikeline: true,
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Đơn hàng','Doanh số','Lợi nhuận','Số lượng']
        });

        function chart19daysorder() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/days-order')}}',
                method: 'POST',
                dataType: 'JSON',
                data:{_token:_token},
                success:function(data){
                   chart.setData(data);

                }
            });
        }
        
        //lấy ngày đầu và ngày cuối muốn lấy dữ liệu
        $('#btn-dashboard-filter').click(function(){
            // alert('Ok');
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker1').val();
            // alert(from_date);
            // alert(to_date);
            $.ajax({
                url : '{{url('/filter-by-date')}}',
                method: 'POST',
                dataType: 'JSON',
                data:{from_date:from_date, to_date:to_date, _token:_token},
                success:function(data){
                   chart.setData(data);

                }
            });
        });
        //lấy dữ liệu thieo 0ption
        $('.dashboard-filter').change(function(){
            // alert('Ok');
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            
            // alert(dashboard_value);
            $.ajax({
                url : '{{url('/dashboard-filter')}}',
                method: 'POST',
                dataType: 'JSON',
                data:{dashboard_value:dashboard_value, _token:_token},
                success:function(data){
                   chart.setData(data);

                }
            });
        });
    });
</script>
<script>
       // Replace the <textarea id="editor1"> with a CKEditor
       // instance, using default configuration.
	   //ckeditor dùng nhiều cho textarea
        // CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
</script>

<script type="text/javascript">
        $.validate({
            
        });
</script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
