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
                           Cập nhật phòng
                        </header>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <div class="panel-body">
                            @foreach($edit_room_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-room-product/'.$edit_value->room_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên phòng</label>
                                    <input type="text" value="{{$edit_value->room_name}}" class="form-control"  onkeyup="ChangeToSlug();" name="room_product_name"  id="slug" placeholder="phòng" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit_value->room_slug}}" class="form-control"  onkeyup="ChangeToSlug();" name="room_product_slug"  id="slug" placeholder="slug" >
                                </div>
                               
                                <button type="submit" name="update_room_product" class="btn btn-info">Cập nhật phòng</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
</div>
@endsection