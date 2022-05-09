@extends('admin_layout')
@section('admin_content')
<style>
	span.text-alert {
    color: blue;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
}
</style>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Slide
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
                            <!-- enctype="multipart/form-data" dùng để up hình ảnh -->
                                <form role="form" action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slide</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Tên slider">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Slider">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả slider</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>
                                        <select name="slider_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển thị</option>
                                                <option value="1">Ẩn</option>
                                                
                                        </select>
                                    </div>
                               
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm slide</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection