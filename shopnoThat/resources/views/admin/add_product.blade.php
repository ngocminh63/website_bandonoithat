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
                           Thêm sản phẩm
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
                                <!-- thêm ảnh phải có enctype="multipart/form-data" -->
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự"  class="form-control"  onkeyup="ChangeToSlug();" name="product_name"  id="slug" placeholder="sản phẩm" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                        <input type="text"  data-validation="number" data-validation-error-msg="Làm ơn điền số lượng sản phẩm" class="form-control"  onkeyup="ChangeToSlug();" name="product_qty"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Đã bán</label>
                                        <input type="text"  data-validation="number" data-validation-error-msg="Làm ơn điền số lượng sản phẩm" class="form-control"  onkeyup="ChangeToSlug();" name="product_sold"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự"  class="form-control"  onkeyup="ChangeToSlug();" name="product_slug"  id="slug" placeholder="slug" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                        <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá bán</label>
                                        <input type="text"  data-validation="number" data-validation-error-msg="Làm ơn điền giá sản phẩm" class="form-control"  onkeyup="ChangeToSlug();" name="product_price"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá nhập</label>
                                        <input type="text"  data-validation="number" data-validation-error-msg="Làm ơn điền giá sản phẩm" class="form-control"  onkeyup="ChangeToSlug();" name="product_cost"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kích thước</label>
                                        <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="product_size"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Màu sắc</label>
                                        <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="product_color"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chất liệu</label>
                                        <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="product_material"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả danh mục"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                        <select name="product_cate" class="form-control input-sm m-bot15">
                                            @foreach($cate_pro as $key => $cate)
                                                <!-- value để lấy id, còn tên để hiển thị k lấy tên -->
                                                <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thương hiệu</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                            @foreach($brand_pro as $key => $brand)
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endforeach
                                                
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phòng</label>
                                        <select name="product_room" class="form-control input-sm m-bot15">
                                            @foreach($room_pro as $key => $room)
                                                <!-- value để lấy id, còn tên để hiển thị k lấy tên -->
                                                <option value="{{$room->room_id}}">{{$room->room_name}}</option>
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
                                
                                    <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
@endsection