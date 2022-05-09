@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
<style>
	span.fa-solid.fa.fa-toggle-on {
    color: blue;
    font-size: 28px;
    }
    span.fa-solid.fa.fa-toggle-off {
    color: blue;
    font-size: 28px;
    }
    span.text-alert {
    color: blue;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
    }
    a.active.styling-edit {
    font-size: 20px;
    }
</style>
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
      </div>
    </div>
    
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
    }
    ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày hết hạn</th>
            <th>Cách thức giảm</th>
            <th>Số giảm</th>
            <th>Trạng thái</th>
            <th>Mã hết hạn</th>
            <th>Gửi mã</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($coupon as $key => $coupon)
          <tr>
            <td>{{ $coupon->coupon_name }}</td>
            <td>{{ $coupon->coupon_code }}</td>
            <td>{{ $coupon->coupon_qty }}</td>
            <td>{{ $coupon->coupon_date_start }}</td>
            <td>{{ $coupon->coupon_date_end }}</td>
            <td><span class="text-ellipsis">
            <?php
               if($coupon->coupon_condition==1){
                ?>
                <!-- bắt sự kiện ẩn hiển thị -->
                Giảm theo %
                <?php
                 }else{
                ?>  
                Giảm theo tiền
                <?php
               }
              ?>
            </span></td>
            <td><span class="text-ellipsis">
            <?php
               if($coupon->coupon_condition==1){
                ?>
                <!-- bắt sự kiện ẩn hiển thị -->
                Giảm {{ $coupon->coupon_number }} %
                <?php
                 }else{
                ?>  
                Giảm {{ $coupon->coupon_number }} VNĐ
                <?php
               }
              ?>
            </span></td>
            <td><span class="text-ellipsis">
            <?php
               if($coupon->coupon_status==1){
                ?>
                <!-- bắt sự kiện ẩn hiển thị -->
                <span style="color: green">Đã kích hoạt</span>
                <?php
                 }else{
                ?>  
                <span style="color: red">Đã khóa</span>
                <?php
               }
              ?>
            </span></td>
            <td>
              @if($coupon->coupon_date_end>$today)
                <span style="color: green">Còn hạn</span>
              @else
                <span style="color: red">Hết hạn</span>
              @endif
            </td>
            <td>
              <p><a href="{{URL::to('/send-coupon',[
                'coupon_number'=> $coupon->coupon_number,
                'coupon_condition'=> $coupon->coupon_condition,
                'coupon_code'=> $coupon->coupon_code,
                ])}}" class="btn btn-success">Gửi mã giảm giá</a></p>
            </td>
            <td>
              <a onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này không?')" href="{{URL::to('/delete-coupon/'.$coupon->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection