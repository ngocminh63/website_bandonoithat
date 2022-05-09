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
                           Thêm phòng
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
                                <form role="form" action="{{URL::to('/save-room-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên phòng</label>
                                    <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="room_product_name"  id="slug" placeholder="phòng" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="room_product_slug"  id="slug" placeholder="slug" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                      <select name="room_product_status" class="form-control input-sm m-bot15">
                                           <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_room_product" class="btn btn-info">Thêm phòng</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
@endsection