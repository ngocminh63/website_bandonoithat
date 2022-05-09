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
                           Thêm phí vận chuyển
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
                                <!-- thêm bằng ajax -->
                                <form>
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn tỉnh/thành phố</label>
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                           <option value="">--Chọn Tỉnh/Thành phố--</option>
                                            @foreach($city as $key => $ct)
                                                <option value="{{$ct->matp}}">{{$ct->name_tp}}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận/huyện</label>
                                      <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                           <option value="">--Chọn Quận/Huyện--</option>
                                            
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã/phường</label>
                                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                           <option value="">--Chọn Xã/Phường--</option>
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                               
                                <button type="submit" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                                </form>
                            </div>
                            <br>
                            <div id="load_delivery">
                                
                            </div>
                        </div>
                    </section>

            </div>
</div>
@endsection