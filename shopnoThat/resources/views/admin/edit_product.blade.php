@extends('admin_layout')
@section('admin_content')
<div class="row">
<style>
	span.text-alert {
    color: blue;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
}
</style>
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật sản phẩm
                        </header>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <div class="panel-body">

                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <!-- thêm ảnh phải có enctype="multipart/form-data" -->
                                <form role="form" action="{{URL::to('/update-product/'.$pro->pro_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" value="{{$pro->pro_name}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_name"  id="sản phẩm"  >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="text" value="{{$pro->pro_qty}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_qty"  id="slug" placeholder="số lượng sản phẩm" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đã bán</label>
                                    <input type="text" value="{{$pro->pro_sold}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_sold"  id="slug" placeholder="số lượng sản phẩm" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$pro->pro_slug}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_slug"  id="slug"  >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file"  name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->pro_img)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán</label>
                                    <input type="text" value="{{$pro->pro_price}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_price"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá nhập</label>
                                    <input type="text" value="{{$pro->pro_cost}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_cost"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kích thước</label>
                                    <input type="text" value="{{$pro->pro_size}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_size"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu sắc</label>
                                    <input type="text" value="{{$pro->pro_color}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_color"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chất liệu</label>
                                    <input type="text" value="{{$pro->pro_material}}" class="form-control"  onkeyup="ChangeToSlug();" name="product_material"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$pro->pro_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                      <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_pro as $key => $cate)
                                            <!-- value để lấy id, còn tên để hiển thị k lấy tên -->
                                            @if($cate->cate_id==$pro->cate_id)
                                            <option selected value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                            @else
                                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                      @foreach($brand_pro as $key => $brand)
                                      @if($brand->brand_id==$pro->brand_id)
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phòng</label>
                                      <select name="product_room" class="form-control input-sm m-bot15">
                                        @foreach($room_pro as $key => $room)
                                            <!-- value để lấy id, còn tên để hiển thị k lấy tên -->
                                            @if($room->room_id==$pro->room_id)
                                            <option selected value="{{$room->room_id}}">{{$room->room_name}}</option>
                                            @else
                                            <option value="{{$room->room_id}}">{{$room->room_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                           <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
</div>
@endsection